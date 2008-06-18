function main(zoom,lat1,lat2,lon1,lon2,type) {
var rnd = Math.floor(Math.random()*1000000);
if(type == null) {
 type = 0;
}
document.write("<script>function showmap"+lat2+lon2+rnd+"(){if(document.getElementById('gmap"+lat2+lon2+rnd+"').innerHTML==''){document.getElementById('bt"+lat2+lon2+rnd+"').src='gmaps/mapoff.gif';document.getElementById('gmap"+lat2+lon2+rnd+"').innerHTML='<br><iframe src=\"gmaps/mapcmd.php?lat="+lat1+"."+lat2+"&amp;lon="+lon1+"."+lon2+"&amp;zoom="+zoom+"&amp;type="+type+"\" frameborder=\"0\" width=\"98%\" height=\"400\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"5\"></iframe><br>';}else{document.getElementById('bt"+lat2+lon2+rnd+"').src='gmaps/mapon.gif';document.getElementById('gmap"+lat2+lon2+rnd+"').innerHTML='';}}</script>");
document.write('<a href="javascript:showmap'+lat2+lon2+rnd+'();"><img src="gmaps/mapon.gif" id="bt'+lat2+lon2+rnd+'" alt="マップ表示" align="absmiddle"></a><span id="gmap'+lat2+lon2+rnd+'"></span>');
}