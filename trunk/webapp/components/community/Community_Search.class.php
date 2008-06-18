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

//コミュニティ検索用クラス
class Community_Search
{
    var $keyword ;

    var $result = array();
    var $resultCommu  = array();
    var $resultTopic  = array();
    var $resultComent = array();

    var $target_commu_id;
    var $target_commu_topic_id;
    var $target_commu_topic_comment_id;

    var $page = 1;
    var $pagesize = 20;

    var $numrows;

    function Community_Search()
    {
        $this->__construct();
    }

    function __construct()
    {
    }

    function setKeyword($keyword)
    {
        //KeyWORDがスペースで区切られている可能性
        if (!$keyword) {
            return false;
        }
        //全角を半角に変換
        $keyword = str_replace('　', ' ', $keyword);
        //配列に変換
        $arrKeyword = explode(' ', $keyword);
        $this->keyword = $arrKeyword;
    }

    function setTargetCommuId($target_commu_id)
    {
        $this->target_commu_id = $target_commu_id;
    }

    function setTargetCommuTopicId($target_commu_topic_id)
    {
        $this->target_commu_topic_id = $target_commu_topic_id;
    }

    function setTargetCommuTopicCommentId($target_commu_topic_coment_id)
    {
        $this->target_commu_topic_comment_id = $target_commu_topic_comment_id;
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
    function getResultComment()
    {
        return $this->resultComment;
    }
    function getResultTopic()
    {
        return $this->resultTopic;
    }
    function getResultCommu()
    {
        return $this->resultCommu;
    }

    function getKeyword()
    {
        return $this->keyword;
    }
    function numrows()
    {
        return $this->numrows;
    }

    function searchComment()
    {
        $data = array();
        //コメントを検索
        $sql = "SELECT "
                    . "c_commu_topic_comment_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment "
             . "WHERE "
                    . "body LIKE ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        foreach ($this->keyword as $value) {
            $params = array('%'.strval($value).'%');
            //DB接続はMyNETS::DBを使う
            if (!$value) {
                continue;
            }
            $result = db_get_all($sql, $params);
            if ($result) {
                foreach ($result as $id) {
                    $data[] = $id['c_commu_topic_comment_id'];
                }
            }
        }
        $data = array_merge($data);
        $data = array_unique($data);
        $this->resultComment = $data;
        $this->numrows       = count($data);
    }
    function getComment()
    {
        $inkey = implode(',', $this->resultComment);
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment "
             . "WHERE "
                    . "c_commu_topic_comment_id IN (" . $inkey . ") "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        //ここでコメントデータにTOPIC題名とコミュニティ題名を追加する
        foreach ($result as $key=>$value) {
            $topic = $this->getTopicData($value['c_commu_topic_id']);
            $result[$key]['topic_name'] = $topic['name'];
            $commu = $this->getCommuData($value['c_commu_id']);
            $result[$key]['commu_name'] = $commu['name'];
            $result[$key]['commu_info'] = $commu['info'];
        }
        return $result;
    }
    function searchTopic()
    {
        $data = array();
        //コメントを検索
        $sql = "SELECT "
                    . "c_commu_topic_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "name LIKE ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        foreach ($this->keyword as $value) {
            $params = array('%'.strval($value).'%');
            //DB接続はMyNETS::DBを使う
            if (!$value) {
                continue;
            }
            $result = db_get_all($sql, $params);
            if ($result) {
                foreach ($result as $id) {
                    $data[] = $id['c_commu_topic_id'];
                }
            }
        }
        $data = array_merge($data);
        $this->resultTopic = $data;
    }
    function getTopic()
    {
        $inkey = implode(',', $this->resultTopic);
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "c_commu_topic_id IN (" . $inkey . ") "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        //ここでTOPICデータにコミュニティ題名を追加する
        foreach ($result as $key=>$value) {
            $commu = $this->getCommuData($value['c_commu_id']);
            $result[$key]['commu_name'] = $commu['name'];
            $result[$key]['commu_info'] = $commu['info'];
        }
        return $result;
    }
    function searchCommu()
    {
        $data = array();
        //コメントを検索
        $sql = "SELECT "
                    . "c_commu_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "( name LIKE ? "
                    . "OR "
                            . "info LIKE ? )"
             . "ORDER BY "
                    . "r_datetime DESC ";
        foreach ($this->keyword as $value) {
            $params = array('%'.strval($value).'%', '%'.strval($this->value).'%');
            //DB接続はMyNETS::DBを使う
            if (!$value) {
                continue;
            }
            $result = db_get_all($sql, $params);
            if ($result) {
                foreach ($result as $id) {
                    $data[] = $id['c_commu_id'];
                }
            }
        }
        $data = array_merge($data);
        $this->resultCommu = $data;
    }
    function getCommu()
    {
        $inkey = implode(',', $this->resultCommu);
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "c_commu_id IN (" . $inkey . ") "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        return $result;
    }
    function getCommuData($id)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "c_commu_id = " . intval($id) ;
        $result = db_get_row($sql);
        return $result;
    }
    function getTopicData($id)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "c_commu_topic_id = " . intval($id) ;
        $result = db_get_row($sql);
        return $result;
    }

}
?>
