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

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

//デフォルトページ
$GLOBALS['__Framework']['default_page'] = 'h_home';

//<PCKTAI
if (!OPENPNE_ENABLE_PC) {
    // disable pc module
    exit;
}
//>

function init_pc_page(&$smarty)
{
    //文言系
    $smarty->assign('WORD_FRIEND', WORD_FRIEND);
    $smarty->assign('WORD_MY_FRIEND', WORD_MY_FRIEND);
    $smarty->assign('WORD_FRIEND_HALF', WORD_FRIEND_HALF);
    $smarty->assign('WORD_MY_FRIEND_HALF', WORD_MY_FRIEND_HALF);

    $is_secure = $GLOBALS['__Framework']['is_secure'];

    //---- inc_ テンプレート用 変数 ----//
    $smarty->assign('inc_html_header', fetch_inc_html_header());
    $smarty->assign('inc_page_footer', fetch_inc_page_footer($is_secure));
    $smarty->assign('inc_extension_pagelayout_top', p_common_c_siteadmin4target_pagename('inc_page_top'));
    $smarty->assign('inc_extension_pagelayout_bottom', p_common_c_siteadmin4target_pagename('inc_page_bottom'));
    $smarty->assign('inc_extension_pagelayout_top2', p_common_c_siteadmin4target_pagename('inc_page_top2'));
    $smarty->assign('inc_extension_pagelayout_bottom2', p_common_c_siteadmin4target_pagename('inc_page_bottom2'));
    $smarty->assign('inc_side_banner', db_banner_get_side_banner($is_secure));
    $smarty->assign('side_banner_html_before', p_common_c_siteadmin4target_pagename('side_banner_html_before'));
    $smarty->assign('side_banner_html_after', p_common_c_siteadmin4target_pagename('side_banner_html_after'));

    if ($is_secure) {
        $smarty->assign('inc_page_header', fetch_inc_page_header());
        @session_start();
        $smarty->assign('PHPSESSID', md5(session_id()));
        $smarty->assign('before_after', 'after');
        if (OPENPNE_USE_API) {
            $smarty->assign('api_params', api_get_params($GLOBALS['AUTH']->uid()));
        }
    } else {
        $smarty->assign('before_after', 'before');
    }
}

function init_pc_do()
{
    $is_secure = $GLOBALS['__Framework']['is_secure'];

    if ($is_secure) {
        if ($_REQUEST['sessid'] !== md5(session_id())) {
            openpne_display_error('前の画面を再読み込みして、操作をやり直してください');
        }
    }
}

?>
