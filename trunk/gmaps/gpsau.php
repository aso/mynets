<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
</head>
<body>
<center><font color="orange">GPS�v���I��</font></center><hr>
<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @authoe     Kazuo Ide [K&X inc.] UsagiProject
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

require_once '../config.inc.php';

if ((!$_SERVER['PATH_INFO']) && (isset($_SERVER['ORIG_PATH_INFO']))) {
    $_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
}
list($dummy,$ksid,$mail) = explode("/",$_SERVER['PATH_INFO']);
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$smaj = $_GET['smaj'];
$latn = str_replace("+","",strval($lat));
$la = str_replace(".",",",$latn);
$lonn = str_replace("+","",strval($lon));
$lo = str_replace(".",",",$lonn);
$mail = str_replace('+','%2B',$mail);
echo "�v�����I�����܂���<br>";
echo "GPS�덷���x��(au):".$smaj."�i50�ȓ����������߂��܂��j<br>";
if($adrs) echo $adrs."�ł�<br>";
echo "<a href='mailto:".$mail."?body=GPS�덷���x��(au):".$smaj."%0D%0A&#60;cmd src=\"gmaps\" args=\"17,".$la.",".$lo."\"&#62;'>���L�}�b�v�Ń��[���쐬</a><br>";
echo "<a href='../../kmaps.php?$latn&amp;$lonn&amp;III'>�}�b�v���m�F</a><br>";
echo "<a href='device:gpsone?url=".OPENPNE_URL."gmaps/gpsau.php/".$ksid."/".$mail."&amp;ver=1&amp;datum=0&amp;unit=1&amp;acry=0&amp;number=0'>�Čv��</a><br>";
echo "<a href='../../../?m=ktai&amp;a=page_h_home&amp;$ksid' accesskey='0'>0.ΰ�</a>";
?>
</body>
</html>