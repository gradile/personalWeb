<?php 
$installed = '';
if(!isset($configs_are_set_blog)) {
	include( dirname(__FILE__). "/configs.php");
}

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$OptionsLang = unserialize( base64_decode( $Options['language']));

if (isset($_REQUEST["pid"]) and $_REQUEST["pid"]>0) {
	$_REQUEST["pid"]= (int) SafetyDB($_REQUEST["pid"]);
	?>
	<?php 
	$sql = "SELECT * FROM ".$TABLE["Posts"]." WHERE id='".SafetyDB($_REQUEST["pid"])."' and status='Posted'";
	$sql_result = sql_result($sql);
	if(mysqli_num_rows($sql_result)>0) {	
	  $Meta = mysqli_fetch_assoc($sql_result);
	  
	  $show_image = 0;
	  if(preg_match('@<img.+src="(.*)".*>@Uims', $Meta["post_text"], $matches)) {
		  $src = $matches[1];
		  $show_image = 1;
	  }
	  
	?>
	<title><?php echo ReadHTML($Meta["post_title"]); ?></title>
	<meta name="description" content="<?php echo remove_quote(cutText(ReadHTML(strip_tags($Meta["post_text"])), 200)); ?>" />
    <meta property="og:title" content="<?php echo ReadHTML($Meta["post_title"]); ?>" />
    <?php if($show_image==1) {?>
    <meta property="og:image" content="<?php echo $src; ?>" />
    <meta property="og:image:width" content="650" />
	<meta property="og:image:height" content="650" />
    <?php } ?>
    <meta property="og:type" content="article" />
    <meta property="og:description" content="<?php echo remove_quote(cutText(ReadHTML(strip_tags($Meta["post_text"])), 500)); ?>" />
	<?php 
	} 
} else {
?>
	<title><?php echo ReadHTML($OptionsLang["metatitle"]); ?></title>
	<meta name="description" content="<?php echo ReadHTML($OptionsLang["metadescription"]); ?>" />
<?php 
}
?>