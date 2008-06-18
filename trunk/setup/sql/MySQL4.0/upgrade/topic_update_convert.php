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
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/07/24] Ver1.1.0Nighty package
 * ======================================================================== 
 */


//トピックのe_datetimeカラム追加に対しての、トピック最新日付を調整するスクリプト

/*
 *トピックをすべて処理する。
 *トピックに紐づくコメントの最新登録を日付で抽出し、トピックのe_datetimeカラムをUPDATEする
 *1トピックおわれば、次のトピックへ移動。
 *ただし、全件取得してしまうと大きなサイトでは相当時間がかかるので、
 *100件単位で処理を行っていく。
 */
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors', true);
    
header("Content-type: text/html; charset=utf-8");
echo "start<br>";
require_once 'config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

//トピックを取り出すSQL
$sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic order by c_commu_topic_id";
$sqlcount = "select count(*) from ".MYNETS_PREFIX_NAME."c_commu_topic ";
//カウンターの準備
$topic_count = 1;
//実行ページサイズ  1000件単位での抽出
$page_size = 1000;
$counter = 1;

$total_count = db_get_one($sqlcount);
echo "全部で、".$total_count."件処理します<BR>";
$convert_count = ceil($total_count / $page_size);
for ($i=1;$i<=$convert_count;$i++) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic order by c_commu_topic_id";
    
    $diary_list = db_get_all_limit($sql,($i-1)*$page_size,$page_size);
    foreach($diary_list as $value) {
        setTopicEDatetime($value['c_commu_topic_id']);
        
        print $counter."/".$total_count."件処理中...<br>";
        $counter ++;
    }

}
echo "end";
exit;
//e_datetime更新
function setTopicEDatetime($c_commu_topic_id) {
    $sql = "select max(r_datetime) from ".MYNETS_PREFIX_NAME."c_commu_topic_comment" ;
    $sql .= " where c_commu_topic_id = ".$c_commu_topic_id ;
    $list = db_get_one($sql);
    if ($list) {
        $sql = "update ".MYNETS_PREFIX_NAME."c_commu_topic set e_datetime = '".$list ;
        $sql .= "' where c_commu_topic_id = ".intval($c_commu_topic_id);
        db_query($sql);
    }
    return true;
}
?>
