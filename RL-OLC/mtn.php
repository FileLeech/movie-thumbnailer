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
define ('CREDITS', '<small>By jmsmarcelo</small><br />');
clearstatcache();
$PHP_SELF = !isset($PHP_SELF) ? $_SERVER["PHP_SELF"] : $PHP_SELF;

error_reporting(6135);
$nn = "\r\n";
$rev_num = '36B.Rv7.4';
$RL_VER = 'Rx08.ii'.$rev_num;

require_once(CONFIG_DIR."config.php");
require_once(CLASS_DIR."other.php");

// Load languages set for mtn
$vpage = "mtn";
require_once(LANG_DIR."language.$lang.inc.php");

$charSet = (isset($charSet) && !empty($charSet) ? $charSet : 'charset=UTF-8');

define('TPL_PATH', 'tpl'. '/' . $csstype . '/');
define('IMAGE_DIR', MISC_DIR . TPL_PATH);

#=====================

//Cek ip yg banned || is it listed as authorized ip || check country limit
if($limited_edition || $limited_area)
{
  $dlimitation = array($limited_edition, $limited_area);
  require_once("limit_district.php");
}

if(!$forbid_mtn){
 if ($login===true){
 if(!isset($_SERVER['PHP_AUTH_USER']) || ($loggeduser = logged_user($users)) === false)
	{
		header("WWW-Authenticate: Basic realm=\"Rx08\"");
		header("HTTP/1.0 401 Unauthorized");
		exit("<html>$nn<head>$nn<title>:: $RL_VER ::</title>$nn<meta http-equiv=\"Content-Type\" content=\"text/html; $charSet\"><style type=\"text/css\">$nn<!--$nn@import url(\"".IMAGE_DIR."style_sujancok".$csstype.".css\");$nn-->$nn</style>$nn</head>$nn<body>$nn<h1>$RL_VER: NuLL</h1>$nn</body>$nn</html>");
	}
 }
}else {
 echo "<html>$nn<head>$nn<title>:: $RL_VER ::</title>$nn<meta http-equiv=\"Content-Type\" content=\"text/html; $charSet\">$nn<style type=\"text/css\">$nn<!--$nn@import url(\"".IMAGE_DIR."style_sujancok".$csstype.".css\");$nn-->$nn</style></head>$nn<body>$nn<h1>:: $RL_VER :: <br>MTN Disabled</h1>$nn</body>$nn</html>";
 exit();
}


$page = 'mtn';
header("Content-type: text/html; $charSet");
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo $charSet;?>">
<title>MTN :: <?php echo $RL_VER;?> ::</title>
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
<center><h2>Movie Thumbnailer</h2>
<form method="post">
<table align="center" border="0" cellspacing="2">

<tr>
<td align="right">Video File <span class="nav_text" onMouseOver="document.getElementById('help_text').style.display='block'" onMouseOut="document.getElementById('help_text').style.display='none'" style="cursor:help"> [*]</span> : </td><td><select id="video" name="video">
<?php
$exts=array(".3gp", ".3g2", ".asf", ".avi", ".dat", ".divx", ".dsm", ".evo", ".flv", ".m1v", ".m2ts", ".m2v", ".m4a", ".mj2", ".mjpg", ".mjpeg", ".mkv", ".mov", ".moov", ".mp4", ".mpg", ".mpeg", ".mpv", ".nut", ".ogg", ".ogm", ".qt", ".swf", ".ts", ".vob", ".wmv", ".xvid");
$ext="";
function vidlist($dir) 
{
	$results = array();
	$handler = opendir($dir);
	while ($file = readdir($handler)) 
	{
		if (strrchr($file,'.')!="")
		{
			$ext=strtolower(strrchr($file,'.'));
		}
		if ($file != '.' && $file != '..' && in_array($ext,$GLOBALS["exts"]))
		{
				$results[] = $file;
		}
	}
closedir($handler);
sort($results);
return $results;
}
$files = vidlist($download_dir);
foreach($files as $file)
{
	echo '<option value="'.$file.'">'.$file.'</option>';
}
?>
</select><input type="checkbox" id="all" name="all" value="true" />Generate all.</td>
</tr>

  <?php
