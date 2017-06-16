<?php 
$installed = '';
if(!isset($configs_are_set_designblog)) {
	include( dirname(__FILE__). "/configs.php");
}

$thisPage = $_SERVER['PHP_SELF'];
if(!isset($_REQUEST["search"])) $_REQUEST["search"] = ''; 
if(!isset($_REQUEST["p"])) { 
	$_REQUEST["p"] = ''; 
} elseif(isset($_REQUEST["p"]) and $_REQUEST["p"]!="") {
	$_REQUEST["p"]= (int) urlencode($_REQUEST["p"]);
}

$search='';
if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	$find = SafetyDB(urldecode($_REQUEST["search"]));
	$search .= " AND (post_title LIKE '%".$find."%' OR post_text LIKE '%".$find."%')";
}  

if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]!='') { 
	$_REQUEST["cat_id"] = (int) SafetyDB($_REQUEST["cat_id"]);
} else {
	$_REQUEST["cat_id"] = ''; 
}
if ($_REQUEST["cat_id"]>0) $search .= " AND `cat_id`= ".SafetyDB(htmlentities($_REQUEST["cat_id"]));

$error='';


// defining recurring url variables in the grid
if (isset($_REQUEST["id"]) and $_REQUEST["id"]>0) $url_vars = "?p="; else $url_vars = "&amp;p=";
if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') $url_vars .= urlencode($_REQUEST["p"]);
if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]>0) $url_vars .= "&amp;cat_id=".urlencode($_REQUEST["cat_id"]);
if(isset($_REQUEST["search"]) and $_REQUEST["search"]!="") $url_vars .= "&amp;search=".urlencode($_REQUEST["search"]);
//$url_vars .= "&amp;search=";
//if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') $url_vars .= urlencode($_REQUEST["search"]);
$url_vars .= "#blt";


/* define ReCaptcha */
$publickey = "6Lfk9L0SAAAAACp13Wlzz6WTanYxrcLBXyn7XNSJ";
$privatekey = "6Lfk9L0SAAAAAMccSmLp8kxaMQ53yJyVE0kuOSrh";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
/* define ReCaptcha end */

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$Options["comm_req"] = unserialize($Options["comm_req"]);
$OptionsVis = unserialize($Options['visual']);
$OptionsVisC = unserialize($Options['visual_comm']);
$OptionsLang = unserialize( base64_decode( $Options['language']));

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}
$cur_date = date('Y-m-d H:i:s');

if(!function_exists('lang_date')){ 
	function lang_date($subject) {	
		$search  = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
		
		$replace = array(
						ReadDB($GLOBALS['OptionsLang']['January']), 
						ReadDB($GLOBALS['OptionsLang']['February']), 
						ReadDB($GLOBALS['OptionsLang']['March']), 
						ReadDB($GLOBALS['OptionsLang']['April']), 
						ReadDB($GLOBALS['OptionsLang']['May']), 
						ReadDB($GLOBALS['OptionsLang']['June']), 
						ReadDB($GLOBALS['OptionsLang']['July']), 
						ReadDB($GLOBALS['OptionsLang']['August']), 
						ReadDB($GLOBALS['OptionsLang']['September']), 
						ReadDB($GLOBALS['OptionsLang']['October']), 
						ReadDB($GLOBALS['OptionsLang']['November']), 
						ReadDB($GLOBALS['OptionsLang']['December']), 
						ReadDB($GLOBALS['OptionsLang']['Monday']), 
						ReadDB($GLOBALS['OptionsLang']['Tuesday']), 
						ReadDB($GLOBALS['OptionsLang']['Wednesday']), 
						ReadDB($GLOBALS['OptionsLang']['Thursday']), 
						ReadDB($GLOBALS['OptionsLang']['Friday']), 
						ReadDB($GLOBALS['OptionsLang']['Saturday']), 
						ReadDB($GLOBALS['OptionsLang']['Sunday'])
						);
	
		$lang_date = str_replace($search, $replace, $subject);
		return $lang_date;
	}
}

