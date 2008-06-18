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


$url = $_SERVER["QUERY_STRING"];

header('Content-Type: text/html; charset=Shift_JIS');

$html = "<html>\n"
."<head>\n"
."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\">"
."</head>\n"
."<body><br><br>ココから先はSNS外となります。<br><br><a href=\"".$url."\">".$url."</a>\n"
."</body></html>";
print($html);
?>
