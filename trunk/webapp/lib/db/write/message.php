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

/**
 * メッセージ作成
 * 
 * @param   int $c_member_id_from
 * @param   int $c_member_id_to
 * @param   string  $subject
 * @param   string  $body
 * @return  int $insert_id
 */
function _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body)
{
    $data = array(
        'c_member_id_from' => intval($c_member_id_from),
        'c_member_id_to'   => intval($c_member_id_to),
        'subject'          => $subject,
        'body'             => $body,
        'r_datetime'       => db_now(),
        'is_send'          => 1,
    );
    return db_insert(MYNETS_PREFIX_NAME . 'c_message', $data);
}

/**
 * 承認メッセージ作成
 * 
 * @param   int $c_member_id_from
 * @param   int $c_member_id_to
 * @param   string  $subject
 * @param   string  $body
 * @return  int $insert_id
 */
function _do_insert_c_message_syoudaku($c_member_id_from, $c_member_id_to, $subject, $body)
{
    $data = array(
        'c_member_id_from' => intval($c_member_id_from),
        'c_member_id_to'   => intval($c_member_id_to),
        'subject'          => $subject,
        'body'             => $body,
        'r_datetime'       => db_now(),
        'is_send'          => 1,
        'is_syoudaku'      => 1,
        'is_read'          => 1,
    );
    return db_insert(MYNETS_PREFIX_NAME . 'c_message', $data);
}

/**
 * メッセージを下書き保存する
 */
function insert_message_to_is_save($c_member_id_to,$c_member_id_from,$subject,$body,$jyusin_message_id)
{
    $data = array(
        'c_member_id_from' => intval($c_member_id_from),
        'c_member_id_to'   => intval($c_member_id_to),
        'subject'          => $subject,
        'body'             => $body,
        'r_datetime'       => db_now(),
        'is_send'          => 0,
        'hensinmoto_c_message_id' => intval($jyusin_message_id),
    );
    return db_insert(MYNETS_PREFIX_NAME . 'c_message', $data);
}

/**
 * メッセージをゴミ箱へ移動
 * 受信メッセージの場合は既読にする
 * 
 * @param   int $c_message_id
 * @param   int $c_member_id
 * @return  bool  削除が成功したかどうか
 */
function _do_delete_c_message4c_message_id($c_message_id, $c_member_id)
{
    $message = _db_c_message4c_message_id($c_message_id);
    $where = 'c_message_id = '.intval($c_message_id);

    if ($message['c_member_id_to'] == $c_member_id) {
        // 受信メッセージ
        $data = array(
            'is_deleted_to' => 1,
            'is_read' => 1,
        );
        db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
        return true;
    } elseif ($message['c_member_id_from'] == $c_member_id) {
        // 送信メッセージ
        $data = array(
            'is_deleted_from' => 1,
        );
        db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
        return true;
    }

    return false;
}

/**
 * メッセージをごみ箱から元に戻す
 */
function do_h_message_box_move_message($c_message_id, $c_member_id)
{
    // 受信メッセージだった場合
    $data = array('is_deleted_from' => 0);
    $where = array(
        'c_message_id' => intval($c_message_id),
        'c_member_id_from' => intval($c_member_id),
    );
    db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);

    // 送信メッセージだった場合
    // 下書きメッセージだった場合
    $data = array('is_deleted_to' => 0);
    $where = array(
        'c_message_id' => intval($c_message_id),
        'c_member_id_to' => intval($c_member_id),
    );
    db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

/**
 * メッセージをごみ箱から削除
 */
function do_delete_c_message_from_trash($c_message_id)
{
    $data = array('is_kanzen_sakujo_from' => 1);
    $where = 'c_message_id = '.intval($c_message_id);
    db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}
function do_delete_c_message_to_trash($c_message_id)
{
    $data = array('is_kanzen_sakujo_to' => 1);
    $where = 'c_message_id = '.intval($c_message_id);
    db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

/**
 * 返信側に受信メッセージIDを渡す
 */
function do_update_is_hensinmoto_c_message_id($jyusin_c_message_id, $hensin_c_message_id)
{
    $data = array('hensinmoto_c_message_id' => intval($jyusin_c_message_id));
    $where = array('c_message_id' => intval($hensin_c_message_id));
    return db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

/**
 * 返信済みにする
 */
function do_update_is_hensin($c_message_id)
{
    $data = array('is_hensin' => 1);
    $where = array('c_message_id' => intval($c_message_id));
    db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

/**
 * メッセージを既読にする
 */
function p_h_message_update_c_message_is_read4c_message_id($c_message_id, $c_member_id)
{
    $data = array('is_read' => 1);
    $where = array(
        'c_message_id' => intval($c_message_id),
        'c_member_id_to' => intval($c_member_id),
    );
    return db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

/**
 * メッセージの下書きを更新
 */
function update_message_to_is_save($c_message_id, $subject, $body, $is_send = 0)
{
    $data = array(
        'subject'    => $subject,
        'body'       => $body,
        'r_datetime' => db_now(),
        'is_send'    => (bool)$is_send,
    );
    $where = array('c_message_id' => intval($c_message_id));
    db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

//---

//◆メッセージ受信メール
function do_common_send_message($c_member_id_from, $c_member_id_to, $subject, $body, $is_image_exist = false)
{
    //メッセージ
    $c_message_id = _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_mail_send_ktai($c_member_id_to, $c_member_id_from, $subject, $body);

    return $c_message_id;
}

//◆承認依頼メッセージ受信メール
function do_common_send_message_syoudaku($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    _do_insert_c_message_syoudaku($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_syoudaku_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_syoudaku_mail_send_ktai($c_member_id_to, $c_member_id_from);
}

// コミュニティ紹介
function do_common_send_message_syoukai_commu($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_syoukai_commu_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_syoukai_commu_mail_send_ktai($c_member_id_to, $c_member_id_from);
}

// コミュニティ参加者へのメッセージ
function do_common_send_message_sankasya_commu($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_sankasya_commu_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_sankasya_commu_mail_send_ktai($c_member_id_to, $c_member_id_from);
}

// メンバー紹介
function do_common_send_message_syoukai_member($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_syoukai_member_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_syoukai_member_mail_send_ktai($c_member_id_to, $c_member_id_from);
}

//イベント紹介
function do_common_send_message_event_invite($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_event_invite_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_event_invite_mail_send_ktai($c_member_id_to, $c_member_id_from);
}

//イベントメッセージ
function do_common_send_message_event_message($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_common_send_message_event_message_mail_send($c_member_id_to, $c_member_id_from);
    do_common_send_message_event_message_mail_send_ktai($c_member_id_to, $c_member_id_from);
}

function db_update_c_message($c_message_id, $subject, $body,
$image_filename_1 = '', $image_filename_2 = '', $image_filename_3 = '')
{
    $data = array(
        'subject' => $subject,
        'body' => $body,
    );
    if ($image_filename_1) $data['image_filename_1'] = $image_filename_1;
    if ($image_filename_2) $data['image_filename_2'] = $image_filename_2;
    if ($image_filename_3) $data['image_filename_3'] = $image_filename_3;

    $where = array(
        'c_message_id' => intval($c_message_id),
    );
    return db_update(MYNETS_PREFIX_NAME . 'c_message', $data, $where);
}

?>
