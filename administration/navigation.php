<?php
/*
|--------------------------------|
|		PadsanSystem CMS		 |
|--------------------------------|
|		 General Version		 |
|--------------------------------|
|Web   : www.PadsanCMS.com		 |
|Email : Support@PadsanCMS.com	 |
|Tel   : +98 - 26 325 45 700	 |
|Fax   : +98 - 26 325 45 701	 |
|--------------------------------|
*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."admin/main.php";

include INFUSIONS."user_info_panel/user_info_panel.php";

@list($title) = dbarraynum(dbquery("SELECT admin_title FROM ".DB_ADMIN." WHERE admin_link='".FUSION_SELF."'"));

add_to_title($locale['global_200'].$locale['global_123'].($title ? $locale['global_201'].$title : ""));

$pages = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false); 
$index_link = false; $admin_nav_opts = ""; $current_page = 0;

openside($locale['global_001']);
$result = dbquery("SELECT admin_title, admin_page, admin_rights, admin_link FROM ".DB_ADMIN." ORDER BY admin_page DESC, admin_title ASC");
$rows = dbrows($result);
while ($data = dbarray($result)) {		
	if ($data['admin_link'] != "reserved" && checkrights($data['admin_rights'])) {
		$pages[$data['admin_page']] .= "<option value='".ADMIN.$data['admin_link'].$aidlink."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", $data['admin_title'])."</option>\n";
	}
}

$content = false;
for ($i = 1; $i < 6; $i++) {
	$page = $pages[$i];
	if ($i == 1) {
		echo THEME_BULLET." <a href='".ADMIN."index.php".$aidlink."' class='side'>".$locale['ac00']."</a>\n";
		echo "<hr class='side-hr' />\n";
	}	
	if ($page) {
		$admin_pages = true;
		echo "<form action='".FUSION_SELF."'>\n";
		echo "<select onchange='window.location.href=this.value' style='width:100%;' class='textbox'>\n";
		echo "<option value='".FUSION_SELF."' style='font-style:italic;' selected='selected'>".$locale['ac0'.$i]."</option>\n";
		echo $page."</select>\n</form>\n";
		$content = true;
	}
	if ($i == 5) {
		if ($content) { echo "<hr class='side-hr' />\n"; }
		echo THEME_BULLET." <a href='".BASEDIR."index.php' class='side'>".$locale['global_181']."</a>\n";
	}
}

closeside();
?>