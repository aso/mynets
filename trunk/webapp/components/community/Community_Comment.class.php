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

//コミュニティコメント履歴表示のためのコンポーネント
class Community_MyComment
{
    var $uid ;

    var $result = array();

    var $target_commu_id;

    var $target_commu_topic_id;

    var $page = 1;

    var $pagesize = 20;

    function Community_MyComment()
    {
    }

    function setUid($uid)
    {
        $this->uid = $uid;
    }

    function setTargetCommuId($target_commu_id)
    {
        $this->target_commu_id = $target_commu_id;
    }

    function setTargetCommuTopicId($target_commu_topic_id)
    {
        $this->target_commu_topic_id = $target_commu_topic_id;
    }

    function setLimitOffset($page, $pagesize)
    {
        $this->page     = $page;
        $this->pagesize = $pagesize;
    }

    function getResult()
    {
        return $this->result;
    }

    function getRireki()
    {
        $sql = "SELECT "
                    . "c.*, "
                    . "b.subject as topit_title, "
                    . "a.title as commu_name "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment as c, "
                    . MYNETS_PREFIX_NAME . "c_commu_topic as b, "
                    . MYNETS_PREFIX_NAME . "c_commu as a, "
             . "WHERE "
                    . "c.commu_topic_id = b.commu_topic_id "
             . "AND "
                    . "b.commu_id = a.commu_id "
             . "AND "
                    . "c.c_member_id = ? "
             . "ORDER BY "
                    . "c.r_datetime DESC ";
        $params = array(intval($this->uid));
        //DB接続はMyNETS::DBを使う
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize, $params);
        $this->result = $result;
    }
}
?>
