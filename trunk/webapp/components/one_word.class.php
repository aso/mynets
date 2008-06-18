<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2007
 * @author     Kunitsuji <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2007/12/17]
 * ========================================================================
 */

//今日の一言を行うためのクラス

class OneWord
{
    var $uid;

    var $result;

    var $oneword;

    //会員IDのセット
    function setUid($uid)
    {
        $this->uid = $uid;
    }

    //会員の最新のコメントを取得
    function get()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE "
                    . "c_member_id = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($this->uid));
        $this->result = db_get_row($sql, $params);
        return $this->result['comment'];
    }

    //一言をセット
    function set($oneword)
    {
        $this->oneword = $oneword;
    }

    //一言を書き込み
    function add()
    {
        $data = array(
                    'c_member_id' => intval($this->uid),
                    'comment'     => strval($this->oneword),
                    'r_datetime'  => db_now(),
                );
        db_insert(MYNETS_PREFIX_NAME . 'c_one_word', $data);
    }

}
?>