if (isset($_POST["act"]) and $_POST["act"]=='post_comment') {
	
	
	/////////////////////////////////////////////////
	////// checking for correct captcha starts //////
	if($Options['captcha']=='nocap') { // if the option is set to no Captcha
		$testvariable = true;	// test variable is set to true
	} else {
		$testvariable = false;	// test variable is set to false
	}
	
	if($Options['captcha']=='recap') { // if the option is set to reCaptcha
  
		if ($_POST["recaptcha_response_field"]) {
			$resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
	
			if ($resp->is_valid) { // test variable is set to true				
					$testvariable = true;				
			} else {
				# set the error code so that we can display it
				$error = $resp->error;
				$SysMessage =  ReadDB($OptionsLang["Incorrect_verification_code"]); 
				unset($_REQUEST["act"]);
			}
		} else {		
			$SysMessage =  ReadDB($OptionsLang["Incorrect_verification_code"]); 
			unset($_REQUEST["act"]);
		}
		
	} elseif($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if is set to math, simple or very simple captcha option
	
		if (preg_match('/^'.$_SESSION['key'].'$/i', $_REQUEST['string'])) { // test variable is set	to true			
				$testvariable = true;			
			} else {		
			$SysMessage =  ReadDB($OptionsLang["Incorrect_verification_code"]); 
			unset($_REQUEST["act"]);
		}
	}
	////// checking for correct captcha ends //////
	///////////////////////////////////////////////
	
	
	if ($testvariable==true) { // if test variable is set to true, then go to update database and send emails
	
		if ($Options["approval"]=='true') {			
			$status = 'Not approved';
		} else {
			$status = 'Approved';
		}
		
		$WordAllowed = true;
		$BannedWords = explode(",", ReadDB($Options["ban_words"]));
		if (count($BannedWords)>0) {
		  $checkComment = strtolower($_REQUEST["comment"]);
		  for($i=0;$i<count($BannedWords);$i++){
			  $banWord = trim($BannedWords[$i]);
			  if (trim($BannedWords[$i])<>'') {
				  if(preg_match("/".$banWord."/i", $checkComment)){ 
					  $WordAllowed = false;
					  break;
				  }
			  }
		  }
		}
		
		
		$IPAllowed = true;
		$BannedIPs = explode(",", ReadDB($Options["ban_ips"]));
		if (count($BannedIPs)>0) {
		  $checkIP = strtolower($_SERVER["REMOTE_ADDR"]);
		  for($i=0;$i<count($BannedIPs);$i++){
			  $banIP = trim($BannedIPs[$i]);
			  if (trim($BannedIPs[$i])<>'') {
				  if(preg_match("/".$banIP."/i", $checkIP)){
					  $IPAllowed = false;
					  break;
				  }
			  }
		  }
		}
		
		// check for required fields
		$emptyReqField = true;
		if(trim($_REQUEST["name"])=='') {
			$emptyReqField = false;
		}
		if (!empty($Options["comm_req"]) and in_array("Email", $Options["comm_req"])) {
			if (trim($_REQUEST["email"])=='') { 
				$emptyReqField = false;
			}
		}
		if (trim($_REQUEST["comment"])=='') { 
			$emptyReqField = false;
		}
		
		if($WordAllowed==false) {
			 $SysMessage =  $OptionsLang["Banned_word_used"]; 
		} elseif($IPAllowed==false) {
			 $SysMessage = ReadDB($OptionsLang["Banned_ip_used"]); 
		} elseif($emptyReqField==false) {
			 $SysMessage =  ReadDB($OptionsLang["required_fields"]);
		} else {
			
			$sql = "INSERT INTO ".$TABLE["Comments"]."
					SET `publish_date` 	= '".$cur_date."',
						`ipaddress` 	= '".SafetyDB($_SERVER["REMOTE_ADDR"])."',
					  	`status` 		= '".$status."',
					  	`post_id` 		= '".SafetyDB($_REQUEST["pid"])."',
					  	`name` 			= '".SafetyDB($_REQUEST["name"])."',
					  	`email` 		= '".SafetyDB($_REQUEST["email"])."',
					  	`comment` 		= '".SafetyDB($_REQUEST["comment"])."'";
			$sql_result = sql_result($sql);
			$SysMessage = $OptionsLang["Comment_Submitted"];
			if($Options['approval']=='true') {
				$SysMessage .= $OptionsLang["After_Approval_Admin"];
			}
			
										
			$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".SafetyDB($_REQUEST["pid"])."'";
			$sql_result = sql_result($sql);
			$Post = mysqli_fetch_assoc($sql_result);
			mysqli_free_result($sql_result);

			$mailheader = "From: ".ReadDB($Options["email"])."\r\n";
			$mailheader .= "Reply-To: ".ReadDB($Options["email"])."\r\n";
			$mailheader .= "Content-type: text/html; charset=UTF-8\r\n";
			$Message_body = "Post: <strong>".ReadDB($Post["post_title"])."</strong><br /><br />";
			$Message_body .= "Comment: <br /> ".nl2br(ReadDB($_REQUEST["comment"]))."<br /><br />";
			$Message_body .= "From: <br />".ReadDB($_REQUEST["email"])."<br />".ReadDB($_REQUEST["name"])."<br />";
			mail(ReadDB($Options["email"]), $OptionsLang["New_comment_posted"], $Message_body, $mailheader);
			
			unset($_REQUEST["name"]);
			unset($_REQUEST["email"]);
			unset($_REQUEST["comment"]);
			
			echo '<script type="text/javascript">window.location.href="'.$thisPage.'?pid='.$_REQUEST["pid"].'&p='.urlencode($_REQUEST["p"]).'&search='.urlencode($_REQUEST["search"]).'&cat_id='.$_REQUEST["cat_id"].'&SysMessage='.urlencode($SysMessage).'#comments";</script>'; 
		}

	} else {		
		$SysMessage =  $OptionsLang["Incorrect_verification_code"]; 
		unset($_REQUEST["act"]);
	}
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="<?php echo $CONFIG["folder_name"]; ?>styles/ionicons.css" rel="stylesheet" />
<!--<script src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/jquery-1.11.0.min.js"></script> -->
<script>
window.jQuery || document.write("<script src='<?php echo $CONFIG["full_url"]; ?>lightbox/js/jquery-1.11.0.min.js'><\/script>");
</script>
<script src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/lightbox.min.js"></script>
<link href="<?php echo $CONFIG["full_url"]; ?>lightbox/css/lightbox.css" rel="stylesheet" />
<?php include($CONFIG["server_path"]."styles/css_front_end.php"); ?>
<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/textsizer.js">
/***********************************************
* Document Text Sizer- Copyright 2003 - Taewook Kang.  All rights reserved.
* Coded by: Taewook Kang (http://www.txkang.com)
***********************************************/
</script>

<a name="blt"></a>

<div style="background-color:<?php echo $OptionsVis["gen_bgr_color"];?>;">
<div class="front_end_wrapper">


	<?php if($Options['showsearch']=='yes') {?> 
    <div class="search_form_wrap">   
        <div class="search_form">  
        <form action="<?php echo $thisPage; ?>" method="post" name="sform">              
              <input class="inputsearch" type="text" name="search" placeholder="<?php echo $OptionsLang["Search_button"]; ?>" value="<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') echo htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES); ?>">        
        </form>
        </div> 
    </div>
    <?php } ?>

<?php 
if(!isset($_REQUEST['hide_cat']) and $Options['showcategdd']!='no') { 
	$sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
	$sql_result = sql_result($sql);
	if (mysqli_num_rows($sql_result)>0) {
?> 
    <!-- categories -->
    <div class="w3-container padd-l-r-0 textAlignLeft">
        <a class="margin_bottom6 w3-btn<?php if($_REQUEST["cat_id"]>0) echo " cat_menu"; else echo " cat_menu_sel"; ?>" href="?cat_id=0"><?php echo $OptionsLang["Category_all"]; ?></a>
        <?php 
        $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
        $sql_result = sql_result($sql);
        while ($Cat = mysqli_fetch_assoc($sql_result)) { ?>
        <a class="margin_bottom6 w3-btn<?php if($Cat["id"]!=$_REQUEST["cat_id"]) echo " cat_menu"; else echo " cat_menu_sel"; ?>" href="<?php echo $thisPage; ?>?cat_id=<?php echo $Cat["id"]; ?>"><?php echo $Cat["cat_name"]; ?></a>        
        <?php } ?>  
        <!--<button class="w3-btn w3-light-grey w3-hide-small">Art</button> -->
    </div>    
    
<?php 
		mysqli_free_result($sql_result); 
	}
} ?>  

	<div class="dist_search_title"></div>

<?php
if (isset($_REQUEST["pid"]) and $_REQUEST["pid"]>0) {	
	$_REQUEST["pid"]= (int) SafetyDB($_REQUEST["pid"]);
	
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".SafetyDB($_REQUEST["pid"])."' and status='Posted'";
	$sql_result = sql_result($sql);
	$Post = mysqli_fetch_assoc($sql_result);
	$CurrPubDate = $Post["publish_date"];
	mysqli_free_result($sql_result);
	
	// fetch post category
	$sqlCat   = "SELECT * FROM ".$TABLE["Categories"]." WHERE `id`='".$Post["cat_id"]."'";
	$sql_resultCat = sql_result($sqlCat);
	$Cat = mysqli_fetch_array($sql_resultCat);
?>
    <!-- 'Back' link -->
    <div class="back_link">
        <a href="<?php echo $thisPage; ?>?p=<?php echo urlencode($_REQUEST['p']); ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#blt"><?php echo $OptionsLang["Back_home"]; ?>
        </a>
    </div>
    
    <!-- post title -->
    <div class="post_title"><?php echo $Post["post_title"]; ?></div>
    
    <div class="dist_title_date"></div>
    
    <!-- post date --> 
    <?php if($OptionsVis["show_date"]!='no' or $OptionsVis["show_aa"]!='no' or (isset($Cat["id"]) and $Cat["id"]>0)) { ?>   
    <div class="date_style">
    	<?php if($Cat["cat_name"]!="") echo $Cat["cat_name"]; ?>
        <?php if($OptionsVis["show_date"]!='no' or $OptionsVis["show_aa"]!='no') { echo " / "; } ?>
    	<?php if($OptionsVis["show_date"]!='no') { ?>  
        <?php echo lang_date(date($OptionsVis["date_format"],strtotime($Post["publish_date"]))); ?> 
        <?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($Post["publish_date"])); ?>
        &nbsp;&nbsp;
        <?php } ?>
        <?php if($OptionsVis["show_aa"]!='no') { ?>
        &nbsp;<a class="aplus-aminus" href="javascript:ts('post_text',+1)">A<sup>+</sup></a> | <a class="aplus-aminus" href="javascript:ts('post_text',-1)">a<sup>-</sup></a>
        <?php } ?>
    </div>
    <?php } ?>
    
    <div class="dist_date_text"></div>
    
    <!-- post text --> 
    <div id="post_text" class="post_text"><?php echo $Post["post_text"]; ?></div>
    <div class="clearboth"></div>  


	<?php 
	$sql = "UPDATE ".$TABLE["Posts"]." 
			SET reviews = reviews + 1 
			WHERE id='".SafetyDB($Post["id"])."'";
	$sql_result = sql_result($sql);	
	?>
    
    <?php if($Options["showshare"]=='yes') { ?>
    <div class="share_buttons">
        <!-- AddToAny BEGIN -->
		<style type="text/css">
        a .a2a_svg { -webkit-filter: invert(1); filter: invert(1); }
        </style>
        <div class="a2a_kit a2a_kit_size_28 a2a_default_style" data-a2a-icon-color="black">
        <a class="a2a_dd" href="https://www.addtoany.com/share_save"></a>
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_google_plus"></a>
        <a class="a2a_button_email"></a>
        <a class="a2a_button_print"></a>
        </div>
        <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
        <!-- AddToAny END -->
	</div>
    <?php } ?>
    <div class="clearboth"></div>
    

	<?php if($Post['post_comments']=='true') { ?>
    
    <a name="comments"></a>
    <?php if(isset($SysMessage)) { ?>
    <div class="comment_message"><?php if(isset($SysMessage)) echo $SysMessage; ?></div>
    <?php } else { ?>
    <div class="comment_message"><?php if(isset($_REQUEST['SysMessage'])) echo urldecode($_REQUEST['SysMessage']); ?></div>
    <?php } ?>
    
    <?php
    if ($Options["comments_order"]=='OnTop') {
        $commentOrder = 'DESC';
    } else {
        $commentOrder = 'ASC';
    }
    
    $sql = "SELECT * FROM ".$TABLE["Comments"]." WHERE post_id='".$Post["id"]."' AND status='Approved' ORDER BY id ".$commentOrder;
    $sql_result = sql_result($sql);
    $numComments = mysqli_num_rows($sql_result);
    if ($numComments>0) { 
        if ($Options["comments_order"]=='OnTop') {
            $commentNum = $numComments;
        } else {
            $commentNum = 1;
        }
    ?>
    <div class="word_Comments"><?php echo $numComments; ?> <?php echo $OptionsLang["Word_Comments"];?></div>
    <?php
        while ($Comments = mysqli_fetch_assoc($sql_result)) {
    ?>
    <!-- comments wrap div -->
    <div class="comments_wrapper">
        
        <!-- comments name -->
        <div class="dbl-comments-name"><?php echo ReadHTML($Comments["name"]); ?></div>
        
        <div class="dbl-commentNum"><span>#</span><?php echo $commentNum; ?></div>
        
        <!-- comments date -->
        <div class="dbl-comments-date">		
			<?php 
				if($OptionsVisC["comm_showing_time"]!='') { 
					$show_time = " ".$OptionsVisC["comm_showing_time"]; 
				} else {
					$show_time = "";
				}
				
				if(isset($OptionsVisC["time_offset"]) and $OptionsVisC["time_offset"]!='0') { 						
					echo lang_date(date($OptionsVisC["comm_date_format"].$show_time,strtotime($OptionsVisC["time_offset"], strtotime($Comments["publish_date"]))));
				} else {
					echo lang_date(date($OptionsVisC["comm_date_format"].$show_time,strtotime($Comments["publish_date"])));
				}
			?>
        </div>
            
        <div class="clearboth"></div>
        
        <!-- comments text -->
        <div class="dbl-comments-text"><?php echo nl2br($Comments["comment"]); ?></div>
    
    </div>
    
    <div class="dbl-dist-btw-comm"></div>
    
    <?php
            if ($Options["comments_order"]=='OnTop') {
                $commentNum --;
            } else {
                $commentNum ++;
            }
        }
    } else {
    ?>
    <div class="dbl-no-comments-posted"><?php echo $OptionsLang["No_comments_posted"]; ?></div>
    <?php 
    }
	mysqli_free_result($sql_result);
    ?>   
    
    <script type="text/javascript">
    function checkComment(form){
        var chekmail = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    
        var name, email, comment, isOk = true;
		<?php if($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if the option is NOT set to reCaptcha or no captcha ?>
		var string;
		<?php } ?>
		
        var message = "";
        
        message = "<?php echo $OptionsLang["required_fields"]; ?>";
        
        name	= form.name.value;	
		<?php if (!empty($Options["comm_req"]) and in_array("Email", $Options["comm_req"])) { ?>
        email	= form.email.value;
		<?php } ?>
        comment	= form.comment.value;
        <?php if($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if the option is NOT set to reCaptcha or no captcha ?>
		string	= form.string.value;
		<?php } ?>
    
        if (name.length==0){
            form.name.focus();
            isOk=false;
        }
		<?php if (!empty($Options["comm_req"]) and in_array("Email", $Options["comm_req"])) { ?>
        else if (email.length<5){
            form.email.focus();
            isOk=false;
        }	
        else if (email.length>=5 && email.match(chekmail)==null){
            message ="<?php echo $OptionsLang["correct_email"]; ?>";
            form.email.focus();
            isOk=false;
        }
		<?php } ?>
        else if (comment.length==0){
            form.comment.focus();
            isOk=false;
        }
        <?php if($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if the option is NOT set to reCaptcha or no captcha ?>
		else if (string.length==0){
			message ="<?php echo ReadDB($OptionsLang["field_code"]); ?>";
			form.string.focus();
			isOk=false;
		}
		<?php } ?>	
    
        if (!isOk){			   
            alert(message);
            return isOk;
        } else {
            return isOk;
        }
    }
    </script>
    <script type="text/javascript">
	 var RecaptchaOptions = {
		theme : '<?php echo $Options['captcha_theme']; ?>'
	 };
	</script>
    <!-- comments form -->
    <form action="<?php echo $thisPage; ?>?p=<?php echo $_REQUEST['p']; ?>&cat_id=<?php echo $_REQUEST["cat_id"]; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>#comments" name="formComment" method="post" class="marg0-padd0">
    <input type="hidden" name="pid" value="<?php echo $_REQUEST["pid"]; ?>" />
    <input type="hidden" name="act" value="post_comment" />
    <table class="comments_wrapper">
      <tr>
        <td class="leave_comment"><?php echo $OptionsLang["Leave_Comment"]; ?></td>
      </tr>
      <tr>    
        <td class="comment_fields">
        	<input type="text" name="name" value="<?php if(isset($_REQUEST["name"])) echo $_REQUEST["name"]; ?>" class="form_fields" placeholder="<?php echo $OptionsLang["Comment_Name"]; ?>" />
        </td>

      </tr>
      <tr>    
        <td class="comment_fields">
        	<input type="text" name="email" value="<?php if(isset($_REQUEST["email"])) echo $_REQUEST["email"]; ?>" class="form_fields" placeholder="<?php echo $OptionsLang["Comment_Email"]; ?>" />
        </td>
      </tr>
      <tr>    
        <td valign="top" class="comment_fields">
        	<textarea placeholder="<?php echo $OptionsLang["Comment_here"]; ?>" name="comment" rows="5" class="form_fields"><?php if(isset($_REQUEST["comment"])) echo $_REQUEST["comment"]; ?></textarea>
        </td>
      </tr>
      
      <?php 
	  if($Options['captcha']!='nocap') { // if the option is set to no Captcha
	  ?>
      <tr>    
        <td valign="top" class="comment_fields">
        
			<?php if($Options['captcha']!='recap') { // if the option is set to reCaptcha ?>
            <div class="comment_labels"><?php echo $OptionsLang["Enter_verification_code"]; ?></div>
            <?php } ?>
        
        	<?php if($Options['captcha']=='recap') { // if the option is set to reCaptcha
				echo recaptcha_get_html($publickey, $error, true);
			} elseif($Options['captcha']=='capmath') { ?> 
            <img src="<?php echo $CONFIG["folder_name"]; ?>captchamath.php" id="captcha" class="form_captcha_img" alt="Mathematical catpcha image" /> 
          	<div class="form_captcha_eq"> = </div>                       
            <input type="text" name="string" maxlength="3" class="form_captcha form_captcha_math" /> 
			<?php } elseif($Options['captcha']=='cap') {  ?>
                <img src="<?php echo $CONFIG["folder_name"]; ?>captcha.php" class="form_captcha_img" alt="Simple catpcha image" />
				<input type="text" name="string" class="form_captcha form_captcha_s" /> 
            <?php 
			} else { ?>
                <img src="<?php echo $CONFIG["folder_name"]; ?>captchasimple.php" class="form_captcha_img" alt="Very catpcha image" />
            	<input type="text" name="string" class="form_captcha form_captcha_s" /> 
			<?php } ?>        
        </td>
      </tr>
      <?php 
	  }
	  ?>
      
      <tr>
        <td class="comment_required">* - <?php echo $OptionsLang["Required_fields"]; ?></td>
      </tr>
      <tr>
        <td class="comment_button"><input type="submit" name="button" value="<?php echo $OptionsLang["Submit_Comment"]; ?>" onclick="return checkComment(this.form)" class="submitbtn" /></td>
      </tr>
    </table>
    </form>
    
    <?php 
    } // end if comments true
    ?>
    
    
    <?php if(trim($OptionsLang["Older_Post"])!='' or trim($OptionsLang["Home_bottom"])!='' or trim($OptionsLang["Newer_Post"])!='') {?>
    <!-- navigation at the bottom "Older Post", "Home", "Newer Post" -->    
    <table class="bottom_navigator">
      <tr>
      	<?php 
		$Older_Post = '';
		$sql = "SELECT * FROM ".$TABLE["Posts"]." 
		WHERE `publish_date`<'".$CurrPubDate."' 
		AND status='Posted' " .$search . " 
		ORDER BY publish_date DESC LIMIT 0,1";
		$sql_result = sql_result($sql);
		if(mysqli_num_rows($sql_result)>0) {
			$Post = mysqli_fetch_assoc($sql_result);
			$Older_Post = $Post['id'];
		}	
		mysqli_free_result($sql_result);
		?>
        <td class="older_post">
        	<?php if($Older_Post>0) {?>
        		<a class="nav_active" href="<?php echo $thisPage; ?>?pid=<?php echo $Older_Post; ?>&amp;p=<?php echo $_REQUEST['p']; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#blt"><?php echo $OptionsLang["Older_Post"]; ?></a>
			<?php } else { ?>
            	<span class="nav_inactive"><?php echo $OptionsLang["Older_Post"]; ?></span>
            <?php } ?>
        </td>
        
        <td class="home_post"><a class="nav_active" href="<?php echo $thisPage; ?>?p=<?php echo $_REQUEST['p']; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#blt"><?php echo $OptionsLang["Home_bottom"]; ?></a></td>
        
        <?php 
		$Newer_Post = '';
		$sql = "SELECT * FROM ".$TABLE["Posts"]." 
				WHERE `publish_date`>'".$CurrPubDate."' 
				AND status='Posted' " .$search . " 
				ORDER BY publish_date ASC LIMIT 0,1";
		$sql_result = sql_result($sql);
		if(mysqli_num_rows($sql_result)>0) {
			$Post = mysqli_fetch_assoc($sql_result);
			$Newer_Post = $Post['id'];
		}	
		mysqli_free_result($sql_result);
		?>
        <td class="newer_post">
            <?php if($Newer_Post>0) {?>
        		<a class="nav_active" href="<?php echo $thisPage; ?>?pid=<?php echo $Newer_Post; ?>&amp;p=<?php echo $_REQUEST['p']; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#blt"><?php echo $OptionsLang["Newer_Post"]; ?></a>
			<?php } else { ?>
            	<span class="nav_inactive"><?php echo $OptionsLang["Newer_Post"]; ?></span>
            <?php } ?>
        </td>
        
      </tr>
    </table>
    <?php } ?>


<?php
} else {
?>

  <div>
  	<?php 
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	if ($Options["publishon"]=="yes") $search .= " AND publish_date <= '".$cur_date."'";	
	
	$sql = "SELECT count(*) as total FROM ".$TABLE["Posts"]." WHERE status<>'Hidden' ".$search;
	$sql_result = sql_result($sql);
	$row  = mysqli_fetch_array($sql_result);
	mysqli_free_result($sql_result);
	
	$total_pages = $row["total"];
	$adjacents = 1; // the adjacents to the current page digid when some pages are hidden
	$limit = $Options["per_page"];  //how many items to show per page
	$page = (int) SafetyDB(urldecode($_REQUEST["p"]));
	
	if($page) { 
		$start = ($page - 1) * $limit;  //first item to display on this page
	} else {
		$start = 0;	 //if no page var is given, set start to 0
	}
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	// pagination query and variables ends
	
	
	$sql = "SELECT * FROM ".$TABLE["Posts"]." 
			WHERE status<>'Hidden' " .$search . "  
			ORDER BY publish_date DESC 
			LIMIT " . ($pageNum-1)*$Options["per_page"] . "," . $Options["per_page"];	
	$sql_result = sql_result($sql);
	
	$i = 1;
	
	$numOfPosts = mysqli_num_rows($sql_result);
	//echo $numOfPosts;
	if($numOfPosts>0) {
	  while ($Post = mysqli_fetch_assoc($sql_result)) {
		//comments number
		$sqlC   = "SELECT count(*) as total FROM ".$TABLE["Comments"]." WHERE `post_id`='".$Post["id"]."' AND status='Approved'";
		$sql_resultC = sql_result($sqlC);
		$countComm = mysqli_fetch_array($sql_resultC);
?>       
    
    	<div class="dbl-third-padd-float">
        
          <div class="dbl-box-shadow">
          
			  <?php if(trim($Post["image"])!="") { ?>
              <a class="dbl-image-wrapper-grid" href="<?php echo $thisPage; ?>?pid=<?php echo $Post['id']; ?><?php echo $url_vars; ?>">
                <div class="dbl-image-grid" style="background-image:url('<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($Post["image"]); ?>');">
                </div>
              </a>
              <?php } ?>
                
              <div class="dbl-title-descr-grid">
                <a class="dbl-title-grid" href="<?php echo $thisPage; ?>?pid=<?php echo $Post['id']; ?><?php echo $url_vars; ?>"><?php echo ReadDB($Post["post_title"]); ?></a>
                <div class="dbl-grid-dist-title-date"></div>
                
                <!-- Post date -->   
                <?php if($OptionsVis["list_show_date"]!='no' or $Cat["Cat"]>0) { ?>  
                <div class="dbl-grid-date-style">
                    <i class="ion-ios-clock"></i>
                    <?php echo lang_date(date($OptionsVis["list_date_format"],strtotime($Post["publish_date"]))); ?> 
                    <?php if($OptionsVis["list_showing_time"]!='') echo date($OptionsVis["list_showing_time"],strtotime($Post["publish_date"])); ?>
                </div>
                <?php } ?>                    
                <a class="dbl-comments-num-link" href="<?php echo $thisPage; ?>?pid=<?php echo $Post['id']; ?>&amp;p=<?php if(isset($_REQUEST["p"])) echo urlencode($_REQUEST['p']); ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;&search=<?php if(isset($_REQUEST["search"])) echo urlencode($_REQUEST["search"]); ?>#comments"><i class="ion-android-chat"></i> <?php echo $countComm["total"]; ?></a>
				
                <div class="dbl-grid-dist-date-text"></div>
                
                <div class="dbl-short-descr">
                    <?php 			
                    if(trim($Post["post_limit"])=='') {
                        echo $Post["post_text"];
                    } elseif(trim($Post["post_limit"])>0) {
                        //$output = strip_only(cutStrHTML(ReadDB($Post["post_text"]), 0, $Post["post_limit"]), "div"); 
                        if (isCyrillic($Post["post_text"])) {	
                          $output = truncateBlogHtml(strip_tags($Post["post_text"]), $Post["post_limit"]);
                        } else {
                          $output = TruncateHTML::truncateChars(strip_tags($Post["post_text"]), $Post["post_limit"], '...');
                        }
                        echo strip_tags($output);
                    }
                    ?>
                </div>
              </div>
              
          </div>
          <div class="dist_btw_posts"></div>
        </div>
        
        <?php 
		if(trim($OptionsVis["thumb_per_line"])!="") {
			if($OptionsVis["thumb_per_line"]=="100") {
		 		$ThumbPerLine=1; 
			} elseif($OptionsVis["thumb_per_line"]=="50") {
		 		$ThumbPerLine=2; 
			} elseif ($OptionsVis["thumb_per_line"]=="33.33") {
		 		$ThumbPerLine=3; 
			} elseif ($OptionsVis["thumb_per_line"]=="25") {
		 		$ThumbPerLine=4; 
			} else {
				$ThumbPerLine=3;
			}
		} else {
			$ThumbPerLine=3;
		}
		
		if($i%$ThumbPerLine==0) { ?>
        <div class="clearboth"></div>
    	<?php } ?>
    
    <?php 
		$i++;
	  }
	} else {
	?>     
    	<div class="No_posts_published"><?php echo $OptionsLang['No_Posts'] ?></div>
    <?php 
	}
	?>
    
	</div>
    <div class="clearboth"></div>
    
	<!-- Pagination start here --> 
    <?php 
    // pagination starts. It can be shown wherever we need
    if($lastpage > 1) {	
        // defining recurring url variables
        //$paging_vars = "&amp;cat_id=".urlencode($_REQUEST["cat_id"])."&amp;search=".urlencode($_REQUEST["search"]);
		$paging_vars = "&amp;cat_id=".urlencode($_REQUEST["cat_id"]);
		
		$pag_align="w3-center";
		if($OptionsVis["pag_align_to"]=="left") { 
			$pag_align="w3-left-align"; 
		} 
		elseif($OptionsVis["pag_align_to"]=="right") {
			$pag_align="w3-right-align"; 
		} 
    ?>
    <div class="clearboth"></div>
    <div class="<?php echo $pag_align; ?> w3-padding-32">
      	<ul class="w3-pagination"> 
        <?php
        //previous button starts
        if ($page > 1) {
        ?>
        <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$prev;?><?php echo $paging_vars; ?>"><?php echo $OptionsLang["Previous"]; ?></a></li>
        <?php 
        }
        //previous button ends
        
        //pages	start
        if ($lastpage < 5 + ($adjacents * 2)) {	//not enough pages to bother breaking it up
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page) { ?>
                <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                <?php } else { ?>
                <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                <?php } 				
            }
        }
        elseif($lastpage > 3 + ($adjacents * 2)) {	//enough pages to hide some		
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page) { ?>
                    <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                    <?php } else { ?>
                    <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                    <?php } 				
                } ?>           
            <?php   
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { //in middle; hide some front and some back ?>
                <?php 
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents * 3; $counter++) {
                    if ($counter == $page) { ?>
                        <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                <?php } else { ?>
                        <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                <?php }                                         
                } ?>
            <?php     		
            } else { //close to end; only hide early pages  ?>
                <?php 
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page) { ?>
                        <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                    <?php } else { ?>
                        <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                    <?php } 					
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) { ?>
            <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$next;?><?php echo $paging_vars; ?>"><?php echo $OptionsLang["Next"]; ?></a></li>
        <?php 
        }
        ?>
        </ul>
  	</div>
    <?php 
    } // pagination ends	
    ?> 
    <!-- Pagination end here -->
    <div class="clearboth"></div>
    
<?php
}
?>

<?php if($OptionsVis["show_scrolltop"]!="no") {?>
<a href="#myAnchor" class="cd-top">Top</a>
<script type="text/javascript">

//$('.front_end_wrapper').prepend('<a href="#0" class="cd-top">Top</a>');

jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});

</script>
<?php } ?>
</div>
</div>