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


//既存のサイトからUsagiへ移動する場合の
//足跡集計及びc_memberへの追加処理

/*元々Cronのバッチを集計し、それを元に足跡を足すようになっている。
 *現在稼働中のSNSの場合、移動後足跡を集計し、c_membrにプラスする。
 *現在c_menberにすでに集計データを持っている場合もあるので
 *今のものに足すようにする
 *
 */
    
    require_once './config.inc.php';
    require_once OPENPNE_WEBAPP_DIR . '/init.inc';
        //ファイルの存在チェック（2重処理を防止するために）
        if(file_exists(OPENPNE_DIR . "/var/log/converter_check_ashiato.log")){
            //ファイルが見つかったので、操作を行っていると判断
            $fh=fopen(OPENPNE_DIR . "/var/log/converter_check_ashiato.log","r");
            echo("すでに1回実行しています。<br>");
            fpassthru($fh);
            exit();
        } else {
            $sql = "select count(*) as a_log,c_member_id_to from ".MYNETS_PREFIX_NAME."c_ashiato group by c_member_id_to";
            $log_array = db_get_all($sql);
        
            foreach ($log_array  as $key => $value) {
            echo("key = ".$value['c_member_id_to']." -- value = ".$value['a_log']."<br>");
                $sql2 = "update ".MYNETS_PREFIX_NAME."c_member set ashiato_count_log = ashiato_count_log + ".$value['a_log']." where c_member_id = ".$value['c_member_id_to'];
                db_query($sql2);
            }
            $outputResourse = fopen(OPENPNE_DIR . "/var/log/converter_check_ashiato.log","a+");
            fwrite($outputResourse,date("Y年m月d日 H時i分s秒", time())."足跡集計実行\n");
            fclose($outputResourse);
            echo("***********************************<br>");
            echo("<font color='red'>集計が終了しました。このファイルは削除するか移動して直接実行できないようにしてください。</font><br>");
            echo("実行した内容：足跡データの集計＞コンバート");
            exit();
        }
?>
