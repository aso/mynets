<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
</head>
<body>
<center><font color="orange">GPS計測終了</font></center><hr>
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
$pos = $_GET['pos'];
$smaj = $_GET['x-acr'];
list($lat,$lon) = explode("E",$pos);
$latn = str_replace("N","",strval($lat));
$la = explode('.',$latn);
$laa = floatval($la[0]) + (floatval($la[1])/60) + (floatval($la[2]+$la[3]/1000)/3600);
$laaa = str_replace(".",",",$laa);
$lonn = $lon;
$lo = explode('.',$lonn);
$loo = floatval($lo[0]) + (floatval($lo[1])/60) + (floatval($lo[2]+$lo[3]/1000)/3600);
$looo = str_replace(".",",",$loo);
$mail = str_replace('+','%2B',$mail);
echo "計測が終了しました<br>";
echo "GPS誤差レベル(SoftBank):".$smaj."（3をおすすめします）<br>";
echo "<a href='mailto:".$mail."?body=GPS誤差レベル(SoftBank):".$smaj."%0D%0A&#60;cmd src=\"gmaps\" args=\"17,".$laaa.",".$looo."\"&#62;'>下記マップでメール作成</a><br>";
echo "<a href='../../kmaps.php?$laa&amp;$loo&amp;III'>マップを確認</a><br>";
echo "<a href='location:auto?url=".OPENPNE_URL."gmaps/gpssoftbank.php/".$ksid."/".$mail."'>再計測</a><br>";
echo "<a href='../../../?m=ktai&amp;a=page_h_home&amp;".$ksid."' accesskey='0'>0.ﾎｰﾑ</a>";
?>

</body>
</html>
