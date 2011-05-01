<?php
define('RAPIDLEECH', 'yes');

$time = explode (' ', microtime()); 
$begintime = $time[1] + $time[0]; unset($time);

error_reporting(0);
//error_reporting(E_ALL); 
//@ini_set('display_errors', true); 

define('MISC_DIR', 'misc/');
define('CLASS_DIR', 'classes/');
define('CONFIG_DIR', './');
define('LANG_DIR', 'languages/');
clearstatcache();
$PHP_SELF = !isset($PHP_SELF) ? $_SERVER["PHP_SELF"] : $PHP_SELF;

error_reporting(6135);
$nn = "\r\n";
$rev_num = '36B.Rv7.4';
$RL_VER = 'Rx08.ii'.$rev_num;

require_once(CONFIG_DIR."config.php");
require_once(CLASS_DIR."other.php");

// Load languages set for notes
$vpage = "notes";
require_once(LANG_DIR."language.$lang.inc.php");

$charSet = (isset($charSet) && !empty($charSet) ? $charSet : 'charset=UTF-8');

define('DOWNLOAD_DIR', (substr($download_dir, 0, 6) == "ftp://" ? '' : $download_dir));
define('TPL_PATH', 'tpl'. '/' . $csstype . '/');
define('IMAGE_DIR', MISC_DIR . TPL_PATH);

#=====================

//Cek ip yg banned || is it listed as authorized ip || check country limit
if($limited_edition || $limited_area)
{
  $dlimitation = array($limited_edition, $limited_area);
  require_once("limit_district.php");
}

if(!$forbid_notes){
 if ($login===true){
 if(!isset($_SERVER['PHP_AUTH_USER']) || ($loggeduser = logged_user($users)) === false)
	{
		header("WWW-Authenticate: Basic realm=\"Rx08\"");
		header("HTTP/1.0 401 Unauthorized");
		exit("<html>$nn<head>$nn<title>:: $RL_VER ::</title>$nn<meta http-equiv=\"Content-Type\" content=\"text/html; $charSet\"><style type=\"text/css\">$nn<!--$nn@import url(\"".IMAGE_DIR."style_sujancok".$csstype.".css\");$nn-->$nn</style>$nn</head>$nn<body>$nn<h1>$RL_VER: NuLL</h1>$nn</body>$nn</html>");
	}
 }
}else {
 echo "<html>$nn<head>$nn<title>:: $RL_VER ::</title>$nn<meta http-equiv=\"Content-Type\" content=\"text/html; $charSet\">$nn<style type=\"text/css\">$nn<!--$nn@import url(\"".IMAGE_DIR."style_sujancok".$csstype.".css\");$nn-->$nn</style></head>$nn<body>$nn<h1>:: $RL_VER :: <br>Notes Disabled</h1>$nn</body>$nn</html>";
 exit();
}


$page = 'notes';
header("Content-type: text/html; $charSet");
?><!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; <?php echo $charSet;?>">
<title>Notes :: <?php echo $RL_VER;?> ::</title>
<link rel="shortcut icon" href="<?php echo IMAGE_DIR.'idmdl.gif?'.rand(11,9999);?>" type="image/gif">

<style type="text/css">
<!--
@import url("<?php print IMAGE_DIR;?>style_sujancok<?php print $csstype;?>.css");
-->
.tdheadolgo { 
 background: transparent no-repeat url(<?php print IMAGE_DIR;?>rl_lgo.png);
}
</style>
</head><body>
<div class="head_container"><center>
<a href="<?php echo $index_file;?>" alt="Rapidleech 2.3"><div class="tdheadolgo">&nbsp;</div></a></center>
</div>
<?php

	if (!file_exists(LOG_DIR."notes.txt")){
		$temp = fopen(LOG_DIR."notes.txt","w");
		fclose($temp);
	}
	if (isset($_POST['notes']) && $_POST['notes']) {
		file_put_contents(LOG_DIR."notes.txt",$_POST['notes']);
?>
	<p>File successfully saved!</p>
<?php
	}
	$content = file_get_contents(LOG_DIR."notes.txt");
?>
<div align="center">
<form method="post" action="<?php echo (!$PHP_SELF ? $_SERVER["PHP_SELF"] : $PHP_SELF); ?>">
<textarea class="notes" name="notes" rows="18" cols="60"><?php echo $content; ?></textarea>
<br /><input type="submit" name="submit" value="Save Notes" />
</form>
</div>
<br />
</center>
</body></html>