if($navi_left["showmtnconfig"]){
?>

<tr>
<td align="right">Columns x Rows : </td><td><select id="cs" name="cs"><option value="1"<?php echo ($mtn_cs == "1" ? ' selected="selected"':'');?>>1</option>
                                                                      <option value="2"<?php echo ($mtn_cs == "2" ? ' selected="selected"':'');?>>2</option>
                                                                      <option value="3"<?php echo ($mtn_cs == "3" ? ' selected="selected"':'');?>>3</option>
                                                                      <option value="4"<?php echo ($mtn_cs == "4" ? ' selected="selected"':'');?>>4</option>
                                                                      <option value="5"<?php echo ($mtn_cs == "5" ? ' selected="selected"':'');?>>5</option></select> x <select id="rs" name="rs"><option value="1"<?php echo ($mtn_rs == "1" ? ' selected="selected"':'');?>>1</option>
                                                                                                                                                                                                  <option value="2"<?php echo ($mtn_rs == "2" ? ' selected="selected"':'');?>>2</option>
                                                                                                                                                                                                  <option value="3"<?php echo ($mtn_rs == "3" ? ' selected="selected"':'');?>>3</option>
                                                                                                                                                                                                  <option value="4"<?php echo ($mtn_rs == "4" ? ' selected="selected"':'');?>>4</option>
                                                                                                                                                                                                  <option value="5"<?php echo ($mtn_rs == "5" ? ' selected="selected"':'');?>>5</option>
                                                                                                                                                                                                  <option value="6"<?php echo ($mtn_rs == "6" ? ' selected="selected"':'');?>>6</option>
                                                                                                                                                                                                  <option value="7"<?php echo ($mtn_rs == "7" ? ' selected="selected"':'');?>>7</option>
                                                                                                                                                                                                  <option value="8"<?php echo ($mtn_rs == "8" ? ' selected="selected"':'');?>>8</option>
                                                                                                                                                                                                  <option value="9"<?php echo ($mtn_rs == "9" ? ' selected="selected"':'');?>>9</option>
                                                                                                                                                                                                  <option value="10"<?php echo ($mtn_rs == "10" ? ' selected="selected"':'');?>>10</option></select></td>
</tr>

<tr>
<td align="right">Width <span class="nav_text" onMouseOver="document.getElementById('help_text2').style.display='block'" onMouseOut="document.getElementById('help_text2').style.display='none'" style="cursor:help"> [*]</span> : </td><td><input type="text" id="w" name="w" size="3"  value="<?php echo $mtn_w; ?>" /></td>
</tr>
  
<tr>
<td align="right">Minimum Height <span class="nav_text" onMouseOver="document.getElementById('help_text3').style.display='block'" onMouseOut="document.getElementById('help_text3').style.display='none'" style="cursor:help"> [*]</span> : </td><td><input type="text" id="h" name="h" size="3"  value="<?php echo $mtn_h; ?>" /></td>
</tr>

  <?php
if($navi_left["showmtntext"]){
?>

<tr>
<td align="right">Text <span class="nav_text" onMouseOver="document.getElementById('help_text4').style.display='block'" onMouseOut="document.getElementById('help_text4').style.display='none'" style="cursor:help"> [?]</span> : </td><td><input type="text" id="T" name="T" size="25" value="<?php echo $mtn_T; ?>" /></td>
</tr>

<tr>
<td align="right">Output Suffix : </td><td><input type="text" id="o" name="o" size="25" value="<?php echo $mtn_o; ?>" /></td>
</tr>

  <?php
}
?>

<tr>
<td align="right">Background Color : </td><td><select id="k" name="k"><option value="000000"<?php echo ($mtn_k == "000000" ? ' selected="selected"':'');?>>Black</option>
                                                                      <option value="000099"<?php echo ($mtn_k == "000099" ? ' selected="selected"':'');?>>Blue</option>
                                                                      <option value="006600"<?php echo ($mtn_k == "006600" ? ' selected="selected"':'');?>>Green</option>
                                                                      <option value="CC0000"<?php echo ($mtn_k == "CC0000" ? ' selected="selected"':'');?>>Red</option>
                                                                      <option value="FFFF00"<?php echo ($mtn_k == "FFFF00" ? ' selected="selected"':'');?>>Yellow</option>
                                                                      <option value="FFFFFF"<?php echo ($mtn_k == "FFFFFF" ? ' selected="selected"':'');?>>White</option></select></td>
</tr>

<tr>
<td align="right">Jpeg Quality : </td><td><select id="j" name="j"><option value="80"<?php echo ($mtn_j == "80" ? ' selected="selected"':'');?>>Low</option>
                                                                  <option value="90"<?php echo ($mtn_j == "90" ? ' selected="selected"':'');?>>Normal</option>
                                                                  <option value="100"<?php echo ($mtn_j == "100" ? ' selected="selected"':'');?>>Right</option></select></td>
</tr>

<tr>
<td align="right">Edge <span class="nav_text" onMouseOver="document.getElementById('help_text5').style.display='block'" onMouseOut="document.getElementById('help_text5').style.display='none'" style="cursor:help"> [?]</span> : </td><td><select id="g" name="g"><option value="0"<?php echo ($mtn_g == "0" ? ' selected="selected"':'');?>>Off</option>
                                                                                                                                                                                                                                                                   <option value="1"<?php echo ($mtn_g == "1" ? ' selected="selected"':'');?>>1</option>
                                                                                                                                                                                                                                                                   <option value="2"<?php echo ($mtn_g == "2" ? ' selected="selected"':'');?>>2</option>
                                                                                                                                                                                                                                                                   <option value="3"<?php echo ($mtn_g == "3" ? ' selected="selected"':'');?>>3</option>
                                                                                                                                                                                                                                                                   <option value="4"<?php echo ($mtn_g == "4" ? ' selected="selected"':'');?>>4</option>
                                                                                                                                                                                                                                                                   <option value="5"<?php echo ($mtn_g == "5" ? ' selected="selected"':'');?>>5</option></select></td>
</tr>

<tr>
<td align="right">Individual Shots <span class="nav_text" onMouseOver="document.getElementById('help_text6').style.display='block'" onMouseOut="document.getElementById('help_text6').style.display='none'" style="cursor:help"> [?]</span> : </td><td><input type="checkbox" id="I" name="I" value="-I"<?php echo ($mtn_I == "-I" ? ' checked="checked"':'');?> />On</td>
</tr>

<tr>
<td align="right">Video Info : </td><td><input type="checkbox" id="i"  name="i" value="true"<?php echo ($mtn_i == "true" ? ' checked="checked"':'');?> />On &nbsp; <select id="Ts" name="Ts"><option value="8"<?php echo ($mtn_Ts == "8" ? ' selected="selected"':'');?>>8</option>
                                                                                                                                                                                             <option value="9"<?php echo ($mtn_Ts == "9" ? ' selected="selected"':'');?>>9</option>
                                                                                                                                                                                             <option value="10"<?php echo ($mtn_Ts == "10" ? ' selected="selected"':'');?>>10</option>
                                                                                                                                                                                             <option value="11"<?php echo ($mtn_Ts == "11" ? ' selected="selected"':'');?>>11</option>
                                                                                                                                                                                             <option value="12"<?php echo ($mtn_Ts == "12" ? ' selected="selected"':'');?>>12</option>
                                                                                                                                                                                             <option value="13"<?php echo ($mtn_Ts == "13" ? ' selected="selected"':'');?>>13</option>
                                                                                                                                                                                             <option value="14"<?php echo ($mtn_Ts == "14" ? ' selected="selected"':'');?>>14</option>
                                                                                                                                                                                             <option value="15"<?php echo ($mtn_Ts == "15" ? ' selected="selected"':'');?>>15</option></select> Size &nbsp; <select id="Tc" name="Tc"><option value="000000"<?php echo ($mtn_Tc == "000000" ? ' selected="selected"':'');?>>Black</option>
                                                                                                                                                                                                                                                                                                                                      <option value="000099"<?php echo ($mtn_Tc == "000099" ? ' selected="selected"':'');?>>Blue</option>
                                                                                                                                                                                                                                                                                                                                      <option value="006600"<?php echo ($mtn_Tc == "006600" ? ' selected="selected"':'');?>>Green</option>
                                                                                                                                                                                                                                                                                                                                      <option value="CC0000"<?php echo ($mtn_Tc == "CC0000" ? ' selected="selected"':'');?>>Red</option>
                                                                                                                                                                                                                                                                                                                                      <option value="FFFF00"<?php echo ($mtn_Tc == "FFFF00" ? ' selected="selected"':'');?>>Yellow</option>
                                                                                                                                                                                                                                                                                                                                      <option value="FFFFFF"<?php echo ($mtn_Tc == "FFFFFF" ? ' selected="selected"':'');?>>White</option></select> Color &nbsp; <select id="f" name="f"><option value="blue.ttf"<?php echo ($mtn_f == "blue.ttf" ?  ' selected="selected"':'');?>>Blue</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="georgia.ttf"<?php echo ($mtn_f == "georgia.ttf" ? ' selected="selected"':'');?>>Georgia</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="lsansuni.ttf"<?php echo ($mtn_f == "lsansuni.ttf" ? ' selected="selected"':'');?>>Lsansuni</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="pala.ttf"<?php echo ($mtn_f == "pala.ttf" ? ' selected="selected"':'');?>>Pala</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="palab.ttf"<?php echo ($mtn_f == "palab.ttf" ? ' selected="selected"':'');?>>Palab</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="palabi.ttf"<?php echo ($mtn_f == "palabi.ttf" ? ' selected="selected"':'');?>>Palabi</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="palai.ttf"<?php echo ($mtn_f == "palai.ttf" ? ' selected="selected"':'');?>>Palai</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="tahomabd.ttf"<?php echo ($mtn_f == "tahomabd.ttf" ? ' selected="selected"':'');?>>Tahomabd</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <option value="xsuni.ttf"<?php echo ($mtn_f == "xsuni.ttf" ? ' selected="selected"':'');?>>Xsuni</option></select> Font</td>
</tr>

<tr>
<td align="right">Time : </td><td><input type="checkbox" id="t" name="t" value="true"<?php echo ($mtn_t == "true" ? ' checked="checked"':'');?> />On &nbsp; <select id="tc" name="tc"><option value="000000"<?php echo ($mtn_tc == "000000" ? ' selected="selected"':'');?>>Black</option>
                                                                                                                                                                                      <option value="000099"<?php echo ($mtn_tc == "000099" ? ' selected="selected"':'');?>>Blue</option>
                                                                                                                                                                                      <option value="006600"<?php echo ($mtn_tc == "006600" ? ' selected="selected"':'');?>>Green</option>
                                                                                                                                                                                      <option value="CC0000"<?php echo ($mtn_tc == "CC0000" ? ' selected="selected"':'');?>>Red</option>
                                                                                                                                                                                      <option value="FFFF00"<?php echo ($mtn_tc == "FFFF00" ? ' selected="selected"':'');?>>Yellow</option>
                                                                                                                                                                                      <option value="FFFFFF"<?php echo ($mtn_tc == "FFFFFF" ? ' selected="selected"':'');?>>White</option></select> Color &nbsp; <select id="ts" name="ts"><option value="000000"<?php echo ($mtn_ts == "000000" ? ' selected="selected"':'');?>>Black</option>
                                                                                                                                                                                                                                                                                                                                           <option value="000099"<?php echo ($mtn_ts == "000099" ? ' selected="selected"':'');?>>Blue</option>
                                                                                                                                                                                                                                                                                                                                           <option value="006600"<?php echo ($mtn_ts == "006600" ? ' selected="selected"':'');?>>Green</option>
                                                                                                                                                                                                                                                                                                                                           <option value="CC0000"<?php echo ($mtn_ts == "CC0000" ? ' selected="selected"':'');?>>Red</option>
                                                                                                                                                                                                                                                                                                                                           <option value="FFFF00"<?php echo ($mtn_ts == "FFFF00" ? ' selected="selected"':'');?>>Yellow</option>
                                                                                                                                                                                                                                                                                                                                           <option value="FFFFFF"<?php echo ($mtn_ts == "FFFFFF" ? ' selected="selected"':'');?>>White</option></select> Shadow</td>
</tr>

<tr>
<td align="right">Location : </td><td><select id="iL" name="iL"><option value="1"<?php echo ($mtn_iL == "1" ? ' selected="selected"':'');?>>Lower Left</option>
                                                                <option value="4"<?php echo ($mtn_iL == "4" ? ' selected="selected"':'');?>>Upper Left</option></select> Info &nbsp; <select id="tL" name="tL"><option value="1"<?php echo ($mtn_tL == "1" ? ' selected="selected"':'');?>>Lower Left</option>
                                                                                                                                                                                                               <option value="2"<?php echo ($mtn_tL == "2" ? ' selected="selected"':'');?>>Lower Right</option>
                                                                                                                                                                                                               <option value="3"<?php echo ($mtn_tL == "3" ? ' selected="selected"':'');?>>Upper Right</option>
                                                                                                                                                                                                               <option value="4"<?php echo ($mtn_tL == "4" ? ' selected="selected"':'');?>>Upper Left</option></select> Time</td>
</tr>

  <?php
}
?>

<tr>
<td></td>
</tr>

<tr>
<td></td>
</tr>

<tr>
<td colspan=2><center><input type="submit" value="Generate" name="mtn" /></center></td>
</tr>

</table>
<center>
<span id="help_text" style="display:none">File should be supported:<br />.3gp, .3g2, asf, avi, dat, divx, dsm, evo, flv, M1V, m2ts, m2v, m4a, MJ2, moov mjpg. mjpeg. mkv. mov .. mp4,. mpg,. mpeg,. mpv. nut. ogg. ogm. qt. swf. ts. vob,. wmv,. xvid.</span>
<span id="help_text2" style="display:none">Width of output image; 0:column * movie width</span>
<span id="help_text3" style="display:none">Minimum height of each shot; will reduce # of column to fit</span>
<span id="help_text4" style="display:none">Add text above output image</span>
<span id="help_text5" style="display:none">Gap between each shot</span>
<span id="help_text6" style="display:none">Save individual shots too</span>
</center>
</form>

<?php include('mtn/config.php');?><br />

<?php
echo CREDITS;
?><br />
</center>
</body>
</html>