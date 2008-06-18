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

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Sample</title>
<script src="../googlemapsapi.php" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
window.onload = function() {
map = new GMap2(document.getElementById("gmap"));
<?php
echo 'var latp = '.$_GET['lat'].';';
echo 'var lngp = '.$_GET['lon'].';';
echo 'var zmp = '.$_GET['zoom'].';';
echo 'var tp = '.$_GET['type'].';';
?>
var point = new GLatLng(latp,lngp);
map.setCenter(new GLatLng(latp,lngp),zmp);
map.setMapType(map.getMapTypes()[tp]);
map.enableDoubleClickZoom();
map.enableContinuousZoom();
map.addControl(new GMapTypeControl());
map.addControl(new GLargeMapControl());
map.addControl(new GOverviewMapControl());
map.addControl(new GScaleControl());
var marker = new GMarker(point);
map.addOverlay(marker);
}

//]]>
</script>
<style type="text/css">
body {
    margin: 0px ;
    padding: 0px ;
}
</style>
</head>
<body onunload="GUnload()">
<div id="gmap" style="width: 100%; height: 400px"></div>
</body>
</html>
