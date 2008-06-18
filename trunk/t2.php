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
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.1
 * @since      File available since Release 1.0.1 Nighty
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * ========================================================================
 */


$q = $_GET["q"];
$zp = $_GET["zp"];

$ezq = explode(",",$q);
$lat = rconvert($ezq[0]);
$lon = rconvert($ezq[1]);

$eznavi = 'http://walk.eznavi.jp/map/?datum=0&amp;unit=0&amp;lat=%2b' . $lat . '&amp;lon=%2b' . $lon . '&amp;fm=0';
$glocal = 'http://www.google.co.jp/m/search?output=chtml&amp;site=maps&amp;hl=ja&amp;q=' . $q . '&amp;zp=' . $zp;

$string = "<a href=\"$eznavi\" _blank>eznaviで見る</a><br><a href=\"$glocal\" _blank>Googleマップで見る</a>";

header('Content-Type: text/html; charset=Shift_JIS');

$html = "<html>\n"
."<head>\n"
."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\"/>"
."</head>\n"
."<body><br><br>ココから先はSNS外となります。<br><br>" . $string . "</a>\n"
."</body></html>";
print($html);

function rconvert($id)
{
    $nd1 = intval($id); $id=($id-$nd1)*60.0;
    $nd2 = intval($id); $id=($id-$nd2)*60.0;
    $nd3 = intval($id); $id=($id-$nd3)*100.0;
    $nd4 = intval($id);
    return sprintf("%d.%02d.%02d.%02d",$nd1,$nd2,$nd3,$nd4);
}
?>
