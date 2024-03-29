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
 *             [2007/02/28] Tabele Prefix
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

/**
 * トップバナーを1件ランダムで取得
 * 
 * @return  array  c_banner
 */
function db_banner_get_top_banner($is_logined = false)
{
    $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_banner WHERE type = \'TOP\'';
    if ($is_logined) {
        $sql .= ' AND is_hidden_after = 0';
    } else {
        $sql .= ' AND is_hidden_before = 0';
    }
    $sql .= ' ORDER BY RAND()';

    return db_get_row($sql);
}

/**
 * サイドバナーを1件ランダムで取得
 * 
 * @return  array  c_banner
 */
function db_banner_get_side_banner($is_logined = false)
{
    $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_banner WHERE type = \'SIDE\'';
    if ($is_logined) {
        $sql .= ' AND is_hidden_after = 0';
    } else {
        $sql .= ' AND is_hidden_before = 0';
    }
    $sql .= ' ORDER BY RAND()';

    return db_get_row($sql);
}

/**
 * バナーIDからバナー情報を取得
 * 
 * @param   int $c_banner_id
 * @return  array c_banner
 */
function db_banner_get_c_banner4id($c_banner_id)
{
    $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_banner WHERE c_banner_id = ?';
    $params = array(intval($c_banner_id));
    return db_get_row($sql, $params);
}

?>
