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
 * @chengelog  [2007/02/17] Ver1.0.0Nighty package
 *             [2007/03/06] Ver1.0.0+
 * ======================================================================== 
 */


//既存のサイトからUsagiへ移動する場合の
//コメント集計及びc_diary/comment_countへの集計値移動処理

/*既存はコメントテーブルを該当のIDでカウントしていた
 *usagiではコメントプラスマイナスによるリアルタイムカウントをc_diaryに保存している
 *PNEからusagiに移動した際にコメント数の誤差をなくすためにいったん集計を行う
 *
 */

    require_once './config.inc.php';
    require_once OPENPNE_WEBAPP_DIR . '/init.inc';
    //ファイルの存在チェック（2重処理を防止するために）
    if(file_exists(OPENPNE_DIR . "/var/log/converter_check_diary.log")){
        //ファイルが見つかったので、操作を行っていると判断
        $fh=fopen(OPENPNE_DIR . "/var/log/converter_check_diary.log","r");
        echo("すでに1回実行しています。<br>");
        fpassthru($fh);
        exit();
    } else {
        $sql = "SELECT COUNT(*) as comment_count,c_diary_id FROM ".MYNETS_PREFIX_NAME."c_diary_comment group by c_diary_id";
        $log_array = db_get_all($sql);
        
        foreach ($log_array  as $key => $value) {
            echo("key = ".$value['c_diary_id']." -- value = ".$value['comment_count']."<br>");
            $sql2 = "update ".MYNETS_PREFIX_NAME."c_diary set comment_count = ".$value['comment_count']." where c_diary_id = ".$value['c_diary_id'];
            db_query($sql2);
        }
        $outputResourse = fopen(OPENPNE_DIR . "/var/log/converter_check_diary.log","a+");
        fwrite($outputResourse,date("Y年m月d日 H時i分s秒", time())."コメント数集計実行\n");
        fclose($outputResourse);
        echo("***********************************<br>");
        echo("<font color='red'>集計が終了しました。このファイルは削除するか移動して直接実行できないようにしてください。</font><br>");
        echo("実行した内容：日記データの集計＞コンバート");
        exit();
    }


?>