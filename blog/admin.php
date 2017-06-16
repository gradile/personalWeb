<?php
$installed = '';
session_start();
include("configs.php");
include("language_admin.php");

$message = "";
$logMessage = "";
if(!isset($_REQUEST["p"])) $_REQUEST["p"] = ''; 

if(isset($_REQUEST["act"])) {
  if ($_REQUEST["act"]=='logout') {
	$_SESSION["DeSiGnBlOgLogin"] = "";
	unset($_SESSION["DeSiGnBlOgLogin"]);
		
	//setcookie("DeSiGnBlOgLogin", "", 0);
	//$_COOKIE["DeSiGnBlOgLogin"] = "";	
	
	unset($_SESSION["KCFINDER"]);
	
 } elseif ($_REQUEST["act"]=='login') {
  	if ($_REQUEST["user"] == $CONFIG["admin_user"] and $_REQUEST["pass"] == $CONFIG["admin_pass"]) {
		$_SESSION["DeSiGnBlOgLogin"] = "ALoggedIn";	
		
		//setcookie("DeSiGnBlOgLogin", "ALoggedIn", time()+8*3600);
		//$_COOKIE["DeSiGnBlOgLogin"] = "ALoggedIn";			
			
 		$_REQUEST["act"]='posts';
  	} else {
		$logMessage = $lang['Login_message'];
  	}
  }
} ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $lang['Script_Administration_Header']; ?></title>


<script language="javascript" src="include/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="accordion/javascript/prototype.js"></script>
<script type="text/javascript" src="accordion/javascript/effects.js"></script>
<script type="text/javascript" src="accordion/javascript/accordion.js"></script>
<script language="javascript" src="include/functions.js"></script>
<script language="javascript" src="include/color_pick.js"></script>
<script type="text/javascript" src="include/datetimepicker_css.js"></script>
<link href="styles/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

</head>

<body>

<div class="logo">
	<div class="script_name"><?php echo $lang['Script_Administration_Header']; ?></div>
	<div class="logout_button"><a href="admin.php?act=logout"><img src="images/logout1.png" width="32" alt="Logout" border="0" /></a></div>
    <div class="clear"></div>
</div>

<div style="clear:both"></div>

