<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 *
 * @copyright 2007 Kei Kubo
 */

class diary_page_detail extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function handleError()
    {
        openpne_redirect('diary', 'page_home');
    }

    function execute($requests)
    {
        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        // ----------

        $target_diary = db_public_diary_get_c_public_diary_detail($target_c_diary_id);
        $this->set('target_diary', $target_diary);

        $target_member = db_common_c_member4c_member_id($target_diary['c_member_id']);
        $this->set('target_member', $target_member);

        $year = date('Y');
        $month = date('n');
        //日記一覧、カレンダー用変数
        $date_val = array(
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
        );
        $this->set('date_val', $date_val);

        //日記のカレンダー
        $calendar = db_common_public_diary_monthly_calendar($year, $month, $target_c_member_id, $u);

        $this->set('calendar', $calendar['days']);
        $this->set('ym', $calendar['ym']);

        //最近の日記を取得
        $list_set = p_public_diary_list_diary_list4c_member_id($target_diary['c_member_id'], 7, 1);
        $this->set("new_own_diary_list", $list_set[0]);

        //最新日記
        $this->set('new_diary_list', db_diary_get_c_public_diary_list($target_c_member_id));

        //各月の日記
        $this->set('date_list', p_public_diary_list_date_list4c_member_id($target_c_member_id));

        //著作権表示
        //$this->set('sponsered_links', p_public_diary_get_sponsered_links());

        //---- inc_ テンプレート用 変数 ----//
        $title = $target_diary['subject'];
        $member = $target_diary['c_member_id'];
        $this->set('inc_html_header', fetch_inc_html_header4public_diary($title, $member));
        $this->set('inc_page_header', fetch_inc_page_header('public'));

        return 'success';
    }
}

?>
