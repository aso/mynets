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
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */


//Ver1.0.1から1.1.0へ以降した際の
//コメント番号の集計、更新

/*
 *日記をすべて処理する。
 *日記に紐づくコメントを日付の順に抽出し、上から番号をつけていく
 *1日記処理終われば、次の日記へ移動。
 *ただし、全件取得してしまうと大きなサイトでは相当時間がかかるので、
 *100件単位で処理を行っていく。
 */
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors', true);
    
header("Content-type: text/html; charset=utf-8");
echo "start<br>";
require_once 'config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

//日記のもとを取り出すSQL
//$sql = "select * from ".MYNETS_PREFIX_NAME."c_diary order by c_diary_id";
$sqlcount = "select count(*) from ".MYNETS_PREFIX_NAME."c_diary ";
//カウンターの準備
$diary_count = 1;
//実行ページサイズ  100件単位での抽出
$page_size = 100;
$counter = 1;

$total_count = db_get_one($sqlcount);
echo "全部で、".$total_count."件処理します<BR>";
$convert_count = ceil($total_count / $page_size);
for ($i=1;$i<=$convert_count;$i++) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary order by c_diary_id";
    
    $diary_list = db_get_all_limit($sql,($i-1)*$page_size,$page_size);
    foreach($diary_list as $value) {
        setCommentNo($value['c_diary_id']);
        
        print $counter."/".$total_count."件処理中...<br>";
        $counter ++;
    }

}
echo "end";
exit;
//c_diary_commentにコメント番号付与
function setCommentNo($c_diary_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary_comment" ;
    $sql .= " where c_diary_id = ".$c_diary_id." order by r_datetime" ;
    $list = db_get_all($sql);
    $i = 1;
    foreach($list as $value) {
        $sql = "update ".MYNETS_PREFIX_NAME."c_diary_comment set comment_number = ".$i ;
        $sql .= " where c_diary_comment_id = ".intval($value['c_diary_comment_id']);
        db_query($sql);
        $i++;
    }
    return true;
}
?>