<?php  
$Logged = false;
//if(isset($_COOKIE["DeSiGnBlOgLogin"]) and ($_COOKIE["DeSiGnBlOgLogin"]=="ALoggedIn")) {
if(isset($_SESSION["DeSiGnBlOgLogin"]) and ($_SESSION["DeSiGnBlOgLogin"]=="ALoggedIn")) {
	$Logged = true;
}
if ( $Logged ){

if (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsAdmin') {
	
	if (!isset($_REQUEST["showsearch"]) or $_REQUEST["showsearch"]=='') $_REQUEST["approval"] = 'yes';
	if (!isset($_REQUEST["showcategdd"]) or $_REQUEST["showcategdd"]=='') $_REQUEST["showcategdd"] = 'yes';
	if (!isset($_REQUEST["publishon"]) or $_REQUEST["publishon"]=='') $_REQUEST["publishon"] = 'yes';
	if (!isset($_REQUEST["showshare"]) or $_REQUEST["showshare"]=='') $_REQUEST["showshare"] = 'yes';
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `per_page`		= '".SaveDB($_REQUEST["per_page"])."',
				`publishon`		= '".SaveDB($_REQUEST["publishon"])."',
				`showcategdd`	= '".SaveDB($_REQUEST["showcategdd"])."',
				`showsearch`	='".SafetyDB($_REQUEST["showsearch"])."',		
				`post_limit`	= '".SaveDB($_REQUEST["post_limit"])."',							
				`showshare`		= '".SaveDB($_REQUEST["showshare"])."', 
				`share_side`	= '".SaveDB($_REQUEST["share_side"])."', 
				`items_link`	= '".SaveDB($_REQUEST["items_link"])."',
				`time_zone`		= '".SaveDB($_REQUEST["time_zone"])."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='admin_options'; 
  	$message = $lang['Message_Admin_options_saved']; 
  
} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsPost') {

	if (!isset($_REQUEST["approval"]) or $_REQUEST["approval"]=='') $_REQUEST["approval"] = 'false';
	
	if(!empty($_REQUEST["comm_req"])) {
		$comm_req = serialize($_REQUEST["comm_req"]);
	} else {
		$comm_req = "";
	}
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `email`			= '".SafetyDB($_REQUEST["email"])."',
				`approval`		= '".SafetyDB($_REQUEST["approval"])."', 
				`commentsoff`	= '".SafetyDB($_REQUEST["commentsoff"])."',
				`captcha`		= '".SafetyDB($_REQUEST["captcha"])."', 
				`captcha_theme`	= '".SafetyDB($_REQUEST["captcha_theme"])."',
				`comments_order`= '".SafetyDB($_REQUEST["comments_order"])."',
				`comm_req`		= '".SafetyDB($comm_req)."', 
				`ban_ips`		= '".SafetyDB($_REQUEST["ban_ips"])."', 
				`ban_words`		= '".SafetyDB($_REQUEST["ban_words"])."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='post_options'; 
  	$message = $lang['Message_Comments_options_saved']; 

} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsVisual') {
	
	// general visual options
	$visual['gen_font_family'] 	= $_REQUEST['gen_font_family'];
	$visual['gen_font_color'] 	= $_REQUEST['gen_font_color']; 
	$visual['gen_font_size'] 	= $_REQUEST['gen_font_size'];  
	$visual['gen_text_align'] 	= $_REQUEST['gen_text_align'];
	$visual['gen_line_height'] 	= $_REQUEST['gen_line_height'];
	$visual['gen_bgr_color'] 	= $_REQUEST['gen_bgr_color'];
	$visual['gen_width'] 		= $_REQUEST['gen_width'];
	$visual['gen_width_dim'] 	= $_REQUEST['gen_width_dim'];
	
	// Search box style 
	$visual['sear_color'] 		= $_REQUEST['sear_color']; 
	$visual['sear_bor_color'] 	= $_REQUEST['sear_bor_color'];
	$visual['sb_font_size'] 	= $_REQUEST['sb_font_size'];
	
	// Category drop-down style 
	$visual['cat_menu_color'] 		= $_REQUEST['cat_menu_color']; 
	$visual['cat_menu_bgr'] 		= $_REQUEST['cat_menu_bgr']; 	 
	$visual['cat_menu_color_sel'] 	= $_REQUEST['cat_menu_color_sel']; 
	$visual['cat_menu_bgr_sel'] 	= $_REQUEST['cat_menu_bgr_sel']; 
	$visual['cat_menu_family'] 		= $_REQUEST['cat_menu_family']; 	
	$visual['cat_menu_size']		= $_REQUEST['cat_menu_size']; 
	$visual['cat_menu_weight'] 		= $_REQUEST['cat_menu_weight'];
	
	// posts grid style
	$visual['thumb_ratio'] 		= $_REQUEST['thumb_ratio'];
	$visual['thumb_per_line'] 	= $_REQUEST['thumb_per_line'];
	
	// posts title style
	$visual['list_title_font'] 			= $_REQUEST['list_title_font']; 
	$visual['list_title_color'] 		= $_REQUEST['list_title_color']; 
	$visual['list_title_color_hover'] 	= $_REQUEST['list_title_color_hover']; 
	$visual['list_title_size'] 			= $_REQUEST['list_title_size']; 
	$visual['list_title_font_weight']	= $_REQUEST['list_title_font_weight'];
	$visual['list_title_font_style'] 	= $_REQUEST['list_title_font_style']; 
	$visual['list_title_align'] 		= $_REQUEST['list_title_align'];
	$visual['list_title_line_height'] 	= $_REQUEST['list_title_line_height'];
	
	// posts title style
	$visual['post_title_font'] 			= $_REQUEST['post_title_font']; 
	$visual['post_title_color'] 		= $_REQUEST['post_title_color']; 
	$visual['post_title_size'] 			= $_REQUEST['post_title_size']; 
	$visual['post_title_font_style'] 	= $_REQUEST['post_title_font_style']; 
	$visual['post_title_font_weight']	= $_REQUEST['post_title_font_weight'];
	$visual['post_title_align'] 		= $_REQUEST['post_title_align'];
	$visual['title_line_height'] 		= $_REQUEST['title_line_height'];
	$visual['title_line_color'] 		= $_REQUEST['title_line_color'];
	$visual['title_dist_line'] 			= $_REQUEST['title_dist_line'];
	$visual['title_line_thick'] 		= $_REQUEST['title_line_thick'];
	
	// posts list text style 
	$visual['list_text_font'] 		= $_REQUEST['list_text_font'];
	$visual['list_text_color'] 		= $_REQUEST['list_text_color'];
	$visual['list_text_bgr_color'] 	= $_REQUEST['list_text_bgr_color'];
	$visual['list_text_size'] 		= $_REQUEST['list_text_size']; 
	$visual['list_text_font_weight']= $_REQUEST['list_text_font_weight'];
	$visual['list_text_font_style'] = $_REQUEST['list_text_font_style']; 
	$visual['list_text_text_align'] = $_REQUEST['list_text_text_align'];
	$visual['list_text_line_height']= $_REQUEST['list_text_line_height'];
	
	// posts text style 
	$visual['text_font'] 		= $_REQUEST['text_font'];
	$visual['text_color'] 		= $_REQUEST['text_color'];
	$visual['text_bgr_color'] 	= $_REQUEST['text_bgr_color'];
	$visual['text_size'] 		= $_REQUEST['text_size']; 
	$visual['text_font_weight']	= $_REQUEST['text_font_weight'];
	$visual['text_font_style'] 	= $_REQUEST['text_font_style']; 
	$visual['text_text_align'] 	= $_REQUEST['text_text_align'];
	$visual['text_line_height'] = $_REQUEST['text_line_height'];
	$visual['text_padding'] 	= $_REQUEST['text_padding'];
	
	// posts grid date style
	$visual['list_date_font'] 		= $_REQUEST['list_date_font']; 
	$visual['list_date_color'] 		= $_REQUEST['list_date_color']; 
	$visual['list_date_size'] 		= $_REQUEST['list_date_size']; 
	$visual['list_date_font_style']	= $_REQUEST['list_date_font_style']; 
	$visual['list_date_text_align'] = $_REQUEST['list_date_text_align']; 
	$visual['list_date_format'] 	= $_REQUEST['list_date_format']; 
	$visual['list_show_date'] 		= $_REQUEST['list_show_date'];
	$visual['list_showing_time'] 	= $_REQUEST['list_showing_time']; 
	
	// post date style
	$visual['date_font'] 		= $_REQUEST['date_font']; 
	$visual['date_color'] 		= $_REQUEST['date_color']; 
	$visual['date_size'] 		= $_REQUEST['date_size']; 
	$visual['date_font_style']	= $_REQUEST['date_font_style']; 
	$visual['date_text_align'] 	= $_REQUEST['date_text_align']; 
	$visual['date_format'] 		= $_REQUEST['date_format']; 
	$visual['show_date'] 		= $_REQUEST['show_date'];
	$visual['showing_time'] 	= $_REQUEST['showing_time']; 
	$visual['show_aa'] 			= $_REQUEST['show_aa'];	
	
	// "COMMENTS" link style
	$visual['coml_font_color'] 			  = $_REQUEST['coml_font_color']; 
	$visual['coml_font_color_hover']	  = $_REQUEST['coml_font_color_hover'];
	$visual['coml_font']				  = $_REQUEST['coml_font'];
	$visual['coml_font_size'] 			  = $_REQUEST['coml_font_size'];
	$visual['coml_font_style'] 			  = $_REQUEST['coml_font_style'];
	$visual['coml_font_weight'] 		  = $_REQUEST['coml_font_weight'];
	
	// "back" button style
	$visual['back_font_color'] 				= $_REQUEST['back_font_color']; 
	$visual['back_font_color_hover']		= $_REQUEST['back_font_color_hover'];
	$visual['back_font_size'] 				= $_REQUEST['back_font_size'];
	$visual['back_font_style'] 				= $_REQUEST['back_font_style'];
	$visual['back_font_weight'] 			= $_REQUEST['back_font_weight'];
	$visual['back_text_decoration'] 		= $_REQUEST['back_text_decoration'];
	$visual['back_text_decoration_hover'] 	= $_REQUEST['back_text_decoration_hover'];
	
	
	// links in the post message area
	$visual['links_font_color'] 			= $_REQUEST['links_font_color']; 
	$visual['links_font_color_hover']		= $_REQUEST['links_font_color_hover'];
	$visual['links_text_decoration'] 		= $_REQUEST['links_text_decoration'];
	$visual['links_text_decoration_hover'] 	= $_REQUEST['links_text_decoration_hover'];
	$visual['links_font_size'] 				= $_REQUEST['links_font_size'];
	$visual['links_font_style'] 			= $_REQUEST['links_font_style'];
	$visual['links_font_weight'] 			= $_REQUEST['links_font_weight'];
	
	/////////// pagination style ///////////
	$visual['pag_font_color'] 		= $_REQUEST['pag_font_color'];
	$visual['pag_bgr_color'] 		= $_REQUEST['pag_bgr_color'];
	$visual['pag_font_color_hover'] = $_REQUEST['pag_font_color_hover'];
	$visual['pag_bgr_color_hover'] 	= $_REQUEST['pag_bgr_color_hover'];
	$visual['pag_font_color_sel'] 	= $_REQUEST['pag_font_color_sel'];
	$visual['pag_bgr_color_sel'] 	= $_REQUEST['pag_bgr_color_sel'];
	$visual['pag_font_family'] 		= $_REQUEST['pag_font_family']; 
	$visual['pag_font_size'] 		= $_REQUEST['pag_font_size']; 
	$visual['pag_font_weight'] 		= $_REQUEST['pag_font_weight']; 	 
	$visual['pag_font_style'] 		= $_REQUEST['pag_font_style'];
	$visual['pag_align_to'] 		= $_REQUEST['pag_align_to'];
	
	// Back to top style
	$visual['show_scrolltop'] 			= $_REQUEST['show_scrolltop']; 
	$visual['scrolltop_width'] 			= $_REQUEST['scrolltop_width']; 
	$visual['scrolltop_height'] 		= $_REQUEST['scrolltop_height']; 	 
	$visual['scrolltop_bgr_color'] 		= $_REQUEST['scrolltop_bgr_color'];
	$visual['scrolltop_bgr_color_hover']= $_REQUEST['scrolltop_bgr_color_hover']; 
	$visual['scrolltop_opacity'] 		= $_REQUEST['scrolltop_opacity']; 
	$visual['scrolltop_opacity_hover'] 	= $_REQUEST['scrolltop_opacity_hover']; 
	$visual['scrolltop_radius'] 		= $_REQUEST['scrolltop_radius']; 
	
	// navigation at the bottom "Older Post", "Home", "Newer Post"
	$visual['bott_color'] 			= $_REQUEST['bott_color']; 
	$visual['bott_color_hover']		= $_REQUEST['bott_color_hover'];
	$visual['bott_color_inact'] 	= $_REQUEST['bott_color_inact']; 
	$visual['bott_size'] 			= $_REQUEST['bott_size'];
	$visual['bott_style'] 			= $_REQUEST['bott_style'];
	$visual['bott_weight'] 			= $_REQUEST['bott_weight'];
	$visual['bott_decoration'] 		= $_REQUEST['bott_decoration'];
	$visual['bott_decoration_hover']= $_REQUEST['bott_decoration_hover'];
	
	// distances in the post
	$visual['dist_from_top'] 		= $_REQUEST['dist_from_top'];
	$visual['dist_search_title']	= $_REQUEST['dist_search_title'];
	$visual['dist_title_date'] 		= $_REQUEST['dist_title_date'];
	$visual['list_dist_title_date'] = $_REQUEST['list_dist_title_date'];
	$visual['dist_date_text'] 		= $_REQUEST['dist_date_text'];
	$visual['list_dist_date_text'] 	= $_REQUEST['list_dist_date_text'];
	$visual['dist_btw_items'] 		= $_REQUEST['dist_btw_items'];
	$visual['dist_link_title'] 		= $_REQUEST['dist_link_title'];	
	$visual['dist_comm_links'] 		= $_REQUEST['dist_comm_links'];
	$visual['dist_from_bottom'] 	= $_REQUEST['dist_from_bottom'];
	
	$visual = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual` ='".SafetyDB($visual)."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='visual_options'; 
  	$message = $lang['Message_Visual_options_saved']; 


} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsComm') {
		
	// comments visual options
	$visual['comm_bord_sides'] 	= $_REQUEST['comm_bord_sides'];
	$visual['comm_bord_style'] 	= $_REQUEST['comm_bord_style'];
	$visual['comm_bord_width'] 	= $_REQUEST['comm_bord_width'];
	$visual['comm_bord_color'] 	= $_REQUEST['comm_bord_color'];
	$visual['comm_padding'] 	= $_REQUEST['comm_padding'];
	$visual['comm_padd_dim'] 	= $_REQUEST['comm_padd_dim'];
	$visual['comm_bgr_color'] 	= $_REQUEST['comm_bgr_color'];	
	
	$visual['w_comm_font_family'] 	= $_REQUEST['w_comm_font_family'];
	$visual['w_comm_font_color'] 	= $_REQUEST['w_comm_font_color'];
	$visual['w_comm_font_size'] 	= $_REQUEST['w_comm_font_size']; 	 
	$visual['w_comm_font_style'] 	= $_REQUEST['w_comm_font_style'];
	$visual['w_comm_font_weight'] 	= $_REQUEST['w_comm_font_weight']; 
	
	$visual['name_font_color']	= $_REQUEST['name_font_color'];
	$visual['name_font_size'] 	= $_REQUEST['name_font_size']; 	 
	$visual['name_font_style'] 	= $_REQUEST['name_font_style'];
	$visual['name_font_weight'] = $_REQUEST['name_font_weight']; 
	
	$visual['comm_date_font'] 		= $_REQUEST['comm_date_font']; 
	$visual['comm_date_color'] 		= $_REQUEST['comm_date_color']; 
	$visual['comm_date_size'] 		= $_REQUEST['comm_date_size']; 
	$visual['comm_date_font_style']	= $_REQUEST['comm_date_font_style'];
	$visual['comm_date_format'] 	= $_REQUEST['comm_date_format']; 
	$visual['comm_showing_time'] 	= $_REQUEST['comm_showing_time'];
	
	$visual['comm_font_color']	= $_REQUEST['comm_font_color'];
	$visual['comm_font_size'] 	= $_REQUEST['comm_font_size']; 	 
	$visual['comm_font_style'] 	= $_REQUEST['comm_font_style'];
	$visual['comm_font_weight'] = $_REQUEST['comm_font_weight']; 
	
	$visual['leave_font_color'] = $_REQUEST['leave_font_color'];
	$visual['leave_font_size'] 	= $_REQUEST['leave_font_size']; 	 
	$visual['leave_font_weight']= $_REQUEST['leave_font_weight'];
	$visual['leave_font_style'] = $_REQUEST['leave_font_style']; 
	$visual['field_font_color'] = $_REQUEST['field_font_color'];
	$visual['field_font_size'] 	= $_REQUEST['field_font_size']; 	 
	$visual['field_font_style'] = $_REQUEST['field_font_style'];
	$visual['field_font_weight']= $_REQUEST['field_font_weight']; 
	$visual['req_font_color'] 	= $_REQUEST['req_font_color'];
	$visual['req_font_size'] 	= $_REQUEST['req_font_size'];
	
	// submit comment button style
	$visual['subm_color'] 		= $_REQUEST['subm_color']; 
	$visual['subm_bgr_color'] 	= $_REQUEST['subm_bgr_color']; 
	$visual['subm_brdr_color']	= $_REQUEST['subm_brdr_color']; 
	$visual['subm_bgr_color_on']= $_REQUEST['subm_bgr_color_on']; 
	$visual['subm_bor_radius'] 	= $_REQUEST['subm_bor_radius']; 
	$visual['subm_font_weight'] = $_REQUEST['subm_font_weight'];  
	$visual['subm_font_style'] 	= $_REQUEST['subm_font_style']; 
	
	$visual['dist_btw_comm'] 	= $_REQUEST['dist_btw_comm'];
	
		
	$visual_comm = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual_comm` = '".SafetyDB($visual_comm)."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='visual_options_comm'; 
  	$message = $lang['Message_Visual_comments_saved']; 
	
 
} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsLanguage') {
 	
	// main words in the front-end of the script
	$language['Back_home'] 			= $_REQUEST['Back_home'];
	$language['Search_button'] 		= $_REQUEST['Search_button'];
	$language['Category_all'] 		= $_REQUEST['Category_all']; 
	$language['Comments_link'] 		= $_REQUEST['Comments_link'];
	$language['Previous'] 			= $_REQUEST['Previous']; 
	$language['Next'] 				= $_REQUEST['Next'];  
	$language['No_Posts'] 			= $_REQUEST['No_Posts'];
	$language['Older_Post'] 		= $_REQUEST['Older_Post']; 
	$language['Home_bottom'] 		= $_REQUEST['Home_bottom']; 
	$language['Newer_Post'] 		= $_REQUEST['Newer_Post']; 
	
	// days of the week in the dates
	$language['Monday'] 	= $_REQUEST['Monday']; 
	$language['Tuesday'] 	= $_REQUEST['Tuesday'];
	$language['Wednesday'] 	= $_REQUEST['Wednesday'];
	$language['Thursday'] 	= $_REQUEST['Thursday']; 
	$language['Friday'] 	= $_REQUEST['Friday']; 
	$language['Saturday'] 	= $_REQUEST['Saturday'];
	$language['Sunday'] 	= $_REQUEST['Sunday'];
	
	// month names in the dates
	$language['January'] 	= $_REQUEST['January']; 
	$language['February'] 	= $_REQUEST['February'];
	$language['March'] 		= $_REQUEST['March'];
	$language['April'] 		= $_REQUEST['April']; 
	$language['May'] 		= $_REQUEST['May']; 
	$language['June'] 		= $_REQUEST['June'];
	$language['July'] 		= $_REQUEST['July'];
	$language['August'] 	= $_REQUEST['August'];
	$language['September'] 	= $_REQUEST['September']; 
	$language['October'] 	= $_REQUEST['October']; 
	$language['November'] 	= $_REQUEST['November'];
	$language['December'] 	= $_REQUEST['December'];	
	
	// about comments	
	$language['Word_Comments'] 			= $_REQUEST['Word_Comments'];
	$language['No_comments_posted'] 	= $_REQUEST['No_comments_posted'];
	$language['Leave_Comment'] 			= $_REQUEST['Leave_Comment'];
	$language['Comment_Name'] 			= $_REQUEST['Comment_Name'];	
	$language['Comment_Email'] 			= $_REQUEST['Comment_Email']; 	
	$language['Comment_here'] 			= $_REQUEST['Comment_here']; 
	$language['Enter_verification_code']= $_REQUEST['Enter_verification_code']; 
	$language['Required_fields'] 		= $_REQUEST['Required_fields']; 
	$language['Submit_Comment'] 		= $_REQUEST['Submit_Comment'];
	
	$language['Banned_word_used'] 			= $_REQUEST['Banned_word_used'];
	$language['Banned_ip_used'] 			= $_REQUEST['Banned_ip_used'];
	$language['Incorrect_verification_code']= $_REQUEST['Incorrect_verification_code']; 
	$language['Comment_Submitted'] 			= $_REQUEST['Comment_Submitted'];
	$language['After_Approval_Admin'] 		= $_REQUEST['After_Approval_Admin'];
	
	$language['required_fields']= $_REQUEST['required_fields']; 
	$language['correct_email'] 	= $_REQUEST['correct_email']; 
	$language['field_code'] 	= $_REQUEST['field_code']; 	
	
	$language['New_comment_posted'] = $_REQUEST['New_comment_posted'];
	
	$language['metatitle'] 	= $_REQUEST['metatitle']; 
	$language['metadescription'] = $_REQUEST['metadescription'];
	
	$language = base64_encode(serialize($language));
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `language` ='".$language."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='language_options'; 
  	$message = $lang['Message_Language_options_saved']; 


} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='addPost') {
	
	if (!isset($_REQUEST["post_comments"]) or $_REQUEST["post_comments"]=='') $_REQUEST["post_comments"] = 'false';

	$sql = "INSERT INTO ".$TABLE["Posts"]."
			SET `publish_date` 	= '".SafetyDB($_REQUEST["publish_date"])."', 
				`status` 		= '".$_REQUEST["status"]."',
				`cat_id` 		= '".$_REQUEST["cat_id"]."',
				`post_title` 	= '".SaveDB($_REQUEST["post_title"])."',
                `post_text` 	= '".SaveDB($_REQUEST["post_text"])."',
				`post_limit`	= '".SafetyDB($_REQUEST["post_limit"])."',
				`post_comments` = '".SafetyDB($_REQUEST["post_comments"])."', 
				`reviews` 		= '0'";
	$sql_result = sql_result($sql);
	$index_id = mysqli_insert_id($connDB);
	
	// upload thumbnail to the post
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) {
		
		$filexpl = explode(".", $_FILES["image"]['name']);
		$format = end($filexpl);					
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");			
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {

			$name = str_file_filter($_FILES['image']['name']);
			$name = $index_id . "_" . $name;

			$filePath = $CONFIG["upload_folder"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath, 0777);
				Resize_File($filePath, 800, 0); 
	
				$sql = "UPDATE ".$TABLE["Posts"]."  
						SET `image` = '".$name."'  
						WHERE `id`='".$index_id."'";
				$sql_result = sql_result($sql);
				$message .= '';
			} else {
				$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folder"].'" directory! ';  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	} else { $message = $lang['Message_Image_file_is_not_uploaded']; }	
	
	$message = $lang['Message_Post_added']; 	
	$_REQUEST["act"]='posts'; 

} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='updatePost') {

	if (!isset($_REQUEST["post_comments"]) or $_REQUEST["post_comments"]=='') $_REQUEST["post_comments"] = 'false';

	$sql = "UPDATE ".$TABLE["Posts"]." 
			SET `publish_date`	= '".SafetyDB($_REQUEST["publish_date"])."', 
				`status` 		= '".$_REQUEST["status"]."',
				`cat_id` 		= '".$_REQUEST["cat_id"]."',
                `post_title` 	= '".SaveDB($_REQUEST["post_title"])."',
                `post_text` 	= '".SaveDB($_REQUEST["post_text"])."',
				`post_limit`	= '".SafetyDB($_REQUEST["post_limit"])."',
				`post_comments` = '".SafetyDB($_REQUEST["post_comments"])."' 
			WHERE id='".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);	
	
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id = '".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	
	$index_id = SafetyDB($_REQUEST["id"]);
	
	// upload thumbnail to the post
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) { 
	
		$filexpl = explode(".", $_FILES["image"]['name']);
	  	$format = end($filexpl);			
	  	$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
	  	if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {
		
			if($image != "") unlink($CONFIG["upload_folder"].$image);
			
			$name = str_file_filter($_FILES['image']['name']);
			$name = $index_id . "_" . $name;
			
			$filePath = $CONFIG["upload_folder"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath,0777); 				
				Resize_File($filePath, 800, 0); 
				
				$sql = "UPDATE `".$TABLE["Posts"]."` 
						SET `image` = '".SafetyDB($name)."' 
						WHERE `id` = '".$index_id."'";
				$sql_result = sql_result($sql);
			} else {
				$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folder"].'" directory.';  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	}
	
	if(isset($_REQUEST["updatepreview"]) and $_REQUEST["updatepreview"]!='') {
		$_REQUEST["act"]='viewPost'; 		
	} else {
		$_REQUEST["act"]='posts'; 
	}	
	$message .= $lang['Message_Post_updated']; 
	

} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='delPost') {

	$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE `post_id`='".SafetyDB($_REQUEST["id"])."'";
   	$sql_result = sql_result($sql);
	
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE `id` = '".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);

	$sql = "DELETE FROM ".$TABLE["Posts"]." WHERE `id`='".SafetyDB($_REQUEST["id"])."'";
   	$sql_result = sql_result($sql);
 	$_REQUEST["act"]='posts'; 
	$message = $lang['Message_Post_deleted']; 
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=="delImage") { 
	
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE `id` = '".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	
	$sql = "UPDATE `".$TABLE["Posts"]."` SET `image` = '' WHERE id = '".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	
	$message = $lang['Message_Image_deleted'];
	$_REQUEST["act"] = "editPost";	

	
} elseif (isset($_REQUEST["act2"]) and $_REQUEST["act2"]=="change_status_post") { 
	
	$sql = "UPDATE ".$TABLE["Posts"]." 
			SET `status` = '".SafetyDB($_REQUEST["status"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	
	$message = $lang['Message_Status_updated'];
	$_REQUEST["act"] = "posts";

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addCat"){

    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE `cat_name` = '".SafetyDB(trim($_REQUEST["cat_name"]))."'";
    $sql_result = sql_result($sql);
    if(mysqli_num_rows($sql_result) == 0) {

        $sql = "INSERT INTO ".$TABLE["Categories"]."
				SET `cat_name` = '".SafetyDB($_REQUEST["cat_name"])."'";
        $sql_result = sql_result($sql);

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_added'];

    } else {
        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_exist'];
    }


} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "updateCat"){

    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE cat_name='".SafetyDB($_REQUEST["cat_name"])."'";
    $sql_result = sql_result($sql);
    if(mysqli_num_rows($sql_result)>1) {

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_exist'];

    } else {

        $sql = "UPDATE ".$TABLE["Categories"]."
				SET `cat_name` = '".SafetyDB($_REQUEST["cat_name"])."'
				WHERE id='".$_REQUEST["id"]."'";
        $sql_result = sql_result($sql);

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_updated'];

    }

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='delCat') {

    $sql = "DELETE FROM ".$TABLE["Categories"]." WHERE id='".SafetyDB($_REQUEST["id"])."'";
    $sql_result = sql_result($sql);
    $_REQUEST["act"]='cats';
    $message = $lang['Message_Categ_deleted'];
	

} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateComment') {

	$sql = "UPDATE ".$TABLE["Comments"]." 
			SET status	='".$_REQUEST["status"]."', 
				name	='".SafetyDB($_REQUEST["name"])."', 
				email	='".SafetyDB($_REQUEST["email"])."', 
				comment	='".SafetyDB($_REQUEST["comment"])."' 
			WHERE id='".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='comments'; 
	$message = $lang['Message_Comment_saved'];
	
} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='BanIP') {

	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `ban_ips` =  CONCAT(`ban_ips`, ', ".SafetyDB($_REQUEST["ip_addr"])."')";
	$sql_result = sql_result($sql);
	
	$_REQUEST["act"]='comments'; 
	$message = 'IP '.$_REQUEST["ip_addr"].' banned! ';


} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='delComment') {

	$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE id='".SafetyDB($_REQUEST["id"])."'";
   	$sql_result = sql_result($sql);
 	$_REQUEST["act"]='comments'; 
	$message = $lang['Message_Comment_deleted']; 
	
} elseif(isset($_REQUEST["act2"]) and $_REQUEST["act2"]=='delCommBulk') {
	
	if(isset($_REQUEST['delCommBulkArr'])) {
		foreach($_REQUEST['delCommBulkArr'] as $id) {
			
			$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE id='".$id."'";
			$sql_result = sql_result($sql);
			
		}
		$message .= $lang['Message_Selected_Comment_deleted']; 
	} else {
		$message .= $lang['Message_Comment_not_selected']; 
	}
	$_REQUEST["act"]='comments'; 	

} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=="change_status_comm") { 
	
	$sql = "UPDATE ".$TABLE["Comments"]." 
			SET status = '".SafetyDB($_REQUEST["status"])."' 
			WHERE id='".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	
	$message = $lang['Message_Status_Updated']; 
	$_REQUEST["act"] = "comments";
}

