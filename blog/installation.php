<?php
$installed = 'yes';
include("configs.php");

if (isset($_GET["install"]) and $_GET["install"]==1) {
	$message = '';
	$connDB = mysqli_connect(trim($_REQUEST["hostname"]), trim($_REQUEST["mysql_user"]), trim($_REQUEST["mysql_password"]));
	if (mysqli_connect_errno()) {
		$message = "MySQL database details are incorrect. Please, check the database details(MySQL server, username and password) and/or contact your hosting company to verify them. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.
		<br /> Error message: " . mysqli_connect_error();
	} else {
		if (!mysqli_select_db($connDB, trim($_REQUEST["mysql_database"]))) {
			$message = "Unable to select database. Database name is incorrect or is not created. Please check database details - MySQL server, Database name, Username and Password and try again. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.";
		} else {
					
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Posts"]."`;";
			$sql_result = sql_result($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Posts"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `publish_date` datetime default NULL,
					  `status` varchar(50) default NULL,		
					  `cat_id` int(11) default NULL,					  
					  `post_title` varchar(250) default NULL,
					  `image` varchar(250) default NULL,
					  `post_text` text,
					  `post_limit` varchar(10) default NULL,
					  `post_comments` varchar(50) default NULL,
					  `reviews` int(11) default NULL, 
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_result($sql);
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Categories"]."`;";
            $sql_result = sql_result($sql);

            $sql = "CREATE TABLE `".$TABLE["Categories"]."` (
                      `id` int(11) NOT NULL auto_increment,
                      `cat_name` varchar(250) default NULL,
                      PRIMARY KEY  (`id`))
                      CHARACTER SET utf8 COLLATE utf8_unicode_ci";
            $sql_result = sql_result($sql);
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Comments"]."`;";
			$sql_result = sql_result($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Comments"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `ipaddress` varchar(50) default NULL,
					  `publish_date` datetime default NULL,
					  `status` varchar(50) default NULL,
					  `post_id` int(11) NOT NULL,
					  `name` varchar(250) default NULL,
					  `email` varchar(250) default NULL,
					  `comment` text,
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_result($sql);
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Options"]."`;";
			$sql_result = sql_result($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Options"]."` (
					  `options_id` int(11) NOT NULL auto_increment,
					  `email` varchar(250),
					  `per_page` varchar(10),
					  `showsearch` varchar(10),
					  `showshare` varchar(10),
					  `showcategdd` varchar(10),
					  `publishon` varchar(10),
					  `share_side` varchar(20),
					  `post_limit` varchar(10),
					  `items_link` varchar(250),
					  `captcha` varchar(10),
					  `captcha_theme` varchar(20),
					  `time_zone` varchar(50),
					  `approval` varchar(20),
					  `commentsoff` varchar(10),
					  `comments_order` varchar(10),
					  `comm_req` text,
					  `ban_ips` text,
					  `ban_words` text,
					  `visual` text,
					  `visual_comm` text,
					  `language` text,
					  PRIMARY KEY  (`options_id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_result($sql);
			
			$sql = 'INSERT INTO `'.$TABLE["Options"].'` 
					SET `email`="admin@email.com", 
						`per_page`="6",
						`showsearch`="yes",
						`showshare`="yes",  
						`showcategdd`="yes",  						 
						`share_side`="right",  
						`post_limit`="90", 
						`items_link`="http://www.yourwebsite.com/blog-page.php", 						  
						`captcha`="recap", 
						`captcha_theme`="clean", 
						`approval`="true", 
						`comments_order`="AtBottom", 
						`comm_req`=\'a:1:{i:0;s:5:"Email";}\', 
						`ban_ips`="",
						
						`visual`=\'a:129:{s:15:"gen_font_family";s:51:"Raleway-Regular,Helvetica Neue,Helvetica,sans-serif";s:14:"gen_font_color";s:7:"#000000";s:13:"gen_font_size";s:7:"inherit";s:14:"gen_text_align";s:7:"inherit";s:15:"gen_line_height";s:3:"1.4";s:13:"gen_bgr_color";s:0:"";s:9:"gen_width";s:3:"800";s:13:"gen_width_dim";s:2:"px";s:10:"sear_color";s:7:"#333333";s:14:"sear_bor_color";s:7:"#eeeeee";s:12:"sb_font_size";s:4:"16px";s:14:"cat_menu_color";s:7:"#000000";s:12:"cat_menu_bgr";s:7:"#f1f1f1";s:18:"cat_menu_color_sel";s:7:"#ffffff";s:16:"cat_menu_bgr_sel";s:7:"#000000";s:15:"cat_menu_family";s:7:"inherit";s:13:"cat_menu_size";s:7:"inherit";s:15:"cat_menu_weight";s:7:"inherit";s:11:"thumb_ratio";s:2:"75";s:14:"thumb_per_line";s:5:"30.32";s:15:"list_title_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:16:"list_title_color";s:7:"#4B3C23";s:22:"list_title_color_hover";s:7:"#929292";s:15:"list_title_size";s:4:"18px";s:22:"list_title_font_weight";s:6:"normal";s:21:"list_title_font_style";s:6:"normal";s:16:"list_title_align";s:4:"left";s:22:"list_title_line_height";s:4:"28px";s:15:"post_title_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:16:"post_title_color";s:7:"#1a1a1a";s:15:"post_title_size";s:4:"25px";s:21:"post_title_font_style";s:6:"normal";s:22:"post_title_font_weight";s:6:"normal";s:16:"post_title_align";s:6:"center";s:17:"title_line_height";s:4:"28px";s:16:"title_line_color";s:7:"#eeeeee";s:15:"title_dist_line";s:4:"10px";s:16:"title_line_thick";s:3:"1px";s:14:"list_text_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:15:"list_text_color";s:7:"#555555";s:19:"list_text_bgr_color";s:0:"";s:14:"list_text_size";s:4:"13px";s:21:"list_text_font_weight";s:6:"normal";s:20:"list_text_font_style";s:6:"normal";s:20:"list_text_text_align";s:4:"left";s:21:"list_text_line_height";s:7:"inherit";s:9:"text_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:10:"text_color";s:7:"#555555";s:14:"text_bgr_color";s:0:"";s:9:"text_size";s:4:"15px";s:16:"text_font_weight";s:7:"inherit";s:15:"text_font_style";s:7:"inherit";s:15:"text_text_align";s:7:"justify";s:16:"text_line_height";s:4:"20px";s:12:"text_padding";s:3:"2px";s:14:"list_date_font";s:53:"Tex Gyre Adventor,Helvetica Neue,Helvetica,sans-serif";s:15:"list_date_color";s:7:"#555555";s:14:"list_date_size";s:4:"11px";s:20:"list_date_font_style";s:6:"normal";s:20:"list_date_text_align";s:6:"center";s:16:"list_date_format";s:6:"F j, Y";s:14:"list_show_date";s:3:"yes";s:17:"list_showing_time";s:5:"g:i a";s:9:"date_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:10:"date_color";s:7:"#555555";s:9:"date_size";s:4:"13px";s:15:"date_font_style";s:6:"normal";s:15:"date_text_align";s:4:"left";s:11:"date_format";s:7:"F jS, Y";s:9:"show_date";s:3:"yes";s:12:"showing_time";s:5:"g:i a";s:7:"show_aa";s:3:"yes";s:15:"coml_font_color";s:7:"#555555";s:21:"coml_font_color_hover";s:7:"#444444";s:9:"coml_font";s:53:"Tex Gyre Adventor,Helvetica Neue,Helvetica,sans-serif";s:14:"coml_font_size";s:4:"12px";s:15:"coml_font_style";s:6:"normal";s:16:"coml_font_weight";s:6:"normal";s:15:"back_font_color";s:7:"#929292";s:21:"back_font_color_hover";s:7:"#333333";s:14:"back_font_size";s:4:"30px";s:15:"back_font_style";s:7:"inherit";s:16:"back_font_weight";s:7:"inherit";s:20:"back_text_decoration";s:4:"none";s:26:"back_text_decoration_hover";s:4:"none";s:16:"links_font_color";s:7:"#666666";s:22:"links_font_color_hover";s:7:"#666666";s:21:"links_text_decoration";s:9:"underline";s:27:"links_text_decoration_hover";s:4:"none";s:15:"links_font_size";s:4:"12px";s:16:"links_font_style";s:6:"italic";s:17:"links_font_weight";s:6:"normal";s:14:"pag_font_color";s:0:"";s:13:"pag_bgr_color";s:0:"";s:20:"pag_font_color_hover";s:0:"";s:19:"pag_bgr_color_hover";s:0:"";s:18:"pag_font_color_sel";s:0:"";s:17:"pag_bgr_color_sel";s:0:"";s:15:"pag_font_family";s:7:"inherit";s:13:"pag_font_size";s:7:"inherit";s:15:"pag_font_weight";s:7:"inherit";s:14:"pag_font_style";s:7:"inherit";s:12:"pag_align_to";s:6:"center";s:14:"show_scrolltop";s:3:"yes";s:15:"scrolltop_width";s:4:"40px";s:16:"scrolltop_height";s:4:"40px";s:19:"scrolltop_bgr_color";s:7:"#999999";s:25:"scrolltop_bgr_color_hover";s:7:"#808080";s:17:"scrolltop_opacity";s:2:"40";s:23:"scrolltop_opacity_hover";s:2:"60";s:16:"scrolltop_radius";s:3:"0px";s:10:"bott_color";s:7:"#000000";s:16:"bott_color_hover";s:7:"#333333";s:16:"bott_color_inact";s:7:"#CCCCCC";s:9:"bott_size";s:4:"14px";s:10:"bott_style";s:6:"normal";s:11:"bott_weight";s:4:"bold";s:15:"bott_decoration";s:4:"none";s:21:"bott_decoration_hover";s:9:"underline";s:13:"dist_from_top";s:4:"30px";s:17:"dist_search_title";s:4:"18px";s:15:"dist_title_date";s:4:"24px";s:20:"list_dist_title_date";s:3:"4px";s:14:"dist_date_text";s:3:"4px";s:19:"list_dist_date_text";s:3:"4px";s:14:"dist_btw_items";s:3:"0px";s:15:"dist_link_title";s:4:"10px";s:15:"dist_comm_links";s:4:"36px";s:16:"dist_from_bottom";s:4:"30px";}\',
						
						`visual_comm`=\'a:44:{s:15:"comm_bord_sides";s:3:"top";s:15:"comm_bord_style";s:5:"solid";s:15:"comm_bord_width";s:3:"1px";s:15:"comm_bord_color";s:7:"#dddddd";s:12:"comm_padding";s:1:"1";s:13:"comm_padd_dim";s:1:"%";s:14:"comm_bgr_color";s:0:"";s:18:"w_comm_font_family";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:17:"w_comm_font_color";s:7:"#333333";s:16:"w_comm_font_size";s:4:"18px";s:17:"w_comm_font_style";s:6:"normal";s:18:"w_comm_font_weight";s:6:"normal";s:15:"name_font_color";s:7:"#E56804";s:14:"name_font_size";s:4:"14px";s:15:"name_font_style";s:6:"normal";s:16:"name_font_weight";s:4:"bold";s:14:"comm_date_font";s:7:"inherit";s:15:"comm_date_color";s:4:"#999";s:14:"comm_date_size";s:4:"12px";s:20:"comm_date_font_style";s:6:"normal";s:16:"comm_date_format";s:7:"F jS, Y";s:17:"comm_showing_time";s:5:"g:i a";s:15:"comm_font_color";s:7:"#000000";s:14:"comm_font_size";s:4:"14px";s:15:"comm_font_style";s:6:"normal";s:16:"comm_font_weight";s:6:"normal";s:16:"leave_font_color";s:7:"#000000";s:15:"leave_font_size";s:4:"15px";s:17:"leave_font_weight";s:4:"bold";s:16:"leave_font_style";s:6:"normal";s:16:"field_font_color";s:7:"#000000";s:15:"field_font_size";s:4:"12px";s:16:"field_font_style";s:6:"normal";s:17:"field_font_weight";s:6:"normal";s:14:"req_font_color";s:7:"#b39999";s:13:"req_font_size";s:4:"11px";s:10:"subm_color";s:7:"#ffffff";s:14:"subm_bgr_color";s:7:"#1a1a1a";s:15:"subm_brdr_color";s:7:"#1a1a1a";s:17:"subm_bgr_color_on";s:7:"#ffffff";s:15:"subm_bor_radius";s:3:"0px";s:16:"subm_font_weight";s:6:"normal";s:15:"subm_font_style";s:6:"normal";s:13:"dist_btw_comm";s:4:"15px";}\',
						 
						`language`=\'YTo0OTp7czo5OiJCYWNrX2hvbWUiO3M6MjU6IjxpIGNsYXNzPSdpb24tcmVwbHknPjwvaT4iO3M6MTM6IlNlYXJjaF9idXR0b24iO3M6OToiU2VhcmNoLi4uIjtzOjEyOiJDYXRlZ29yeV9hbGwiO3M6OToiLS0gQUxMIC0tIjtzOjEzOiJDb21tZW50c19saW5rIjtzOjg6IkNPTU1FTlRTIjtzOjg6IlByZXZpb3VzIjtzOjI6IsKrIjtzOjQ6Ik5leHQiO3M6MjoiwrsiO3M6ODoiTm9fUG9zdHMiO3M6ODoiTm8gUG9zdHMiO3M6MTA6Ik9sZGVyX1Bvc3QiO3M6MTA6Ik9sZGVyIFBvc3QiO3M6MTE6IkhvbWVfYm90dG9tIjtzOjQ6IkhvbWUiO3M6MTA6Ik5ld2VyX1Bvc3QiO3M6MTA6Ik5ld2VyIFBvc3QiO3M6NjoiTW9uZGF5IjtzOjM6Ik1vbiI7czo3OiJUdWVzZGF5IjtzOjM6IlR1ZSI7czo5OiJXZWRuZXNkYXkiO3M6MzoiV2VkIjtzOjg6IlRodXJzZGF5IjtzOjM6IlRodSI7czo2OiJGcmlkYXkiO3M6MzoiRnJpIjtzOjg6IlNhdHVyZGF5IjtzOjM6IlNhdCI7czo2OiJTdW5kYXkiO3M6MzoiU3VuIjtzOjc6IkphbnVhcnkiO3M6MzoiSmFuIjtzOjg6IkZlYnJ1YXJ5IjtzOjM6IkZlYiI7czo1OiJNYXJjaCI7czozOiJNYXIiO3M6NToiQXByaWwiO3M6MzoiQXByIjtzOjM6Ik1heSI7czozOiJNYXkiO3M6NDoiSnVuZSI7czozOiJKdW4iO3M6NDoiSnVseSI7czozOiJKdWwiO3M6NjoiQXVndXN0IjtzOjM6IkF1ZyI7czo5OiJTZXB0ZW1iZXIiO3M6MzoiU2VwIjtzOjc6Ik9jdG9iZXIiO3M6MzoiT2N0IjtzOjg6Ik5vdmVtYmVyIjtzOjM6Ik5vdiI7czo4OiJEZWNlbWJlciI7czozOiJEZWMiO3M6MTM6IldvcmRfQ29tbWVudHMiO3M6ODoiQ09NTUVOVFMiO3M6MTg6Ik5vX2NvbW1lbnRzX3Bvc3RlZCI7czoyMToiTm8gY29tbWVudHMgcG9zdGVkLi4uIjtzOjEzOiJMZWF2ZV9Db21tZW50IjtzOjE1OiJMZWF2ZSBhIENvbW1lbnQiO3M6MTI6IkNvbW1lbnRfTmFtZSI7czo2OiIqIE5hbWUiO3M6MTM6IkNvbW1lbnRfRW1haWwiO3M6MzE6IiogRW1haWwgKHdpbGwgbm90IGJlIHB1Ymxpc2hlZCkiO3M6MTI6IkNvbW1lbnRfaGVyZSI7czoyMjoiKiBZb3VyIGNvbW1lbnQgaGVyZS4uLiI7czoyMzoiRW50ZXJfdmVyaWZpY2F0aW9uX2NvZGUiO3M6MjU6IiogRW50ZXIgdmVyaWZpY2F0aW9uIGNvZGUiO3M6MTU6IlJlcXVpcmVkX2ZpZWxkcyI7czoxNToiUmVxdWlyZWQgZmllbGRzIjtzOjE0OiJTdWJtaXRfQ29tbWVudCI7czo2OiJTVUJNSVQiO3M6MTY6IkJhbm5lZF93b3JkX3VzZWQiO3M6MTc6IkJhbm5lZCB3b3JkIHVzZWQhIjtzOjE0OiJCYW5uZWRfaXBfdXNlZCI7czoyMzoiQmFubmVkIElQIGFkZHJlc3MgdXNlZCEiO3M6Mjc6IkluY29ycmVjdF92ZXJpZmljYXRpb25fY29kZSI7czoyODoiSW5jb3JyZWN0IHZlcmlmaWNhdGlvbiBjb2RlISI7czoxNzoiQ29tbWVudF9TdWJtaXR0ZWQiO3M6MzI6IllvdXIgY29tbWVudCBoYXMgYmVlbiBzdWJtaXR0ZWQhIjtzOjIwOiJBZnRlcl9BcHByb3ZhbF9BZG1pbiI7czo1NzoiQWZ0ZXIgYXBwcm92YWwgb2YgdGhlIGFkbWluaXN0cmF0b3IgaXQgd2lsbCBiZSBwdWJsaXNoZWQhIjtzOjE1OiJyZXF1aXJlZF9maWVsZHMiO3M6MzM6IlBsZWFzZSwgZmlsbCBhbGwgcmVxdWlyZWQgZmllbGRzISI7czoxMzoiY29ycmVjdF9lbWFpbCI7czozNToiUGxlYXNlLCBmaWxsIGNvcnJlY3QgZW1haWwgYWRkcmVzcyEiO3M6MTA6ImZpZWxkX2NvZGUiO3M6MzI6IlBsZWFzZSwgZW50ZXIgdmVyaWZpY2F0aW9uIGNvZGUhIjtzOjE4OiJOZXdfY29tbWVudF9wb3N0ZWQiO3M6MTk6Ik5ldyBjb21tZW50IHBvc3RlZCEiO3M6OToibWV0YXRpdGxlIjtzOjI5OiJEZXNpZ24gQmxvZyBQSFAgc2NyaXB0IC0gREVNTyI7czoxNToibWV0YWRlc2NyaXB0aW9uIjtzOjEyOToiVGhpcyBpcyB0aGUgZGVtbyBwYWdlIG9mIERlc2lnbiBCbG9nIFBIUCBzY3JpcHQuIEhlcmUgeW91IGNvdWxkIHNlZSBob3cgaXQgd29ya3MgaW4gZGVtbyBtb2RlIGFuZCBob3cgY291bGQgbG9vayBvbiB5b3VyIHdlYnNpdGUuIjt9\'';
			
			$sql_result = sql_result($sql);
			
					
			
			
			
			$ConfigFile = "allinfo.php";
			$CONFIG='$CONFIG';
			
			$handle = @fopen($ConfigFile, "r");
			
			if ($handle) {
				$buffer = fgets($handle, 4096);
	  			$buffer .=fgets($handle, 4096);	
				$buffer .=fgets($handle, 4096);	
				
				$buffer .=$CONFIG."[\"hostname\"]='".trim($_REQUEST["hostname"])."';\n";
				
				$buffer .=$CONFIG."[\"mysql_user\"]='".trim($_REQUEST["mysql_user"])."';\n";
				
				$buffer .=$CONFIG."[\"mysql_password\"]='".trim($_REQUEST["mysql_password"])."';\n";
				
				$buffer .=$CONFIG."[\"mysql_database\"]='".trim(addslashes($_REQUEST["mysql_database"]))."';\n";
				
				$buffer .=$CONFIG."[\"server_path\"]='".trim($_REQUEST["server_path"])."';\n";
				
				$buffer .=$CONFIG."[\"full_url\"]='".trim(addslashes($_REQUEST["full_url"]))."';\n";
								
				$buffer .=$CONFIG."[\"folder_name\"]='".trim(addslashes($_REQUEST["folder_name"]))."';\n";
				
				$buffer .=$CONFIG."[\"admin_user\"]='".trim($_REQUEST["admin_user"])."';\n";
				
				$buffer .=$CONFIG."[\"admin_pass\"]='".trim($_REQUEST["admin_pass"])."';\n";
				
				while (!feof($handle)) {
					$buffer .= fgets($handle, 4096);
				}
				
				fclose($handle);
				
				$handle = @fopen($ConfigFile, "w");
				
				if (!$handle) {
					echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				if (!fwrite($handle,$buffer)) {
				  	echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				fclose($handle);
				
			} else {
				echo "Error opening file.";
				exit();
			}
			
			$message = 'Script successfully installed';	
?>
		<script type="text/javascript">
			window.document.location.href='installation.php?install=2'
		</script>           		
<?php		
		}
	}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Script installation</title>
<link href="styles/installation.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="install_wrap">

<?php if (isset($_GET["install"]) && $_GET["install"]==2) { ?>
	<table border="0" class="form_table" align="center" cellpadding="4">
	  <tr>
      	<td>
			Script successfully installed. <a href='admin.php'>Login here</a>.
        </td>
      </tr>
    </table>
<?php } else {?>

	<form action="installation.php" method="get" name="installform">
    <input name="install" type="hidden" value="1" />
	<table border="0" class="form_table" align="center" cellpadding="4">
      
      
      <tr>
      	<td colspan="3">
        	<?php 
			if (isset($message) and $message!='') { 
				echo "<span class='alerts'>".$message."</span>";
			} else {
				echo 'These are the details that script will use to install and run: ';
			}
			?>
	  	</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">Minimum version required (PHP <?php echo $php_version_min; ?>, MySQL <?php echo $mysql_version_min; ?>): </td>
      </tr>
      
      	<?php 
		
		$error_msg = "";
		
		//////////////// CHECKING FOR PHP VERSION REQUIRED //////////////////
		
		$curr_php_version = phpversion();
		$check_php_version=true;
		
		
		if (version_compare($curr_php_version, $php_version_min, "<")) {
			//echo 'I am using PHP 5.4, my version: ' . phpversion() . "\n. Minimum is ".$php_version_min;
			$check_php_version=false;
		}
		
		if($check_php_version==false) {
			$not = "<span style='color:red;'>not</span>";
			$error_msg .= "PHP requirement checks failed and the script may not work properly. You have version ".$curr_php_version." but the required version is ".$php_version_min.". Please contact your hosting company or system administrator for assistance. <br />";
		} else {
			$not = "";
		}
		?>
        
      <tr>
        <td width="30%" align="left">PHP: </td>
        <td><?php echo "Server version of PHP '".$curr_php_version."' is ".$not." ok!"; ?> </td>
      </tr>
      
      
      	<?php 	
	  	//////////////// CHECKING FOR MYSQL VERSION REQUIRED //////////////////	
		//$curr_mysql_version = preg_replace('#[^0-9\.]#', '', mysql_get_server_info()); 
		$curr_mysql_version = '-.-.--';
		$not = "";
		
		ob_start();
		phpinfo();
		$info_arr = array();
		$info_lines = explode("\n", strip_tags(ob_get_clean(), "<tr><td><h2>"));
		$cat = "General";
		foreach($info_lines as $line) {
			
			// new cat
			preg_match("~<h2>(.*)</h2>~", $line, $title) ? $cat = $title[1] : null;
			
			if(preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val)) {
				$info_arr[$cat][$val[1]] = $val[2];
			} elseif(preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val)) {
				$info_arr[$cat][$val[1]] = array("local" => $val[2], "master" => $val[3]);
			}
			
		}
		
		$check_mysql_version=true;
		
		if (preg_match('/(\d+\.\d+\.\d+)/',$info_arr["mysql"]["Client API version "],$sql_matches)) {
			//Client API version
			$curr_mysql_version=$sql_matches[0];
			if (version_compare($sql_matches[0], $mysql_version_min, "<")) {
				$check_mysql_version=false;
			} 
		} else {
			$error_msg .= "Information about MySQL version is missing. Please ask your hosting company or system administrator for the version. The minimum required version of MySQL is ".$mysql_version_min.". <br />";
			$not = "<span style='color:red;'>not</span>";
		}
		
		
		/* if (version_compare($curr_mysql_version, $mysql_version_min, "<")) {
			$check_mysql_version=false;
		} */
		
		if($check_mysql_version==false) {
			$not = "<span style='color:red;'>not</span>";
			$error_msg .= "MySQL requirement checks failed and the script may not work properly. You have version ".$curr_mysql_version." but the required version is ".$mysql_version_min.". Please contact your hosting company or system administrator for assistance. <br />";
		} 
		?>
        
      <tr>
        <td align="left">MySQL: </td>
        <td><?php echo "Server version of MySQL '".$curr_mysql_version."' is ".$not." ok!"; ?></td>
      </tr> 
      
      <?php if(isset($error_msg) and $error_msg!='') {?>
      <tr>
        <td colspan="2" style="color:#FF0000;"><?php echo $error_msg; ?></td>
      </tr>       
      <?php } ?>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">MySQL login details: <span style="font-weight:normal; font-size:11px; font-style:italic;">(In case you don't have database yet, you should enter your hosting control panel and create it)</span></td>
      </tr>
      
      <tr>
        <td align="left">MySQL Server:</td>
        <td align="left"><input type="text" name="hostname" value="<?php if(isset($_REQUEST['hostname'])) echo $_REQUEST['hostname']; else echo 'localhost'; ?>" size="30" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Username: </td>
        <td align="left"><input name="mysql_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_user'])) echo $_REQUEST['mysql_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Password: </td>
        <td align="left"><input name="mysql_password" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_password'])) echo $_REQUEST['mysql_password']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Database name:</td>
        <td align="left"><input name="mysql_database" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_database'])) echo $_REQUEST['mysql_database']; ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">Installation paths to script directory: </td>
      </tr>
      
      	<?php 
	  	$server_path=$_SERVER['SCRIPT_FILENAME'];
		if (preg_match("/(.*)\//",$server_path,$matches)) {
			$server_path=$matches[0];
		}
		
		$server_path = str_replace("\\","/",$server_path);
		$server_path = str_replace("installation.php","",$server_path);
			
	  	?>
      <tr>
        <td align="left" valign="top">Server path to script directory:</td>
        <td align="left" colspan="2">
        	<input name="server_path" type="text" value="<?php echo $server_path; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: /home/server/public_html/SCRIPTFOLDER/ -  for Linux host</span><br />
            <span style="font-size:11px;font-style:italic;">Example: D:/server/www/websitedir/SCRIPTFOLDER/ -  for Windows host</span>
        </td>
      </tr>
      
      <?php 
	  	$full_url = 'http';
		if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$full_url .= "s";}
		$full_url .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$full_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$full_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		if (preg_match("/(.*)\//",$full_url,$matches)) {
			$full_url=$matches[0];
		}
		//$full_url = str_replace("installation.php","",$full_url);
		?>
      <tr>
        <td align="left" valign="top">Full URL to script directory:</td>
        <td align="left" colspan="2">
        	<input name="full_url" type="text" value="<?php echo $full_url; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: http://yourdomain.com/SCRIPTFOLDER/</span>
        </td>
      </tr>      
      
      	<?php 
	  	$url = $_SERVER['PHP_SELF']; 
		if (preg_match("/(.*)\//",$url,$matches)) {
			$folder_name=$matches[0];
		}
	  	?>
      <tr>
        <td align="left" valign="top">Script directory name:</td>
        <td align="left" colspan="2">
        	<input name="folder_name" type="text" value="<?php echo $folder_name; ?>" style="width:95%" /><br />
            <span style="font-size:11px;font-style:italic;">Example: /SCRIPTFOLDER/</span>
        </td>
      </tr>
      
      	
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" colspan="3" class="head_row">Administrator login details: <span style="font-weight:normal; font-size:11px; font-style:italic;">(Choose Username and Password you should use later when log in admin area)</span></td>
      </tr>
      <tr>
        <td align="left">Admin Username:</td>
        <td align="left"><input name="admin_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_user'])) echo $_REQUEST['admin_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Admin Password:</td>
        <td align="left"><input name="admin_pass" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_pass'])) echo $_REQUEST['admin_pass']; ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="installScript" type="submit" value="Install Script"></td>
      </tr>
    </table>
	</form>
<?php } ?>    

</div>

</body>
</html>