if (!isset($_REQUEST["act"]) or $_REQUEST["act"]=='') $_REQUEST["act"]='posts';
	
$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}
$_SESSION['KCFINDER'] = array(
    'disabled' => false
);
?> 


<div class="menuButtons">
    <div class="menuButton"><a<?php if($_REQUEST['act']=='posts' or $_REQUEST['act']=='newPost' or $_REQUEST['act']=='editPost' or $_REQUEST['act']=='viewPost' or $_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=posts"><span><?php echo $lang['menu_Button_1']; ?></span></a></div>
    <div class="menuButton"><a<?php if($_REQUEST['act']=='comments' or $_REQUEST['act']=='editComment') echo ' class="selected"'; ?> href="admin.php?act=comments"><span><?php echo $lang['menu_Button_2']; ?></span></a></div>
    <div class="menuButton"><a<?php if($_REQUEST['act']=='cats' or $_REQUEST['act']=='newCat' or $_REQUEST['act']=='editCat' or $_REQUEST['act']=='HTML_Cat') echo ' class="selected"'; ?> href="admin.php?act=cats"><span><?php echo $lang['menu_Button_3']; ?></span></a></div>
    <div class="menuButton"><a<?php if($_REQUEST['act']=='admin_options' or $_REQUEST['act']=='post_options' or $_REQUEST['act']=='visual_options' or $_REQUEST['act']=='visual_options_comm' or $_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=admin_options"><span><?php echo $lang['menu_Button_4']; ?></span></a></div>
    <div class="menuButton"><a<?php if($_REQUEST['act']=='html') echo ' class="selected"'; ?> href="admin.php?act=html"><span><?php echo $lang['menu_Button_5']; ?></span></a></div>
    <div class="clear"></div> 
</div>
	

<div class="admin_wrapper">


<?php
if ($_REQUEST["act"]=='posts' or $_REQUEST["act"]=='newPost' or $_REQUEST["act"]=='editPost' or $_REQUEST["act"]=='viewPost' or $_REQUEST["act"]=='rss') {
?>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='posts') echo ' class="selected"'; ?> href="admin.php?act=posts"><?php echo $lang['submenu1_button1']; ?></a></div>	
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newPost') echo ' class="selected"'; ?> href="admin.php?act=newPost"><?php echo $lang['submenu1_button2']; ?></a></div>
	<div class="menuSubButton"><a href="preview.php" target="_blank"><?php echo $lang['submenu1_button3']; ?></a></div>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=rss"><?php echo $lang['submenu1_button4']; ?></a></div>
	<div class="clear"></div>        

<?php
} elseif ($_REQUEST["act"]=='cats' or $_REQUEST["act"]=='newCat' or $_REQUEST["act"]=='editCat' or $_REQUEST['act']=='HTML_Cat') {
    ?>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='cats') echo ' class="selected"'; ?> href="admin.php?act=cats"><?php echo $lang['submenu3_button1']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newCat') echo ' class="selected"'; ?> href="admin.php?act=newCat"><?php echo $lang['submenu3_button2']; ?></a></div>
    <div class="clear"></div> 


<?php 
} elseif ($_REQUEST["act"]=='admin_options' or $_REQUEST["act"]=='post_options' or $_REQUEST["act"]=='visual_options' or $_REQUEST["act"]=='visual_options_comm' or $_REQUEST["act"]=='language_options') { 
?>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='admin_options') echo ' class="selected"'; ?> href="admin.php?act=admin_options"><?php echo $lang['submenu2_button1']; ?></a></div>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='post_options') echo ' class="selected"'; ?> href="admin.php?act=post_options"><?php echo $lang['submenu2_button2']; ?></a></div>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options') echo ' class="selected"'; ?> href="admin.php?act=visual_options"><?php echo $lang['submenu2_button3']; ?></a></div>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options_comm') echo ' class="selected"'; ?> href="admin.php?act=visual_options_comm"><?php echo $lang['submenu2_button4']; ?></a></div>
	<div class="menuSubButton"><a<?php if($_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=language_options"><?php echo $lang['submenu2_button5']; ?></a></div>
	<div class="clear"></div>        
<?php } ?>



	<?php if(isset($message) and $message!='') {?>
    <div class="message<?php if($_REQUEST['act']=='comments' or $_REQUEST['act']=='editComment') echo ' comm_marg'; ?>"><?php echo $message; ?></div>
    <?php } ?>
    <script type="text/javascript">	
	jQuery.noConflict();
	jQuery(document).ready(function(){
		setTimeout(function(){
			jQuery("div.message").fadeOut("slow", function () {
				jQuery("div.message").remove();
			});
	 
		}, 3500);
	 });
	</script>
    

<?php 
if ($_REQUEST["act"]=='posts') {
	
	if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') {
		$_REQUEST["search"] = htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES);
	} else { 
		$_REQUEST["search"] = ''; 
	}
	if(!isset($_REQUEST["orderBy"]))  $_REQUEST["orderBy"] = ''; 
	if(!isset($_REQUEST["orderType"])) $_REQUEST["orderType"] = ''; 
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']); 
	$OptionsLang = unserialize( base64_decode( $Options['language']));
	
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("publish_date", "post_title", "cat_id", "status", "count", "reviews");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "publish_date";
	}
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "DESC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
	
	$sqlPosted = "SELECT id FROM ".$TABLE["Posts"]." WHERE status='Posted'";
	$sql_resultPosted = sql_result($sqlPosted);
	$Posted = mysqli_num_rows($sql_resultPosted);
?>
	<div class="pageDescr"><?php echo $lang['List_Dashboard1']; ?> <strong style="font-size:16px"><?php echo $Posted; ?></strong> <?php echo $lang['List_Dashboard2']; ?></div>
    
    <div class="searchForm">
    <form action="admin.php?act=posts" method="post" name="form" class="formStyle">
      <input type="text" name="search" value="<?php echo urldecode($_REQUEST["search"]); ?>" class="searchfield" placeholder="<?php echo $lang['List_Search_placeholder']; ?>" />
      <input type="submit" value="<?php echo $lang['List_Search_Button']; ?>" class="submitButton" />
    </form>
    </div>
    
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td width="20%" class="headlist"><a href="admin.php?act=posts&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['List_Date_published']; ?></a></td>
        <td class="headlist"><a href="admin.php?act=posts&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=post_title"><?php echo $lang['List_Title']; ?></a></td>
        <td width="11%" class="headlist"><a href="admin.php?act=posts&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=cat_id"><?php echo $lang['List_Category']; ?></a></td>
        <td width="10%" class="headlist"><a href="admin.php?act=posts&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['List_Status']; ?></a></td>
        <td width="9%" class="headlist"><a href="admin.php?act=posts&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=count"><?php echo $lang['List_Comments']; ?></a></td>
        <td width="9%" class="headlist"><a href="admin.php?act=posts&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews"><?php echo $lang['List_Views']; ?></a></td>
        <td class="headlist" colspan="3">&nbsp;</td>
  	  </tr>
      
  	<?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	  $findMe = trim(SafetyDB($_REQUEST["search"]));
	  $search = "WHERE (post_title LIKE '%".$findMe."%' OR post_text LIKE '%".$findMe."%')";
	} else {
	  $search = '';
	}

	$sql   = "SELECT count(*) as total FROM ".$TABLE["Posts"]." ".$search;
	$sql_result = sql_result($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/50);
			
	$sql = "SELECT DISTINCT b.*, (SELECT count(*) FROM `".$TABLE["Comments"]."` AS bc WHERE bc.post_id = c.post_id) AS count
			FROM `".$TABLE["Posts"]."` AS b LEFT JOIN `".$TABLE["Comments"]."` AS c ON b.id = c.post_id ".$search."
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*50 . ",50";
	$sql_result = sql_result($sql);
	
	if (mysqli_num_rows($sql_result)>0) {
		$i=1;
		while ($Post = mysqli_fetch_assoc($sql_result)) {
	?>
  	  <tr>
        <td class="bodylist"><?php echo admin_date($Post["publish_date"]); ?></td>
        <td class="bodylist"><?php echo $Post["post_title"]; ?></td>
        <td class="bodylist">
              <?php
              $sqlCat = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$Post["cat_id"]."'";
              $sql_resultCat = sql_result($sqlCat);
              $Cat = mysqli_fetch_assoc($sql_resultCat);
              if($Cat["id"]>0) echo ReadDB($Cat["cat_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist">
        	<form action="admin.php?act=posts" method="post" name="form<?php echo $i; ?>" class="formStyle">
            <input type="hidden" name="act2" value="change_status_post" />
            <input type="hidden" name="id" value="<?php echo $Post["id"]; ?>" />
            <select name="status" onChange="document.form<?php echo $i; ?>.submit()">
                <option value="Posted"<?php if($Post['status']=='Posted') echo " selected='selected'"; ?>>Posted</option>
                <option value="Hidden"<?php if($Post['status']=='Hidden') echo " selected='selected'"; ?>>Hidden</option>
            </select>
            </form>	
        </td>
        <td class="bodylist"><a style="text-decoration:none" href="admin.php?act=comments&post_id=<?php echo $Post["id"]; ?>"><?php echo $Post["count"]; ?></a> <?php if($Post["post_comments"]=='false') echo "<sub>(not allowed)</sub>"; ?></td>
        <td class="bodylist"><?php if($Post["reviews"]=='') echo "0"; else echo $Post["reviews"]; ?></td>
        <td class="bodylistAct"><a class="view" href='admin.php?act=viewPost&id=<?php echo $Post["id"]; ?>' title="Preview"><img class="act" src="images/preview.png" alt="Preview" /></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editPost&amp;id=<?php echo $Post["id"]; ?>&amp;p=<?php if(isset($_REQUEST["p"])) echo $_REQUEST["p"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delPost&amp;id=<?php echo $Post["id"]; ?>&amp;p=<?php if(isset($_REQUEST["p"])) echo $_REQUEST["p"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
  	  </tr>
  	<?php 
			$i++;
		}
		mysqli_free_result($sql_result);
	} else {
	?>
      <tr>
      	<td colspan="9" class="borderBottomList"><?php echo $lang['List_No_Entries']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>1) {
    ?>
  	  <tr>
      	<td colspan="9" class="bottomlist"><div class='paging'><?php echo $lang['List_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=posts&amp;p=".$i."&amp;search=".$_REQUEST["search"]."&amp;orderBy=".$_REQUEST["orderBy"]."&amp;orderType=".$_REQUEST["orderType"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>


<?php 
} elseif ($_REQUEST["act"]=='newPost') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="addPost" />
  	<div class="pageDescr"><?php echo $lang['Create_Listing_Dashboard']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Create_Listing_Header']; ?></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Listing_Date']; ?></td>
        <td class="formRight">
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
        </td>
      </tr>      
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_Listing_Status']; ?></td>
      	<td class="formRight">
        <select name="status">
          <option value="Posted"><?php echo $lang['Create_Listing_Posted']; ?></option>
          <option value="Hidden"><?php echo $lang['Create_Listing_Hidden']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
        <td><?php echo $lang['Create_Listing_Category']; ?> </td>
        <td>
            <select name="cat_id">
                <option value="0">---------</option>
                <?php
                $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
                $sql_result = sql_result($sql);
                if (mysqli_num_rows($sql_result)>0) {
                    while ($Cat = mysqli_fetch_assoc($sql_result)) {
                        ?>
                        <option value="<?php echo $Cat["id"]; ?>"><?php echo ReadDB($Cat["cat_name"]); ?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Listing_Title']; ?></td>
        <td class="formRight"><input class="input_post" type="text" name="post_title" /></td>
      </tr>     
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Listing_Thumbnail']; ?></td>
        <td class="formRight"><input type="file" name="image" size="80" /> <sub><?php echo $lang['Create_Listing_Limit_Mb']; ?></sub></td>
      </tr>   
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Create_Listing_Message']; ?></td>
        <td class="formRight">        	
            <textarea name="post_text" id="post_text" class="post_text"></textarea>
        	<script type="text/javascript">
				CKEDITOR.replace( 'post_text',
                {	
					
					filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
					filebrowserUploadUrl  :'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
					filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
					filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash',
									
					height: 400, width: '98%'

				});
			</script>  
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Listing_CharNum']; ?></td>
        <td class="formRight">
        	<input type="text" name="post_limit" size="4" value="<?php if(isset($Options["post_limit"])) echo $Options["post_limit"]; ?>" onkeypress='return isNumberKey(event)' />
            <sub><?php echo $lang['Create_Listing_CharNum_note']; ?></sub>
        </td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_Listing_Comments_al']; ?></td>
      	<td class="formRight"><input name="post_comments" type="checkbox" value="true"<?php if ($Options["commentsoff"]!='yes') echo ' checked="checked"'; ?> /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Create_Listing_Save']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>


<?php 
} elseif ($_REQUEST["act"]=='editPost') {
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$Post = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);

	$sqlC   = "SELECT count(*) FROM ".$TABLE["Comments"]." WHERE post_id='".$Post["id"]."'";
	$sql_resultC = sql_result($sqlC);
	$count = mysqli_fetch_array($sql_resultC);
	mysqli_free_result($sql_resultC);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="updatePost" />
  	<input type="hidden" name="id" value="<?php echo $Post["id"]; ?>" />
  	<input type="hidden" name="p" value="<?php echo $_REQUEST["p"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['Edit_Listing_Dashboard']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Edit_Listing_Header']; ?></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Listing_Date']; ?></td>
        <td class="formRight">
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo $Post["publish_date"]; ?>" readonly /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Listing_Comments']; ?></td>
      	<td class="formRight"><?php echo $count["count(*)"]; ?> (<a href="admin.php?act=comments&post_id=<?php echo $Post["id"]; ?>"><?php echo $lang['Edit_Listing_Comments_view']; ?></a>)</td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Listing_Status']; ?></td>
      	<td class="formRight">
        <select name="status">
          <option value="Posted"<?php if ($Post["status"]=='Posted') echo ' selected="selected"'; ?>><?php echo $lang['Edit_Listing_Posted']; ?></option>
          <option value="Hidden"<?php if ($Post["status"]=='Hidden') echo ' selected="selected"'; ?>><?php echo $lang['Edit_Listing_Hidden']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
        <td><?php echo $lang['Edit_Listing_Category']; ?> </td>
        <td>
            <select name="cat_id">
                <option value="0">---------</option>
                <?php
                $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
                $sql_result = sql_result($sql);
                if (mysqli_num_rows($sql_result)>0) {
                    while ($Cat = mysqli_fetch_assoc($sql_result)) {
                        ?>
                        <option value="<?php echo $Cat["id"]; ?>"<?php if($Cat["id"]==$Post["cat_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Listing_Title']; ?></td>
        <td class="formRight"><input class="input_post" type="text" name="post_title" value="<?php echo $Post["post_title"]; ?>" /></td>
      </tr>     
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Listing_Thumbnail']; ?></td>
        <td class="formRight">
        <?php if(ReadDB($Post["image"]) != "") { ?>
			<img src="<?php echo $CONFIG["upload_folder"].ReadDB($Post["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delImage&id=<?php echo $Post["id"]; ?>"><?php echo $lang['Edit_Listing_delete']; ?></a><br /> 
            <?php echo $lang['Edit_Listing_If_you_upload']; ?> <br />
            <?php } ?>
          	<input type="file" name="image" size="70" /> <sub><?php echo $lang['Edit_Listing_Limit_Mb']; ?></sub>
        </td>
      </tr>   
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Edit_Listing_Message']; ?></td>
        <td class="formRight">
            <textarea name="post_text" id="post_text" class="post_text"><?php echo $Post["post_text"]; ?></textarea>
            <script type="text/javascript">
				CKEDITOR.replace( 'post_text',
                {	
					
					filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
					filebrowserUploadUrl  :'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
					filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
					filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash',
									
					height: 400, width: '98%'

				});
			</script>  
        </td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Listing_CharNum']; ?></td>
        <td class="formRight">
        	<input type="text" name="post_limit" size="4" value="<?php if(isset($Post["post_limit"])) echo $Post["post_limit"]; ?>" onkeypress='return isNumberKey(event)' />
            <sub><?php echo $lang['Edit_Listing_CharNum_note']; ?></sub>
        </td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Listing_Comments_al']; ?></td>
      	<td class="formRight"><input name="post_comments" type="checkbox" value="true"<?php if($Post["post_comments"]=='true') echo ' checked="checked"'; ?> /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="formRight"><input name="submit3" type="submit" value="<?php echo $lang['Edit_Listing_Update']; ?>" class="submitButton" /> &nbsp; &nbsp; &nbsp; &nbsp; 
        	<input name="updatepreview" type="submit" value="<?php echo $lang['Edit_Listing_Update_View']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>

<?php 
} elseif ($_REQUEST["act"]=='viewPost') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize( base64_decode( $Options['language']));
	
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	$Post = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	
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
?>
<script src="lightbox/js/jquery-1.11.0.min.js"></script>
<script src="lightbox/js/lightbox.min.js"></script>
<link href="lightbox/css/lightbox.css" rel="stylesheet" />
<?php include("styles/css_front_end.php"); ?>
<script type="text/javascript" src="include/textsizer.js">
/***********************************************
* Document Text Sizer- Copyright 2003 - Taewook Kang.  All rights reserved.
* Coded by: Taewook Kang (http://www.txkang.com)
***********************************************/
</script>

<div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="admin.php?act=editPost&id=<?php echo ReadDB($Post['id']); ?>"><?php echo $lang['Preview_Edit_Item']; ?></a></div>

<div style="background-color:<?php echo $OptionsVis["gen_bgr_color"];?>;">
<div class="front_end_wrapper">
    
    <!-- post title -->
    <div class="post_title"><?php echo $Post["post_title"]; ?></div>
    
    <div class="dist_title_date"></div>
    
    <!-- post date --> 
    <?php if($OptionsVis["show_date"]!='no' or $OptionsVis["show_aa"]!='no') { ?>   
    <div class="date_style">
    	<?php if($OptionsVis["show_date"]!='no') { ?>  
        <?php echo lang_date(date($OptionsVis["date_format"],strtotime($Post["publish_date"]))); ?> 
        <?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($Post["publish_date"])); ?>
        <?php } ?>
        <?php if($OptionsVis["show_aa"]!='no') { ?>
        &nbsp;&nbsp;&nbsp;&nbsp;<a style="text-decoration:none;color:#999;font-size:<?php echo $OptionsVis["date_size"];?>;" href="javascript:ts('post_text',+1)">A<sup>+</sup></a> | <a style="text-decoration:none;color:#999;font-size:<?php echo $OptionsVis["date_size"];?>;" href="javascript:ts('post_text',-1)">a<sup>-</sup></a>
        <?php } ?>
    </div>
    <?php } ?>
    
    <div class="dist_date_text"></div>
    
    <!-- post text --> 
    <div id="post_text" class="post_text"><?php echo $Post["post_text"]; ?></div>
    <div class="clearboth"></div>  
</div> 
</div>



<?php
} elseif ($_REQUEST["act"]=='cats') {

    if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') {
        $pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
        if($pageNum<=0) $pageNum = 1;
    } else {
        $pageNum = 1;
    }

    $orderByArr = array("cat_name");
    if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) {
    	$orderBy = $_REQUEST["orderBy"];
    } else {
    	$orderBy = "cat_name";
    }

    $orderTypeArr = array("DESC", "ASC");
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) {
    	$orderType = $_REQUEST["orderType"];
    } else {
    	$orderType = "ASC";
    }
    if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
    ?>
    <div class="pageDescr"><?php echo $lang['Category_Below_is_a_list']; ?></div>

    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
        <tr>
            <td width="66%" class="headlist"><a href="admin.php?act=cats&orderType=<?php echo $norderType; ?>&orderBy=cat_name"><?php echo $lang['Category_Category']; ?></a></td>
            <td class="headlist" colspan="2">&nbsp;</td>
        </tr>

        <?php
        $sql   = "SELECT count(*) as total FROM ".$TABLE["Categories"];
        $sql_result = sql_result($sql);
        $row   = mysqli_fetch_array($sql_result);
        mysqli_free_result($sql_result);
        $count = $row["total"];
        $pages = ceil($count/50);

        $sql = "SELECT * FROM ".$TABLE["Categories"]."
			ORDER BY " . $orderBy . " " . $orderType."
			LIMIT " . ($pageNum-1)*50 . ",50";
        $sql_result = sql_result($sql);

        if (mysqli_num_rows($sql_result)>0) {
            while ($Cat = mysqli_fetch_assoc($sql_result)) {
                ?>
                <tr>
                    <td class="bodylist"><?php echo ReadDB($Cat["cat_name"]); ?></td>

                    <td class="bodylistAct"><a href='admin.php?act=editCat&id=<?php echo $Cat["id"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
                    <td class="bodylistAct"><a class="delete" href="admin.php?act=delCat&id=<?php echo $Cat["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>

                </tr>
                <?php 
            }
        } else {
            ?>
            <tr>
                <td colspan="8" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['Category_No_Categories']; ?></td>
            </tr>
        <?php
        }
        ?>

        <?php
        if ($pages>1) {
            ?>
            <tr>
                <td colspan="8" class="bottomlist"><div class='paging'><?php echo $lang['Category_Page']; ?> </div>
                    <?php
                    for($i=1;$i<=$pages;$i++){
                        if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
                        else echo "<a href='admin.php?act=cats&p=".$i."' class='paging'>".$i."</a>";
                        echo "&nbsp; ";
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>


<?php
} elseif ($_REQUEST["act"]=='newCat') {
    ?>
    <form action="admin.php" method="post" name="form">
        <input type="hidden" name="act" value="addCat" />
        <div class="pageDescr"><?php echo $lang['Category_To_create_Category']; ?></div>
        <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
            <tr>
                <td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Create_Category']; ?></td>
            </tr>

            <tr>
                <td class="formLeft"><?php echo $lang['Category_Category_name']; ?></td>
                <td><input type="text" name="cat_name" size="40" maxlength="250" /></td>

            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><input name="submit" type="submit" value="<?php echo $lang['Category_Create_Category_but']; ?>" class="submitButton" /></td>
            </tr>
        </table>
    </form>

<?php
} elseif ($_REQUEST["act"]=='editCat') {
    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
    $sql_result = sql_result($sql);
    $Cat = mysqli_fetch_assoc($sql_result);
?>
    <form action="admin.php" method="post" name="form">
        <input type="hidden" name="act" value="updateCat" />
        <input type="hidden" name="id" value="<?php echo $Cat["id"]; ?>" />
        <div class="pageDescr"><?php echo $lang['Category_change_details']; ?></div>
        <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
            <tr>
                <td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Edit_Category']; ?></td>
            </tr>

            <tr>
                <td class="formLeft"><?php echo $lang['Category_Category_name_edit']; ?></td>
                <td><input type="text" name="cat_name" size="40" maxlength="250" value="<?php echo ReadHTML($Cat["cat_name"]); ?>" /></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>
                    <input name="submit" type="submit" value="<?php echo $lang['Category_Update_Category']; ?>" class="submitButton" />
                </td>
            </tr>
        </table>
    </form>



<?php 
} elseif ($_REQUEST["act"]=='comments') {
	
	if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') {
		$_REQUEST["search"] = htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES);
	} else { 
		$_REQUEST["search"] = ''; 
	}
	if(!isset($_REQUEST["orderBy"]))  $_REQUEST["orderBy"] = ''; 
	if(!isset($_REQUEST["orderType"])) $_REQUEST["orderType"] = ''; 
	if(!isset($_REQUEST["post_id"])) $_REQUEST["post_id"] = ''; 
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	
    if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
    $orderByArr = array("publish_date", "name", "status");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "publish_date";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "DESC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
?>

	<div class="pageDescr"><?php echo $lang['Comments_Dashboard']; ?></div>
    
    <div class="searchForm">    
    <form action="admin.php?act=comments&post_id=<?php echo $_REQUEST["post_id"]; ?>" method="post" name="form" class="formStyle">
      <input type="text" name="search" value="<?php echo $_REQUEST["search"]; ?>" class="searchfield" placeholder="enter poster Name or Email" />
      <input type="submit" value="<?php echo $lang['Comments_Search_Button']; ?>" class="submitButton" />
    </form>
	</div>
    
	<?php
	if (isset($_REQUEST["post_id"]) and $_REQUEST["post_id"]>0) {
	  $sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".$_REQUEST["post_id"]."'";
	  $sql_resultP = sql_result($sql);
	  $Post = mysqli_fetch_assoc($sql_resultP);
	  mysqli_free_result($sql_resultP);
	?>
	<div class="pageDescr"><?php echo $lang['Comments_Dashboard2_1']; ?> "<?php echo $Post["post_title"]; ?>". <a href="admin.php?act=comments"><?php echo $lang['Comments_Dashboard2_2']; ?></a>.</div>
	<?php	
    }
    ?>
    <form action="admin.php" method="post" name="formdelcomm" class="formStyle">
    <input type="hidden" name="act2" value="delCommBulk" />
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
      	<td width="18%" class="headlist"><a href="admin.php?act=comments&post_id=<?php echo $_REQUEST["post_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['Comments_Date']; ?></a></td>
      	<td width="15%" class="headlist"><a href="admin.php?act=comments&post_id=<?php echo $_REQUEST["post_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=name"><?php echo $lang['Comments_Name']; ?></a></td>
      	<td width="14%" class="headlist"><a href="admin.php?act=comments&post_id=<?php echo $_REQUEST["post_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['Comments_Status']; ?></a></td>
      	<td class="headlist"><?php echo $lang['Comments_on_post']; ?></td>        
        <td width="17%" class="headlist"><?php echo $lang['Comments_IP_address']; ?></td>
        <script language="JavaScript">		
		function CheckedAll(){    
		 if (document.getElementById('ChkAll').checked) {
			 for(i=0; i<document.getElementsByTagName('input').length;i++){
			 document.getElementsByTagName('input')[i].checked = true;
			 }
		 }
		 else {
			 for(i=0; i<document.getElementsByTagName('input').length;i++){
			  document.getElementsByTagName('input')[i].checked = false;
			 }
		 }
		}
		</script>
      	<td colspan="3" class="headlistComm"><label><input id="ChkAll" type="checkbox" onchange="javascript:CheckedAll();" /><span><?php echo $lang['Comments_SelectAll']; ?></span></label></td>
      </tr>
      
    <?php 
	$search = '';
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
		$find = SafetyDB($_REQUEST["search"]);
		$search .= "WHERE (name LIKE '%".$find."%' OR email LIKE '%".$find."%' OR comment LIKE '%".$find."%')";
		if (isset($_REQUEST["post_id"]) and $_REQUEST["post_id"]>0) $search .= " AND post_id='".SafetyDB($_REQUEST["post_id"])."'";
	} else {
		if (isset($_REQUEST["post_id"]) and $_REQUEST["post_id"]>0) {
			$search .= "WHERE post_id='".SafetyDB($_REQUEST["post_id"])."'";
		} 
	}
	
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Comments"]." ".$search;
	$sql_result = sql_result($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/100);

	$sql = "SELECT * FROM ".$TABLE["Comments"]." ".$search." 
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*100 . ",100";
	$sql_result = sql_result($sql);
	
	if (mysqli_num_rows($sql_result)>0) {
		
		while ($Comments = mysqli_fetch_assoc($sql_result)) {
			$sqlP = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".$Comments["post_id"]."'";
			$sql_resultP = sql_result($sqlP);
			$Post = mysqli_fetch_assoc($sql_resultP);
	?>
      <tr>
        <td class="bodylist"><?php echo admin_date($Comments["publish_date"]); ?></td>
        <td class="bodylist"><?php echo ReadHTML($Comments["name"]); ?></td>
        <td class="bodylist">
            <select name="status" onchange="window.location.href='admin.php?status='+this.value+'&act=change_status_comm&id=<?php echo $Comments["id"]; ?>'">
				<option value="Approved" <?php if($Comments['status']=='Approved') echo "selected='selected'"; ?>><?php echo $lang['Comments_Approved']; ?></option>
				<option value="Not approved" <?php if($Comments['status']=='Not approved') echo "selected='selected'"; ?>><?php echo $lang['Comments_Not_approved']; ?></option>
            </select>		
        </td>
        <td class="bodylist"><?php echo cutStrHTML($Post["post_title"],0,80); ?></td>
        
        
        <?php 
		$IPAllowed = true;
		$BannedIPs = explode(",", ReadDB($Options["ban_ips"]));
		if (count($BannedIPs)>0) {
		  $checkIP = strtolower(ReadDB($Comments["ipaddress"]));
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
		?>        
        <td class="bodylist"><?php echo ReadDB($Comments["ipaddress"]); ?> - <?php if($IPAllowed == false) { ?><span style="color:#F00">Banned</span><?php } else { ?><a class="view" href='admin.php?act=BanIP&ip_addr=<?php echo ReadDB($Comments["ipaddress"]); ?>' onclick="return confirm('Are you sure you want to ban IP - <?php echo ReadDB($Comments["ipaddress"]); ?> ?');">Ban</a><?php } ?></td>
        
        <td class="bodylistAct"><input name="delCommBulkArr[]" type="checkbox" value="<?php echo $Comments["id"]; ?>" /></td>
        
        <td class="bodylistAct"><a href='admin.php?act=editComment&id=<?php echo $Comments["id"]; ?>&search=<?php if(isset($_REQUEST["search"])) echo $_REQUEST["search"]; ?>&post_id=<?php if(isset($_REQUEST["post_id"])) echo $_REQUEST["post_id"]; ?>&p=<?php if(isset($_REQUEST["p"])) echo $_REQUEST["p"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delComment&id=<?php echo $Comments["id"]; ?>&search=<?php if(isset($_REQUEST["search"])) echo $_REQUEST["search"]; ?>&post_id=<?php if(isset($_REQUEST["post_id"])) echo $_REQUEST["post_id"]; ?>&p=<?php if(isset($_REQUEST["p"])) echo $_REQUEST["p"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
      </tr>
    <?php 
		}
		mysqli_free_result($sql_result);
	} else {
	?>
      <tr>
      	<td colspan="8" class="borderBottomList"><?php echo $lang['Comments_No_Comments']; ?></td>        
      </tr>      
    <?php	
	}
	?>

	<?php
    if ($pages>0) {
    ?>
      <tr>
    	<td colspan="5" class="bottomlist"><div class='paging'><?php echo $lang['Comments_Page']; ?> </div> 
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=comments&amp;p=".$i."&amp;search=".$_REQUEST["search"]."&amp;post_id=".$_REQUEST["post_id"]."&amp;orderBy=".$_REQUEST["orderBy"]."&amp;orderType=".$_REQUEST["orderType"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        } 
        ?>
		</td>
        <td colspan="3" class="bottomlist">
        	<div style="text-align:left;"><input class="delete_comm" name="submit" type="submit" value="<?php echo $lang['Comments_DELETE']; ?>" onclick="return confirm('Are you sure you want to delete selected comments?');" /></div>
      	</td>
  	  </tr>
	<?php
    }
    ?>
  </table>
  </form>


<?php 
} elseif ($_REQUEST["act"]=='editComment') {
	$sql = "SELECT * FROM ".$TABLE["Comments"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$Comments = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	
	$sqlP = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".$Comments["post_id"]."'";
	$sql_resultP = sql_result($sqlP);
	$Post = mysqli_fetch_assoc($sql_resultP);
?>


    <form action="admin.php" method="post" style="margin:0px; padding:0px" name="form">
    <input type="hidden" name="act" value="updateComment" />
    <input type="hidden" name="id" value="<?php echo $Comments["id"]; ?>" />
  	<input type="hidden" name="p" value="<?php echo $_REQUEST["p"]; ?>" />
    
    <div class="pageDescr"><a href="admin.php?act=comments&search=<?php echo $_REQUEST["search"]; ?>&post_id=<?php echo $_REQUEST["post_id"]; ?>"><?php echo $lang['Edit_Comment_Back']; ?></a></div>    

	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
  	  <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Edit_Comment_Header']; ?></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Comment_Published_on']; ?></td>
        <td><?php echo admin_date($Comments["publish_date"]); ?></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Comment_IP_address']; ?></td>
        <td><?php echo ReadDB($Comments["ipaddress"]); ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Comment_Status']; ?></td>
      	<td>
        <select name="status" id="status">
          <option value="Not approved"<?php if ($Comments["status"]=='Not approved') echo ' selected="selected"'; ?>><?php echo $lang['Edit_Comment_Not_approved']; ?></option>
          <option value="Approved"<?php if ($Comments["status"]=='Approved') echo ' selected="selected"'; ?>><?php echo $lang['Edit_Comment_Approved']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Comment_Name']; ?></td>
        <td><input class="input_post" name="name" type="text" maxlength="250" value="<?php echo ReadHTML($Comments["name"]); ?>" /></td>
	  </tr>
  	  <tr>
        <td class="formLeft"><?php echo $lang['Edit_Comment_Email']; ?></td>
        <td><input class="input_post" name="email" type="text" maxlength="250" value="<?php echo ReadHTML($Comments["email"]); ?>" /></td>
      </tr>
  	  <tr>
    	<td class="formLeft" valign="top"><?php echo $lang['Edit_Comment_Comment']; ?></td>
    	<td><textarea class="input_post" name="comment" rows="10"><?php echo $Comments["comment"]; ?></textarea></td>
  	  </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Comment_on_post']; ?></td>
        <td><a href="<?php if(trim($Options["items_link"])!=''){ echo ReadDB($Options["items_link"])."?pid=".$Post['id']; } else { echo $CONFIG["full_url"]."preview.php?pid=".$Post["id"]; } ?>" target="_blank"><strong><?php echo $Post["post_title"]; ?></strong></a></td>
      </tr>
  	  <tr>
        <td class="formLeft" align="left">&nbsp;</td>
        <td>
          <input type="submit" name="button2" id="button2" value="<?php echo $lang['Edit_Comment_Update']; ?>" class="submitButton" />
        </td>
  	  </tr>
    </table>
    </form>



<?php
} elseif ($_REQUEST["act"]=='admin_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsAdmin" />

    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Administrator options</td>
      </tr>
      <tr>
        <td width="45%" class="left_top">Number of posts per page: </td>
        <td class="left_top">
        	<select name="per_page">
                <?php for($i=1; $i<=300; $i=$i+1) {?>
            	<option value="<?php echo $i;?>"<?php if($i==$Options["per_page"]) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
                <option value="10000"<?php if($Options["per_page"]=="10000") echo ' selected="selected"'; ?>>10000</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="left_top">Show the menu with categories:</td>
        <td class="left_top">
          <select name="showcategdd"> 
           <option value="yes"<?php if ($Options["showcategdd"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showcategdd"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>
      <tr>
        <td class="left_top">Show post on the date published:<br />
          /<span style="font-size:11px; font-style:italic;">If you choose "yes", the post will be hidden until the datetime of publishing occur</span>/</td>
        <td class="left_top">
          <select name="publishon">      
           <option value="no"<?php if ($Options["publishon"]=='no') echo ' selected="selected"'; ?>>no</option>
           <option value="yes"<?php if ($Options["publishon"]=='yes') echo ' selected="selected"'; ?>>yes</option>  
          </select>
       </td>
      </tr>      
      <tr>
        <td class="left_top">Default number of characters that will appear on the homepage: <br />
        	/<span style="font-size:11px; font-style:italic;">Default number of characters that will appear when create new post. The post will be cut out after this number and visitor will be able to click on "MORE" link and read the full post, write and read comments</span>/
		</td>
        <td class="left_top"><input name="post_limit" type="text" size="4" maxlength="6" value="<?php echo ReadDB($Options["post_limit"]); ?>" /> characters &nbsp; <sub>(leave blank if you don't need that limitation)</sub></td>
      </tr>
      <tr>
        <td class="left_top">Show search box:</td>
        <td class="left_top">
          <select name="showsearch"> 
           <option value="yes"<?php if ($Options["showsearch"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showsearch"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>   
      <tr>
        <td class="left_top">Show share buttons underneath each post:</td>
        <td class="left_top">
          <select name="showshare"> 
           	<option value="yes"<?php if ($Options["showshare"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           	<option value="no"<?php if ($Options["showshare"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
          
          on the: 
          <select name="share_side"> 
           	<option value="right"<?php if ($Options["share_side"]=='right') echo ' selected="selected"'; ?>>right</option>       
           	<option value="left"<?php if ($Options["share_side"]=='left') echo ' selected="selected"'; ?>>left</option>
          </select>
          side
       </td>
      </tr>
      <tr>
        <td class="left_top">URL of the page where you placed the blog on your website: <br />
        	/<span style="font-size:11px; font-style:italic;">needed for RSS to be linked to the page</span>/
        </td>
        <td class="left_top">
        	<input class="input_opt" name="items_link" type="text" value="<?php echo ReadDB($Options["items_link"]); ?>" />
            <div style="padding-top:6px;font-size:11px;">for example http://www.yourwebsite.com/blogpage.php</div>
        </td>
      </tr>
      <tr>
        <td class="left_top">Set Default Time Zone:</td>
        <td class="left_top">
          <select name="time_zone"> 
           	<option value=""<?php if ($Options["time_zone"]=='') echo ' selected="selected"'; ?>>Server Time</option>
            <?php
			if(!function_exists('timezone_identifiers_list')){ 
				$o = timezone_list();
			} else {
				$o = timezone_identifiers_list();
			}
			foreach($o as $timezone => $tz_label) {
			?>	
            	<option value='<?php echo $tz_label; ?>'<?php if ($Options["time_zone"]==$tz_label) echo ' selected="selected"'; ?>><?php echo $tz_label; ?></option>
            <?php 
			}
			?>  
          </select>
       </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
	</form>


<?php
} elseif ($_REQUEST["act"]=='post_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);	
	$Options["comm_req"] = unserialize($Options["comm_req"]);
	mysqli_free_result($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsPost" />
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Comments options</td>
      </tr>
      <tr>
        <td width="45%" class="left_top">Administrator email:<br />
        	/<span style="font-size:11px; font-style:italic;">all new comments notification emails will be sent to this email address/</span>
        </td>
        <td class="left_top">
          <input class="input_opt" name="email" type="text" value="<?php echo ReadDB($Options["email"]); ?>" />
        </td>
      </tr>
      <tr>
        <td class="left_top">Approval:<br />
        	/<span style="font-size:11px; font-style:italic;">check if you want to approve comments before having them posted on the blog</span>/
        </td>
        <td class="left_top"><input name="approval" type="checkbox" value="true"<?php if ($Options["approval"]=='true') echo ' checked="checked"'; ?> /></td>
      </tr>
      <tr>
        <td class="left_top">Turn off comments by default when create a new post:</td>
        <td class="left_top">
          <select name="commentsoff">      
           <option value="no"<?php if ($Options["commentsoff"]=='no') echo ' selected="selected"'; ?>>no</option>
           <option value="yes"<?php if ($Options["commentsoff"]=='yes') echo ' selected="selected"'; ?>>yes</option>  
          </select>
       </td>
      </tr>
      <tr>
        <td class="left_top">Comments order:<br />
        	/<span style="font-size:11px; font-style:italic;">If you set 'New at the bottom', new comment will appear at the bottom of all comments.<br /> 
          	If you set 'New on top', new comment will appear on top of all comments.</span>/
        </td>
        <td class="left_top">
          <select name="comments_order">          
          <option value="AtBottom"<?php if ($Options["comments_order"]=='AtBottom') echo ' selected="selected"'; ?>>New at the bottom</option>
          <option value="OnTop"<?php if ($Options["comments_order"]=='OnTop') echo ' selected="selected"'; ?>>New on top</option>
        </select></td>
      </tr>
      <tr>
        <td class="left_top">Type of the Captcha Verification Code:</td>
        <td class="left_top">
          <select name="captcha">          
          	<option value="recap"<?php if ($Options["captcha"]=='recap') echo ' selected="selected"'; ?>>reCaptcha (choose theme below)</option>
          	<option value="capmath"<?php if ($Options["captcha"]=='capmath') echo ' selected="selected"'; ?>>Mathematical Captcha</option>
          	<option value="cap"<?php if ($Options["captcha"]=='cap') echo ' selected="selected"'; ?>>Simple Captcha</option>
          	<option value="vsc"<?php if ($Options["captcha"]=='vsc') echo ' selected="selected"'; ?>>Very Simple Captcha</option>
            <option value="nocap"<?php if ($Options["captcha"]=='nocap') echo ' selected="selected"'; ?>>No Captcha(unsecured)</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="left_top">If you use reCaptcha Verification, please choose the theme:</td>
        <td class="left_top">
          <select name="captcha_theme">
          	  <option value="clean"<?php if ($Options["captcha_theme"]=='clean') echo ' selected="selected"'; ?>>Clean theme</option>         
              <option value="red"<?php if ($Options["captcha_theme"]=='red') echo ' selected="selected"'; ?>>Red theme</option>
              <option value="white"<?php if ($Options["captcha_theme"]=='white') echo ' selected="selected"'; ?>>White theme</option>
              <option value="blackglass"<?php if ($Options["captcha_theme"]=='blackglass') echo ' selected="selected"'; ?>>Blackglass theme</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="left_top_b">Make email field mandatory: </td>
        <td class="left_top_b">
            <input name="comm_req[]" type="checkbox" value="Email"<?php if(!empty($Options["comm_req"]) and in_array("Email", $Options["comm_req"])) echo ' checked="checked"'; ?> /> 
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Create a list with banned IP addresses</td>
      </tr>
      <tr>
        <td width="45%" class="left_top">Make a list of IP addresses and the comments posted from any of these IP addresses will not be submitted.<br />
          <br />
          For example: 192.168.0.201, 185.168.539.71, 83.91.459.71<br /><br />
          You can block a group of IP addresses. For example if you want to block all IP addresses from 185.168.539.1 to 185.168.539.255, you should enter 185.168.539.
          <br /><br />
          /<span style="font-size:11px; font-style:italic;">Note that you can copy IP address from Comments List.</span>/
          </td>
        <td class="left_top"><textarea class="input_opt" name="ban_ips" id="ban_ips" rows="5"><?php echo ReadDB($Options["ban_ips"]); ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Create a list with banned words</td>
      </tr>
      <tr>
        <td width="45%" class="left_top">Make a list of words and posts/comments containing any of these words can not be posted.<br />
          <br />
          For example: word1,word2, word3<br />
          <br />
          /<span style="font-size:11px; font-style:italic;">Note that the words are not case sensitive. Does not matter if you type 'Word' or 'word'.</span>/
        </td>
        <td class="left_top"><textarea class="input_opt" name="ban_words" id="ban_words" cols="60" rows="5"><?php echo ReadDB($Options["ban_words"]); ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
	</form>
 

<?php
} elseif ($_REQUEST["act"]=='visual_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
?>
	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the styles to see the options.</div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsVisual" />
    
    <div class="opt_headlist">Set blog front-end visual style 
    	<span class="opt_headl_tip">(Advanced users may work directly with CSS file located in styles/css_front_end.php)</span>
    </div>

    <div id="accordion_container"> 
    <div class="accordion_toggle">General style</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">General font-family:</td>
        <td class="left_top">
        	<select name="gen_font_family">
            	<?php echo font_family_list($OptionsVis['gen_font_family']); ?>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">General font-color:</td>
        <td class="left_top"><input name="gen_font_color" type="text" size="7" value="<?php echo $OptionsVis["gen_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["gen_font_color"]); ?>;background-color:<?php echo $OptionsVis["gen_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.gen_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">General font-size:</td>
        <td class="left_top">
        	<select name="gen_font_size">
            	<option value="inherit"<?php if($OptionsVis['gen_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=22; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['gen_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="gen_text_align">
            	<option value="center"<?php if($OptionsVis['gen_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['gen_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['gen_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['gen_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['gen_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">General line-height:</td>
        <td class="left_top">
        	<select name="gen_line_height">
            	<option value="inherit"<?php if($OptionsVis['gen_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['gen_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['gen_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">General background-color:</td>
        <td class="left_top"><input name="gen_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["gen_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["gen_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["gen_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.gen_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>     
      <tr>
        <td class="langLeft">Blog width:</td>
        <td class="left_top">
        	<input name="gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["gen_width"]); ?>" />
            <select name="gen_width_dim">
            	<option value="px"<?php if($OptionsVis['gen_width_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            	<option value="%"<?php if($OptionsVis['gen_width_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            	<option value="pt"<?php if($OptionsVis['gen_width_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            	<option value="em"<?php if($OptionsVis['gen_width_dim']=='em') echo ' selected="selected"'; ?>>em</option>
        	</select> 
        &nbsp; <sub>(leave blank if you need a responsive width, so the blog will fit the resolution on all screens)</sub>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Thumbnail ratio:</td>
        <td class="left_top">
        	<select name="thumb_ratio">
            	<option value="56"<?php if($OptionsVis['thumb_ratio']=='56') echo ' selected="selected"'; ?>>16:9(wide)</option> 
            	<option value="75"<?php if($OptionsVis['thumb_ratio']=='75') echo ' selected="selected"'; ?>>4:3</option>  
            	<option value="100"<?php if($OptionsVis['thumb_ratio']=='100') echo ' selected="selected"'; ?>>1:1(square)</option>  
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Thumbnails per line:</td>
        <td class="left_top">
        	<select name="thumb_per_line">
            	<option value="100"<?php if($OptionsVis['thumb_per_line']=='100') echo ' selected="selected"'; ?>>one per line</option> 
            	<option value="50"<?php if($OptionsVis['thumb_per_line']=='50') echo ' selected="selected"'; ?>>two per line</option> 
            	<option value="33.33"<?php if($OptionsVis['thumb_per_line']=='33.33') echo ' selected="selected"'; ?>>three per line</option>
            	<option value="25"<?php if($OptionsVis['thumb_per_line']=='25') echo ' selected="selected"'; ?>>four per line</option>  
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>  
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
    
    
    
    
    <div class="accordion_toggle">Search box style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">      
      <tr>
        <td class="langLeft">Search box text color:</td>
        <td class="left_top"><input name="sear_color" type="text" size="7" value="<?php echo $OptionsVis["sear_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sear_color"]); ?>;background-color:<?php echo $OptionsVis["sear_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sear_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Search box font-size:</td>
        <td class="left_top">
        	<select name="sb_font_size">
            	<option value="inherit"<?php if($OptionsVis['sb_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['sb_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Search box border color:</td>
        <td class="left_top"><input name="sear_bor_color" type="text" size="7" value="<?php echo $OptionsVis["sear_bor_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sear_bor_color"]); ?>;background-color:<?php echo $OptionsVis["sear_bor_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sear_bor_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    

    <div class="accordion_toggle">Categories menu style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="cat_menu_color" type="text" size="7" value="<?php echo $OptionsVis["cat_menu_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["cat_menu_color"]); ?>;background-color:<?php echo $OptionsVis["cat_menu_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.cat_menu_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>         
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><input name="cat_menu_bgr" type="text" size="7" value="<?php echo $OptionsVis["cat_menu_bgr"]; ?>" style="color:<?php echo invert_colour($OptionsVis["cat_menu_bgr"]); ?>;background-color:<?php echo $OptionsVis["cat_menu_bgr"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.cat_menu_bgr,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy. Leave blank if you don't want this option</sub></td>
      </tr>         
      <tr>
        <td class="langLeft">Color selected:</td>
        <td class="left_top"><input name="cat_menu_color_sel" type="text" size="7" value="<?php echo $OptionsVis["cat_menu_color_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["cat_menu_color_sel"]); ?>;background-color:<?php echo $OptionsVis["cat_menu_color_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.cat_menu_color_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>                     
      <tr>
        <td class="langLeft">Background color selected:</td>
        <td class="left_top"><input name="cat_menu_bgr_sel" type="text" size="7" value="<?php echo $OptionsVis["cat_menu_bgr_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["cat_menu_bgr_sel"]); ?>;background-color:<?php echo $OptionsVis["cat_menu_bgr_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.cat_menu_bgr_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy. Leave blank if you don't want this option</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="cat_menu_family">
            	<?php echo font_family_list($OptionsVis['cat_menu_family']); ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="cat_menu_size">
            	<option value="inherit"<?php if($OptionsVis['cat_menu_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cat_menu_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="cat_menu_weight">
            	<option value="normal"<?php if($OptionsVis['cat_menu_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['cat_menu_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['cat_menu_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
        
    <div class="accordion_toggle">Posts grid title style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="list_title_font">
            	<?php echo font_family_list($OptionsVis['list_title_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="list_title_color" type="text" size="7" value="<?php echo $OptionsVis["list_title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["list_title_color"]); ?>;background-color:<?php echo $OptionsVis["list_title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.list_title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover (on mouse over):</td>
        <td class="left_top"><input name="list_title_color_hover" type="text" size="7" value="<?php echo $OptionsVis["list_title_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["list_title_color_hover"]); ?>;background-color:<?php echo $OptionsVis["list_title_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.list_title_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="list_title_size">
            	<option value="inherit"<?php if($OptionsVis['list_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_title_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="list_title_font_style">
            	<option value="normal"<?php if($OptionsVis['list_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['list_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['list_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['list_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="list_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['list_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['list_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['list_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="list_title_align">
            	<option value="center"<?php if($OptionsVis['list_title_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['list_title_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['list_title_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['list_title_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['list_title_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="list_title_line_height">
                <option value="inherit"<?php if($OptionsVis['list_title_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_title_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>        
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
    
    
    <div class="accordion_toggle">Post title style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="post_title_font">
            	<?php echo font_family_list($OptionsVis['post_title_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="post_title_color" type="text" size="7" value="<?php echo $OptionsVis["post_title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["post_title_color"]); ?>;background-color:<?php echo $OptionsVis["post_title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.post_title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>     
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="post_title_size">
            	<option value="inherit"<?php if($OptionsVis['post_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['post_title_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="post_title_font_style">
            	<option value="normal"<?php if($OptionsVis['post_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['post_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['post_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['post_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="post_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['post_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['post_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['post_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="post_title_align">
            	<option value="center"<?php if($OptionsVis['post_title_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['post_title_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['post_title_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['post_title_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['post_title_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="title_line_height">
                <option value="inherit"<?php if($OptionsVis['title_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>        
      <tr>
        <td class="langLeft">Color of the line underneath the post title:</td>
        <td class="left_top"><input name="title_line_color" type="text" size="7" value="<?php echo $OptionsVis["title_line_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["title_line_color"]); ?>;background-color:<?php echo $OptionsVis["title_line_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.title_line_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">Distance from title to line:</td>
        <td class="left_top">
        	<select name="title_dist_line">
                <?php for($i=0; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_dist_line']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Line thickness:</td>
        <td class="left_top">
        	<select name="title_line_thick">
                <?php for($i=0; $i<=10; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_line_thick']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
      
    
    <div class="accordion_toggle">Posts grid date style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="list_date_font">
            	<?php echo font_family_list($OptionsVis['list_date_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="list_date_color" type="text" size="7" value="<?php echo $OptionsVis["list_date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["list_date_color"]); ?>;background-color:<?php echo $OptionsVis["list_date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.list_date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="list_date_size">
            	<option value="inherit"<?php if($OptionsVis['list_date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=22; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_date_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="list_date_font_style">
            	<option value="normal"<?php if($OptionsVis['list_date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['list_date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['list_date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['list_date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="list_date_text_align">
            	<option value="center"<?php if($OptionsVis['list_date_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['list_date_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['list_date_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['list_date_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['list_date_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td class="left_top">
        	<select name="list_date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['list_date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2015</option>
                <option value="l - F j Y"<?php if($OptionsVis['list_date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2015</option>
                <option value="l, F j Y"<?php if($OptionsVis['list_date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2015</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['list_date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2015</option>
                <option value="l F j Y"<?php if($OptionsVis['list_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2015</option>
                <option value="l F j, Y"<?php if($OptionsVis['list_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2015</option>
                <option value="F j Y"<?php if($OptionsVis['list_date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2015</option>
                <option value="F j, Y"<?php if($OptionsVis['list_date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2015</option>
                <option value="F jS, Y"<?php if($OptionsVis['list_date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2015</option>
                <option value="F Y"<?php if($OptionsVis['list_date_format']=='F Y') echo ' selected="selected"'; ?>>January 2015</option>
                <option value="m-d-Y"<?php if($OptionsVis['list_date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['list_date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['list_date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['list_date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['list_date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['list_date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['list_date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2015</option>
                <option value="l - j F Y"<?php if($OptionsVis['list_date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2015</option>
                <option value="l, j F Y"<?php if($OptionsVis['list_date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2015</option>
                <option value="l, j F, Y"<?php if($OptionsVis['list_date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2015</option>
                <option value="l j F Y"<?php if($OptionsVis['list_date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2015</option>
                <option value="l j F, Y"<?php if($OptionsVis['list_date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2015</option>
                <option value="d F Y"<?php if($OptionsVis['list_date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2015</option>
                <option value="d F, Y"<?php if($OptionsVis['list_date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2015</option>
                <option value="d-m-Y"<?php if($OptionsVis['list_date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['list_date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['list_date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['list_date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['list_date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['list_date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Show the date:</td>
        <td class="left_top">
        	<select name="list_show_date">
            	<option value="yes"<?php if($OptionsVis['list_show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['list_show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Show the time:</td>
        <td class="left_top">
        	<select name="list_showing_time">
            	<option value=""<?php if($OptionsVis['list_showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['list_showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>    
          
      
    <div class="accordion_toggle">Comments number style in the grid</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="coml_font_color" type="text" size="7" value="<?php echo $OptionsVis["coml_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["coml_font_color"]); ?>;background-color:<?php echo $OptionsVis["coml_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.coml_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouse over):</td>
        <td class="left_top"><input name="coml_font_color_hover" type="text" size="7" value="<?php echo $OptionsVis["coml_font_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["coml_font_color_hover"]); ?>;background-color:<?php echo $OptionsVis["coml_font_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.coml_font_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="coml_font">
            	<?php echo font_family_list($OptionsVis['coml_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="coml_font_size">
            	<option value="inherit"<?php if($OptionsVis['coml_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=10; $i<=22; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['coml_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="coml_font_style">
            	<option value="normal"<?php if($OptionsVis['coml_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['coml_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['coml_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="coml_font_weight">
            	<option value="normal"<?php if($OptionsVis['coml_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['coml_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['coml_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Post date style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="date_font">
            	<?php echo font_family_list($OptionsVis['date_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="date_color" type="text" size="7" value="<?php echo $OptionsVis["date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["date_color"]); ?>;background-color:<?php echo $OptionsVis["date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="date_size">
            	<option value="inherit"<?php if($OptionsVis['date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=22; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['date_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="date_font_style">
            	<option value="normal"<?php if($OptionsVis['date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="date_text_align">
            	<option value="center"<?php if($OptionsVis['date_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['date_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['date_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['date_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['date_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td class="left_top">
        	<select name="date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2015</option>
                <option value="l - F j Y"<?php if($OptionsVis['date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2015</option>
                <option value="l, F j Y"<?php if($OptionsVis['date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2015</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2015</option>
                <option value="l F j Y"<?php if($OptionsVis['date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2015</option>
                <option value="l F j, Y"<?php if($OptionsVis['date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2015</option>
                <option value="F j Y"<?php if($OptionsVis['date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2015</option>
                <option value="F j, Y"<?php if($OptionsVis['date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2015</option>
                <option value="F jS, Y"<?php if($OptionsVis['date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2015</option>
                <option value="F Y"<?php if($OptionsVis['date_format']=='F Y') echo ' selected="selected"'; ?>>January 2015</option>
                <option value="m-d-Y"<?php if($OptionsVis['date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2015</option>
                <option value="l - j F Y"<?php if($OptionsVis['date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2015</option>
                <option value="l, j F Y"<?php if($OptionsVis['date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2015</option>
                <option value="l, j F, Y"<?php if($OptionsVis['date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2015</option>
                <option value="l j F Y"<?php if($OptionsVis['date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2015</option>
                <option value="l j F, Y"<?php if($OptionsVis['date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2015</option>
                <option value="d F Y"<?php if($OptionsVis['date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2015</option>
                <option value="d F, Y"<?php if($OptionsVis['date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2015</option>
                <option value="d-m-Y"<?php if($OptionsVis['date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Show the date:</td>
        <td class="left_top">
        	<select name="show_date">
            	<option value="yes"<?php if($OptionsVis['show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Show the time:</td>
        <td class="left_top">
        	<select name="showing_time">
            	<option value=""<?php if($OptionsVis['showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Show A+/a-:</td>
        <td class="left_top">
        	<select name="show_aa">
            	<option value="yes"<?php if($OptionsVis['show_aa']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_aa']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
    
    
    <div class="accordion_toggle">Posts grid text style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="list_text_font">
            	<?php echo font_family_list($OptionsVis['list_text_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="list_text_color" type="text" size="7" value="<?php echo $OptionsVis["list_text_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["list_text_color"]); ?>;background-color:<?php echo $OptionsVis["list_text_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.list_text_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><input name="list_text_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["list_text_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["list_text_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["list_text_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.list_text_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy. Leave blank if you don't want this option</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="list_text_size">
            	<option value="inherit"<?php if($OptionsVis['list_text_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_text_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="list_text_font_weight">
            	<option value="normal"<?php if($OptionsVis['list_text_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['list_text_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['list_text_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="list_text_font_style">
            	<option value="normal"<?php if($OptionsVis['list_text_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['list_text_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['list_text_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['list_text_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="list_text_text_align">
            	<option value="center"<?php if($OptionsVis['list_text_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['list_text_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['list_text_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['list_text_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['list_text_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="list_text_line_height">
            	<option value="inherit"<?php if($OptionsVis['list_text_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=40; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_text_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
        
    
    <div class="accordion_toggle">Post text style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="text_font">
            	<?php echo font_family_list($OptionsVis['text_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="text_color" type="text" size="7" value="<?php echo $OptionsVis["text_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["text_color"]); ?>;background-color:<?php echo $OptionsVis["text_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.text_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><input name="text_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["text_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["text_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["text_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.text_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy. Leave blank if you don't want this option</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="text_size">
            	<option value="inherit"<?php if($OptionsVis['text_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['text_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="text_font_weight">
            	<option value="normal"<?php if($OptionsVis['text_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['text_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['text_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="text_font_style">
            	<option value="normal"<?php if($OptionsVis['text_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['text_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['text_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['text_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="text_text_align">
            	<option value="center"<?php if($OptionsVis['text_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['text_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['text_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['text_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['text_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="text_line_height">
            	<option value="inherit"<?php if($OptionsVis['text_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=40; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['text_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Padding left/right:</td>
        <td class="left_top">
        	<select name="text_padding">
            	<option value="inherit"<?php if($OptionsVis['text_padding']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=0; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['text_padding']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
    
    
      
    <div class="accordion_toggle">'Back' link style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="back_font_color" type="text" size="7" value="<?php echo $OptionsVis["back_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["back_font_color"]); ?>;background-color:<?php echo $OptionsVis["back_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.back_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouse over):</td>
        <td class="left_top"><input name="back_font_color_hover" type="text" size="7" value="<?php echo $OptionsVis["back_font_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["back_font_color_hover"]); ?>;background-color:<?php echo $OptionsVis["back_font_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.back_font_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="back_font_size">
            	<option value="inherit"<?php if($OptionsVis['back_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=10; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['back_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="back_font_style">
            	<option value="normal"<?php if($OptionsVis['back_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['back_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['back_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="back_font_weight">
            	<option value="normal"<?php if($OptionsVis['back_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['back_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['back_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="back_text_decoration">
            	<option value="none"<?php if($OptionsVis['back_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['back_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['back_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration on hover (on mouseover):</td>
        <td class="left_top">
        	<select name="back_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['back_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['back_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['back_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
      
    
    <div class="accordion_toggle">Links style in the post message area</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font color:</td>
        <td class="left_top"><input name="links_font_color" type="text" size="7" value="<?php echo $OptionsVis["links_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["links_font_color"]); ?>;background-color:<?php echo $OptionsVis["links_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.links_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouseover):</td>
        <td class="left_top"><input name="links_font_color_hover" type="text" size="7" value="<?php echo $OptionsVis["links_font_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["links_font_color_hover"]); ?>;background-color:<?php echo $OptionsVis["links_font_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.links_font_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="links_text_decoration">
            	<option value="none"<?php if($OptionsVis['links_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['links_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['links_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration(on mouseover):</td>
        <td class="left_top">
        	<select name="links_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['links_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['links_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['links_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="links_font_size">
            	<option value="inherit"<?php if($OptionsVis['links_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=22; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['links_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="links_font_style">
            	<option value="normal"<?php if($OptionsVis['links_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['links_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['links_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="links_font_weight">
            	<option value="normal"<?php if($OptionsVis['links_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['links_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['links_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
      
      
        
    <div class="accordion_toggle">Pagination style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Pagination Font-family:</td>
        <td class="left_top">
        	<select name="pag_font_family">
            	<?php echo font_family_list($OptionsVis['pag_font_family']); ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Page numbers font color:</td>
        <td class="left_top"><input name="pag_font_color" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Page numbers background color:</td>
        <td class="left_top"><input name="pag_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">Pages font color on hover (on mouse over):</td>
        <td class="left_top"><input name="pag_font_color_hover" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color_hover"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>       
      <tr>
        <td class="langLeft">Pages background color on hover (on mouse over):</td>
        <td class="left_top"><input name="pag_bgr_color_hover" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_hover"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Selected page font color:</td>
        <td class="left_top"><input name="pag_font_color_sel" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color_sel"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>         
      <tr>
        <td class="langLeft">Selected page background color:</td>
        <td class="left_top"><input name="pag_bgr_color_sel" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_sel"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>       
      <tr>
        <td class="langLeft">Pagination font-size:</td>
        <td class="left_top">
        	<select name="pag_font_size">
            	<option value="inherit"<?php if($OptionsVis['pag_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['pag_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Pagination font-style:</td>
        <td class="left_top">
        	<select name="pag_font_style">
            	<option value="normal"<?php if($OptionsVis['pag_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['pag_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Pagination font-weight:</td>
        <td class="left_top">
        	<select name="pag_font_weight">
            	<option value="normal"<?php if($OptionsVis['pag_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['pag_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Align to:</td>
        <td  class="left_top">
        	<select name="pag_align_to">
            	<option value="center"<?php if($OptionsVis['pag_align_to']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="left"<?php if($OptionsVis['pag_align_to']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['pag_align_to']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>  
	</table>
    </div>
    
    
    <div class="accordion_toggle">"Scrol to top" button style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">         
      <tr>
        <td class="langLeft">Show "Scrol to top" button:</td>
        <td class="left_top">
        	<select name="show_scrolltop">
            	<option value="yes"<?php if($OptionsVis['show_scrolltop']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_scrolltop']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>             
      <tr>
        <td class="langLeft">Width:</td>
        <td class="left_top">
        	<select name="scrolltop_width">
                <?php for($i=0; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['scrolltop_width']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>          
      <tr>
        <td class="langLeft">Heght:</td>
        <td class="left_top">
        	<select name="scrolltop_height">
                <?php for($i=0; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['scrolltop_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><input name="scrolltop_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["scrolltop_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["scrolltop_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["scrolltop_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.scrolltop_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>        
      <tr>
        <td class="langLeft">Background color on hover (on mouseover):</td>
        <td class="left_top"><input name="scrolltop_bgr_color_hover" type="text" size="7" value="<?php echo $OptionsVis["scrolltop_bgr_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["scrolltop_bgr_color_hover"]); ?>;background-color:<?php echo $OptionsVis["scrolltop_bgr_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.scrolltop_bgr_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Opacity:</td>
        <td class="left_top">
        	<select name="scrolltop_opacity">
                <?php for($i=0; $i<=100; $i += 10) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['scrolltop_opacity']==$i) echo ' selected="selected"'; ?>><?php echo $i;?>%</option>
                <?php } ?>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Opacity when scroll down:</td>
        <td class="left_top">
        	<select name="scrolltop_opacity_hover">
                <?php for($i=0; $i<=100; $i += 10) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['scrolltop_opacity_hover']==$i) echo ' selected="selected"'; ?>><?php echo $i;?>%</option>
                <?php } ?>
            </select>
        </td>
      </tr>           
      <tr>
        <td class="langLeft">Border radius:</td>
        <td class="left_top">
        	<select name="scrolltop_radius">
                <?php for($i=0; $i<=10; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['scrolltop_radius']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
             
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Bottom links "Older Post", "Home", "Newer Post" style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><input name="bott_color" type="text" size="7" value="<?php echo $OptionsVis["bott_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["bott_color"]); ?>;background-color:<?php echo $OptionsVis["bott_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.bott_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouse over):</td>
        <td class="left_top"><input name="bott_color_hover" type="text" size="7" value="<?php echo $OptionsVis["bott_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["bott_color_hover"]); ?>;background-color:<?php echo $OptionsVis["bott_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.bott_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Inactive link color:</td>
        <td class="left_top"><input name="bott_color_inact" type="text" size="7" value="<?php echo $OptionsVis["bott_color_inact"]; ?>" style="color:<?php echo invert_colour($OptionsVis["bott_color_inact"]); ?>;background-color:<?php echo $OptionsVis["bott_color_inact"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.bott_color_inact,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="bott_size">
            	<option value="inherit"<?php if($OptionsVis['bott_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=10; $i<=22; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['bott_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="bott_style">
            	<option value="normal"<?php if($OptionsVis['bott_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['bott_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['bott_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="bott_weight">
            	<option value="normal"<?php if($OptionsVis['bott_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['bott_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['bott_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="bott_decoration">
            	<option value="none"<?php if($OptionsVis['bott_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['bott_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['bott_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration on hover (on mouseover):</td>
        <td class="left_top">
        	<select name="bott_decoration_hover">
            	<option value="none"<?php if($OptionsVis['bott_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['bott_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['bott_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
          
      
    <div class="accordion_toggle">Distances</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Distance blog from top:</td>
        <td class="left_top">
        	<select name="dist_from_top">
                <?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_from_top']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">Distance menu - posts:</td>
        <td class="left_top">
        	<select name="dist_search_title">
                <?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_search_title']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Distance between title and date:</td>
        <td class="left_top">
        	<select name="dist_title_date">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_title_date']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>              
      <tr>
        <td class="langLeft">Distance between title and date in the grid of posts:</td>
        <td class="left_top">
        	<select name="list_dist_title_date">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_dist_title_date']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between date and post text:</td>
        <td class="left_top">
        	<select name="dist_date_text">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_date_text']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Distance between date and post text in the grid of posts:</td>
        <td class="left_top">
        	<select name="list_dist_date_text">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['list_dist_date_text']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Distance between posts in the list of posts:</td>
        <td class="left_top">
        	<select name="dist_btw_items">
            	<?php for($i=0; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_btw_items']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Distance between 'Back' link and post title:</td>
        <td class="left_top">
        	<select name="dist_link_title">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_link_title']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Distance between comments form and bottom navigation:</td>
        <td class="left_top">
        	<select name="dist_comm_links">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_comm_links']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">Distance blog from the bottom:</td>
        <td class="left_top">
        	<select name="dist_from_bottom">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_from_bottom']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>     
    </table>
    </div>
    
    </div>
	</form> 


<?php
} elseif ($_REQUEST["act"]=='visual_options_comm') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual_comm']);
?>
	<script type="text/javascript">
        Event.observe(window, 'load', loadAccordions, false);
        function loadAccordions() {
            var bottomAccordion = new accordion('accordion_container');	
            // Open first one
            //bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
        }	
    </script>
	
    <div class="pageDescr">Click on any of the styles to see the options.</div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsComm" />
    
    <div class="opt_headlist">Set comments front-end visual style 
    	<span class="opt_headl_tip">(Advanced users may work directly with CSS file located in styles/css_front_end.php)</span>. 
    </div>

    <div id="accordion_container"> 
    <div class="accordion_toggle">Comments list visual style</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Comments Borders:</td>
        <td class="left_top">
        	<select name="comm_bord_sides">
            	<option value="all"<?php if($OptionsVis['comm_bord_sides']=='all') echo ' selected="selected"'; ?>>all sides</option>            	
            	<option value="top"<?php if($OptionsVis['comm_bord_sides']=='top') echo ' selected="selected"'; ?>>top</option>
                <option value="bottom"<?php if($OptionsVis['comm_bord_sides']=='bottom') echo ' selected="selected"'; ?>>bottom</option>
                <option value="top_bottom"<?php if($OptionsVis['comm_bord_sides']=='top_bottom') echo ' selected="selected"'; ?>>top and bottom</option>
                <option value="right"<?php if($OptionsVis['comm_bord_sides']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="left"<?php if($OptionsVis['comm_bord_sides']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right_left"<?php if($OptionsVis['comm_bord_sides']=='right_left') echo ' selected="selected"'; ?>>right and left</option> 
                <option value="none"<?php if($OptionsVis['comm_bord_sides']=='none') echo ' selected="selected"'; ?>>none</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments Border-style:</td>
        <td class="left_top">
        	<select name="comm_bord_style">
            	<option value="solid"<?php if($OptionsVis['comm_bord_style']=='solid') echo ' selected="selected"'; ?>>solid</option>
            	<option value="double"<?php if($OptionsVis['comm_bord_style']=='double') echo ' selected="selected"'; ?>>double</option>
                <option value="dashed"<?php if($OptionsVis['comm_bord_style']=='dashed') echo ' selected="selected"'; ?>>dashed</option>
                <option value="dotted"<?php if($OptionsVis['comm_bord_style']=='dotted') echo ' selected="selected"'; ?>>dotted</option>
                <option value="outset"<?php if($OptionsVis['comm_bord_style']=='outset') echo ' selected="selected"'; ?>>outset</option>
                <option value="inset"<?php if($OptionsVis['comm_bord_style']=='inset') echo ' selected="selected"'; ?>>inset</option>
                <option value="groove"<?php if($OptionsVis['comm_bord_style']=='groove') echo ' selected="selected"'; ?>>groove</option>
                <option value="ridge"<?php if($OptionsVis['comm_bord_style']=='ridge') echo ' selected="selected"'; ?>>ridge</option>
                <option value="none"<?php if($OptionsVis['comm_bord_style']=='none') echo ' selected="selected"'; ?>>none</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments Border-width:</td>
        <td class="left_top">
        	<select name="comm_bord_width">            	
                <?php for($i=0; $i<=20; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['comm_bord_width']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <option value="inherit"<?php if($OptionsVis['comm_bord_width']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments Border-color:</td>
        <td class="left_top"><input name="comm_bord_color" type="text" size="7" value="<?php echo $OptionsVis["comm_bord_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_bord_color"]); ?>;background-color:<?php echo $OptionsVis["comm_bord_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_bord_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy.</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Comments padding:</td>
        <td class="left_top">
        	<select name="comm_padding">
            	<?php for($i=0; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['comm_padding']==$i) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
            </select>            
            <select name="comm_padd_dim">
            	<option value="px"<?php if($OptionsVis['comm_padd_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            	<option value="%"<?php if($OptionsVis['comm_padd_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            	<option value="pt"<?php if($OptionsVis['comm_padd_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            	<option value="em"<?php if($OptionsVis['comm_padd_dim']=='em') echo ' selected="selected"'; ?>>em</option>
        	</select> 
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments background-color:</td>
        <td class="left_top"><input name="comm_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["comm_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["comm_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy. Leave blank if you don't want this option</sub></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
      
	
    <div class="accordion_toggle">Words "Comments:" over the comments list</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="w_comm_font_family">
            	<?php echo font_family_list($OptionsVis['w_comm_font_family']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-color:</td>
        <td class="left_top"><input name="w_comm_font_color" type="text" size="7" value="<?php echo $OptionsVis["w_comm_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["w_comm_font_color"]); ?>;background-color:<?php echo $OptionsVis["w_comm_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.w_comm_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="w_comm_font_size">
            	<option value="inherit"<?php if($OptionsVis['w_comm_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['w_comm_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="w_comm_font_style">
            	<option value="normal"<?php if($OptionsVis['w_comm_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['w_comm_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['w_comm_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="w_comm_font_weight">
            	<option value="normal"<?php if($OptionsVis['w_comm_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['w_comm_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['w_comm_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
      
    
    <div class="accordion_toggle">Comments name style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Comment name font color:</td>
        <td class="left_top"><input name="name_font_color" type="text" size="7" value="<?php echo $OptionsVis["name_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["name_font_color"]); ?>;background-color:<?php echo $OptionsVis["name_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.name_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Comment name font-size:</td>
        <td class="left_top">
        	<select name="name_font_size">
            	<option value="inherit"<?php if($OptionsVis['name_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['name_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Comment name font-style:</td>
        <td class="left_top">
        	<select name="name_font_style">
            	<option value="normal"<?php if($OptionsVis['name_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['name_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['name_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comment name font-weight:</td>
        <td class="left_top">
        	<select name="name_font_weight">
            	<option value="normal"<?php if($OptionsVis['name_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['name_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['name_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
      
    
    <div class="accordion_toggle">Comments date style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Comments date color:</td>
        <td class="left_top"><input name="comm_date_color" type="text" size="7" value="<?php echo $OptionsVis["comm_date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_date_color"]); ?>;background-color:<?php echo $OptionsVis["comm_date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Comments date font-family:</td>
        <td class="left_top">
        	<select name="comm_date_font">
            	<?php echo font_family_list($OptionsVis['comm_date_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments date font-size:</td>
        <td class="left_top">
        	<select name="comm_date_size">
            	<option value="inherit"<?php if($OptionsVis['comm_date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['comm_date_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments date font-style:</td>
        <td class="left_top">
        	<select name="comm_date_font_style">
            	<option value="normal"<?php if($OptionsVis['comm_date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['comm_date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['comm_date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['comm_date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Comments date format:</td>
        <td class="left_top">
        	<select name="comm_date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['comm_date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2015</option>
                <option value="l - F j Y"<?php if($OptionsVis['comm_date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2015</option>
                <option value="l, F j Y"<?php if($OptionsVis['comm_date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2015</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['comm_date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2015</option>
                <option value="l F j Y"<?php if($OptionsVis['comm_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2015</option>
                <option value="l F j, Y"<?php if($OptionsVis['comm_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2015</option>
                <option value="F j Y"<?php if($OptionsVis['comm_date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2015</option>
                <option value="F j, Y"<?php if($OptionsVis['comm_date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2015</option>
                <option value="F jS, Y"<?php if($OptionsVis['comm_date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2015</option>
                <option value="F Y"<?php if($OptionsVis['comm_date_format']=='F Y') echo ' selected="selected"'; ?>>January 2015</option>
                <option value="m-d-Y"<?php if($OptionsVis['comm_date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['comm_date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['comm_date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['comm_date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['comm_date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['comm_date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['comm_date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2015</option>
                <option value="l - j F Y"<?php if($OptionsVis['comm_date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2015</option>
                <option value="l, j F Y"<?php if($OptionsVis['comm_date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2015</option>
                <option value="l, j F, Y"<?php if($OptionsVis['comm_date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2015</option>
                <option value="l j F Y"<?php if($OptionsVis['comm_date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2015</option>
                <option value="l j F, Y"<?php if($OptionsVis['comm_date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2015</option>
                <option value="d F Y"<?php if($OptionsVis['comm_date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2015</option>
                <option value="d F, Y"<?php if($OptionsVis['comm_date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2015</option>
                <option value="d-m-Y"<?php if($OptionsVis['comm_date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['comm_date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['comm_date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['comm_date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['comm_date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['comm_date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Showing comment time:</td>
        <td class="left_top">
        	<select name="comm_showing_time">
            	<option value=""<?php if($OptionsVis['comm_showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['comm_showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['comm_showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
      
    
    <div class="accordion_toggle">Comments text style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Comment text font color:</td>
        <td class="left_top"><input name="comm_font_color" type="text" size="7" value="<?php echo $OptionsVis["comm_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_font_color"]); ?>;background-color:<?php echo $OptionsVis["comm_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Comment text font-size:</td>
        <td class="left_top">
        	<select name="comm_font_size">
            	<option value="inherit"<?php if($OptionsVis['comm_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['comm_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Comment text font-style:</td>
        <td class="left_top">
        	<select name="comm_font_style">
            	<option value="normal"<?php if($OptionsVis['comm_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['comm_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['comm_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comment text font-weight:</td>
        <td class="left_top">
        	<select name="comm_font_weight">
            	<option value="normal"<?php if($OptionsVis['comm_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['comm_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['comm_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
      
      
    <div class="accordion_toggle">Comments form style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">"Leave a comment" font color:</td>
        <td class="left_top"><input name="leave_font_color" type="text" size="7" value="<?php echo $OptionsVis["leave_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["leave_font_color"]); ?>;background-color:<?php echo $OptionsVis["leave_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.leave_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">"Leave a comment" text font-size:</td>
        <td class="left_top">
        	<select name="leave_font_size">
            	<option value="inherit"<?php if($OptionsVis['leave_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['leave_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">"Leave a comment" text font-weight:</td>
        <td class="left_top">
        	<select name="leave_font_weight">
            	<option value="normal"<?php if($OptionsVis['leave_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['leave_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['leave_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">"Leave a comment" text font-style:</td>
        <td class="left_top">
        	<select name="leave_font_style">
            	<option value="normal"<?php if($OptionsVis['leave_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['leave_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['leave_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
          
      <tr>
        <td class="langLeft">Comments form field labels font color:</td>
        <td class="left_top"><input name="field_font_color" type="text" size="7" value="<?php echo $OptionsVis["field_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["field_font_color"]); ?>;background-color:<?php echo $OptionsVis["field_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.field_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Comments form field labels font-size:</td>
        <td class="left_top">
        	<select name="field_font_size">
            	<option value="inherit"<?php if($OptionsVis['field_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['field_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Comments form field labels font-style:</td>
        <td class="left_top">
        	<select name="field_font_style">
            	<option value="normal"<?php if($OptionsVis['field_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['field_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['field_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments form field labels font-weight:</td>
        <td class="left_top">
        	<select name="field_font_weight">
            	<option value="normal"<?php if($OptionsVis['field_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['field_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['field_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">"Required fields" font color:</td>
        <td class="left_top"><input name="req_font_color" type="text" size="7" value="<?php echo $OptionsVis["req_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["req_font_color"]); ?>;background-color:<?php echo $OptionsVis["req_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.req_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">"Required fields" text font-size:</td>
        <td class="left_top">
        	<select name="req_font_size">
            	<option value="inherit"<?php if($OptionsVis['req_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=24; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['req_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
    
    
    <div class="accordion_toggle">"SUBMIT COMMENT" button style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">         
      <tr>
        <td class="langLeft">Text color:</td>
        <td class="left_top"><input name="subm_color" type="text" size="7" value="<?php echo $OptionsVis["subm_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["subm_color"]); ?>;background-color:<?php echo $OptionsVis["subm_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.subm_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Border color(+ color on hover):</td>
        <td class="left_top"><input name="subm_brdr_color" type="text" size="7" value="<?php echo $OptionsVis["subm_brdr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["subm_brdr_color"]); ?>;background-color:<?php echo $OptionsVis["subm_brdr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.subm_brdr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Background-color:</td>
        <td class="left_top"><input name="subm_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["subm_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["subm_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["subm_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.subm_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Background-color on hover(on mouseover):</td>
        <td class="left_top"><input name="subm_bgr_color_on" type="text" size="7" value="<?php echo $OptionsVis["subm_bgr_color_on"]; ?>" style="color:<?php echo invert_colour($OptionsVis["subm_bgr_color_on"]); ?>;background-color:<?php echo $OptionsVis["subm_bgr_color_on"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.subm_bgr_color_on,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Button radius:</td>
        <td class="left_top">
        	<select name="subm_bor_radius">
                <?php for($i=0; $i<=10; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_bor_radius']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="subm_font_weight">
            	<option value="normal"<?php if($OptionsVis['subm_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['subm_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['subm_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="subm_font_style">
            	<option value="normal"<?php if($OptionsVis['subm_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['subm_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['subm_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['subm_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
      
      
    <div class="accordion_toggle">Distances</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Distance between comments:</td>
        <td class="left_top">
        	<select name="dist_btw_comm">
            	<?php for($i=0; $i<=60; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_btw_comm']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>      
    </table>
    </div>
    
    </div>
	</form> 

  
    
<?php
} elseif ($_REQUEST["act"]=='language_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsLang = unserialize( base64_decode( $Options['language']));
?>
	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the line to see the options.</div>
    
    <form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsLanguage" />
    
    <div class="opt_headlist">Translate blog front-end in your own language. </div>
    
    <div id="accordion_container"> 
    <div class="accordion_toggle">Blog main wordings - navigations, links, search button, category and paging</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">      
      <tr>
        <td class="langLeft">Back:</td>
        <td class="left_top"><input class="input_lan" name="Back_home" type="text" value="<?php echo ReadHTML($OptionsLang["Back_home"]); ?>" /> &nbsp; <sub> - leave empty if you don't want this link</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">'Search' placeholder:</td>
        <td class="left_top"><input class="input_lan" name="Search_button" type="text" value="<?php echo ReadHTML($OptionsLang["Search_button"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">"-- ALL --" in category:</td>
        <td class="left_top"><input class="input_lan" name="Category_all" type="text" value="<?php echo ReadHTML($OptionsLang["Category_all"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">'COMMENTS' link:</td>
        <td class="left_top"><input class="input_lan" name="Comments_link" type="text" value="<?php echo ReadHTML($OptionsLang["Comments_link"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Pagination "Previous":</td>
        <td class="left_top"><input class="input_lan" name="Previous" type="text" value="<?php echo ReadHTML($OptionsLang["Previous"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Pagination "Next":</td>
        <td class="left_top"><input class="input_lan" name="Next" type="text" value="<?php echo ReadHTML($OptionsLang["Next"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">No Posts:</td>
        <td class="left_top"><input class="input_lan" name="No_Posts" type="text" value="<?php echo ReadHTML($OptionsLang["No_Posts"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Link "Older Post" at the bottom of the post:</td>
        <td class="left_top"><input class="input_lan" name="Older_Post" type="text" value="<?php echo ReadHTML($OptionsLang["Older_Post"]); ?>" /> &nbsp; <sub> - leave empty if you don't want this link</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Link "Home" at the bottom of the post:</td>
        <td class="left_top"><input class="input_lan" name="Home_bottom" type="text" value="<?php echo ReadHTML($OptionsLang["Home_bottom"]); ?>" /> &nbsp; <sub> - leave empty if you don't want this link</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Link "Newer Post" at the bottom of the post:</td>
        <td class="left_top"><input class="input_lan" name="Newer_Post" type="text" value="<?php echo ReadHTML($OptionsLang["Newer_Post"]); ?>" /> &nbsp; <sub> - leave empty if you don't want this link</sub></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
      
   
   	<div class="accordion_toggle">Days of the week in the date</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Monday:</td>
        <td class="left_top"><input class="input_lan" name="Monday" type="text" value="<?php echo ReadHTML($OptionsLang["Monday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Tuesday:</td>
        <td class="left_top"><input class="input_lan" name="Tuesday" type="text" value="<?php echo ReadHTML($OptionsLang["Tuesday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Wednesday:</td>
        <td class="left_top"><input class="input_lan" name="Wednesday" type="text" value="<?php echo ReadHTML($OptionsLang["Wednesday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Thursday:</td>
        <td class="left_top"><input class="input_lan" name="Thursday" type="text" value="<?php echo ReadHTML($OptionsLang["Thursday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Friday:</td>
        <td class="left_top"><input class="input_lan" name="Friday" type="text" value="<?php echo ReadHTML($OptionsLang["Friday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Saturday:</td>
        <td class="left_top"><input class="input_lan" name="Saturday" type="text" value="<?php echo ReadHTML($OptionsLang["Saturday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Sunday:</td>
        <td class="left_top"><input class="input_lan" name="Sunday" type="text" value="<?php echo ReadHTML($OptionsLang["Sunday"]); ?>" /></td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
    
    
   	<div class="accordion_toggle">Months in the date</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">January:</td>
        <td class="left_top"><input class="input_lan" name="January" type="text" value="<?php echo ReadHTML($OptionsLang["January"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">February:</td>
        <td class="left_top"><input class="input_lan" name="February" type="text" value="<?php echo ReadHTML($OptionsLang["February"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">March:</td>
        <td class="left_top"><input class="input_lan" name="March" type="text" value="<?php echo ReadHTML($OptionsLang["March"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">April:</td>
        <td class="left_top"><input class="input_lan" name="April" type="text" value="<?php echo ReadHTML($OptionsLang["April"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">May:</td>
        <td class="left_top"><input class="input_lan" name="May" type="text" value="<?php echo ReadHTML($OptionsLang["May"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">June:</td>
        <td class="left_top"><input class="input_lan" name="June" type="text" value="<?php echo ReadHTML($OptionsLang["June"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">July:</td>
        <td class="left_top"><input class="input_lan" name="July" type="text" value="<?php echo ReadHTML($OptionsLang["July"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">August:</td>
        <td class="left_top"><input class="input_lan" name="August" type="text" value="<?php echo ReadHTML($OptionsLang["August"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">September:</td>
        <td class="left_top"><input class="input_lan" name="September" type="text" value="<?php echo ReadHTML($OptionsLang["September"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">October:</td>
        <td class="left_top"><input class="input_lan" name="October" type="text" value="<?php echo ReadHTML($OptionsLang["October"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">November:</td>
        <td class="left_top"><input class="input_lan" name="November" type="text" value="<?php echo ReadHTML($OptionsLang["November"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">December:</td>
        <td class="left_top"><input class="input_lan" name="December" type="text" value="<?php echo ReadHTML($OptionsLang["December"]); ?>" /></td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
      
    
    <div class="accordion_toggle">Post with the comments page</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Word 'Comments' under each post:</td>
        <td class="left_top">
          <input class="input_lan" name="Word_Comments" type="text" value="<?php echo ReadHTML($OptionsLang["Word_Comments"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">No comments posted:</td>
        <td class="left_top">
          <input class="input_lan" name="No_comments_posted" type="text" value="<?php echo ReadHTML($OptionsLang["No_comments_posted"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Leave a Comment:</td>
        <td class="left_top">
          <input class="input_lan" name="Leave_Comment" type="text" value="<?php echo ReadHTML($OptionsLang["Leave_Comment"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Name:</td>
        <td class="left_top"><input class="input_lan" name="Comment_Name" type="text" value="<?php echo ReadHTML($OptionsLang["Comment_Name"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Email:</td>
        <td class="left_top"><input class="input_lan" name="Comment_Email" type="text" value="<?php echo ReadHTML($OptionsLang["Comment_Email"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Comment:</td>
        <td class="left_top"><input class="input_lan" name="Comment_here" type="text" value="<?php echo ReadHTML($OptionsLang["Comment_here"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Enter verification code:</td>
        <td class="left_top"> <input class="input_lan" name="Enter_verification_code" type="text" value="<?php echo ReadHTML($OptionsLang["Enter_verification_code"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Required fields:</td>
        <td class="left_top"><input class="input_lan" name="Required_fields" type="text" value="<?php echo ReadHTML($OptionsLang["Required_fields"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Button 'Submit Comment':</td>
        <td class="left_top"><input class="input_lan" name="Submit_Comment" type="text" value="<?php echo ReadHTML($OptionsLang["Submit_Comment"]); ?>" /> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
      
   	
    <div class="accordion_toggle">System messages</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Incorrect verification code:</td>
        <td class="left_top">
          <input class="input_lan" name="Incorrect_verification_code" type="text" value="<?php echo ReadHTML($OptionsLang["Incorrect_verification_code"]); ?>" />        </td>
      </tr>
      <tr>
        <td class="langLeft">Banned word used:</td>
        <td class="left_top">
          <input class="input_lan" name="Banned_word_used" type="text" value="<?php echo ReadHTML($OptionsLang["Banned_word_used"]); ?>" />        </td>
      </tr>    
      <tr>
        <td class="langLeft">Banned IP used:</td>
        <td class="left_top">
          <input class="input_lan" name="Banned_ip_used" type="text" value="<?php echo ReadHTML($OptionsLang["Banned_ip_used"]); ?>" />  </td>
      </tr>       
      <tr>
        <td class="langLeft">Your comment has been submitted:</td>
        <td class="left_top"><input class="input_lan" name="Comment_Submitted" type="text" value="<?php echo ReadHTML($OptionsLang["Comment_Submitted"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">After approval of the administrator will be published:<br />
        <sub>/this message will appear if the option of approving post/comment is checked/</sub></td>
        <td class="left_top"><input class="input_lan" name="After_Approval_Admin" type="text" value="<?php echo ReadHTML($OptionsLang["After_Approval_Admin"]); ?>" /></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table>
    </div>
      
	<div class="accordion_toggle">Popup messages when check the required fields</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Please, fill all required fields:</td>
        <td class="left_top"><input class="input_lan" name="required_fields" type="text" value="<?php echo ReadHTML($OptionsLang["required_fields"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Please, fill correct email address:</td>
        <td class="left_top"><input class="input_lan" name="correct_email" type="text" value="<?php echo ReadHTML($OptionsLang["correct_email"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Please, enter verification code:</td>
        <td class="left_top"><input class="input_lan" name="field_code" type="text" value="<?php echo ReadHTML($OptionsLang["field_code"]); ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
      
    
    <div class="accordion_toggle">Admin email subjects</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Email subject when new comment posted:</td>
        <td class="left_top"><input class="input_lan" name="New_comment_posted" type="text" value="<?php echo ReadHTML($OptionsLang["New_comment_posted"]); ?>" /></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Default meta tags for blog page</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Meta title:</td>
        <td class="left_top"><input class="input_lan" name="metatitle" type="text" value="<?php echo ReadHTML($OptionsLang["metatitle"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Meta description:</td>
        <td class="left_top"><input class="input_lan" name="metadescription" type="text" value="<?php echo ReadHTML($OptionsLang["metadescription"]); ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
    </table> 
    </div> 
      
    </div> 
	</form>

<?php
} elseif ($_REQUEST["act"]=='html') {
?>
	<div class="pageDescr">There are two easy ways to put the blog script on your website.</div>

	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the blog to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview.php&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot; width=&quot;100%&quot; onload='this.style.height=this.contentWindow.document.body.scrollHeight + &quot;px&quot;;'&gt;&lt;/iframe&gt; </div>     
        </td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the blog to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>blog.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the comment form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	Optionally in the head section of the php page you could put(or replace your meta tags) this line of code, so meta title and meta description will work for better searching engine optimization.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>meta.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div>If you have any problems, please do not hesitate to contact us at info@simplephpscripts.com</div>     
        </td>
      </tr>
            
    </table>

<?php
} elseif ($_REQUEST["act"]=='rss') {
?>
    
    <div class="pageDescr">The RSS feed allows other people to keep track of your blog using rss readers and to use your posts on their websites. Every time you publish a new post it will appear on your RSS feed and every one using it will be informed about it.</div>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">You can view the RSS feed <a href="rss.php" target="_blank">here</a> or use the code below to place it on your website as RSS link</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.php&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
            
    </table>
    
<?php
}
?>
</div>


<?php 
} else { ////// Login Form //////
?>
<div class="admin_wrapper login_wrapper">
    <div class="login_head"><?php echo $lang['ADMIN_LOGIN']; ?></div>
    
    <div class="login_sub"><?php echo $lang['Login_context']; ?> </div>
    <form action="admin.php" method="post">
    <input type="hidden" name="act" value="login">
    <table border="0" cellspacing="0" cellpadding="0" class="loginTable">
      <tr>
        <td class="userpass"><?php echo $lang['Username']; ?> </td>
        <td class="userpassfield"><input name="user" type="text" class="loginfield" style="float:left;" /> <?php if(isset($logMessage) and $logMessage!='') {?><div class="logMessage"><?php echo $logMessage; ?></div><?php } ?></td>
      </tr>
      <tr>
        <td class="userpass"><?php echo $lang['Password']; ?> </td>
        <td class="userpassfield"><input name="pass" type="password" class="loginfield" /></td>
      </tr>
      <tr>
        <td class="userpass">&nbsp;</td>
        <td class="userpassfield"><input type="submit" name="button" value="<?php echo $lang['Login']; ?>" class="loginButon" /></td>
      </tr>
    </table>
    </form>
</div>
<?php 
}
?>

<div class="clearfooter"></div>
<div class="divProfiAnts"> <a class="footerlink" href="http://simplephpscripts.com" target="_blank">Product of ProfiAnts - SimplePHPscripts.com</a></div>

</body>
</html>