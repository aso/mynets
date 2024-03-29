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

class OpenPNE_KtaiUA
{
    var $is_ktai = false;

    var $is_docomo   = false;
    var $is_vodafone = false;
    var $is_au       = false;
    var $is_willcom  = false;
    var $is_emobile  = false;

    /**
     * constructor
     */
    function OpenPNE_KtaiUA($server = null)
    {
        if (is_null($server)) {
            $server = $_SERVER;
        }
        $this->classify($server);
    }

    /**
     * User-Agent の値からキャリア情報を判別する
     */
    function classify($server)
    {
        $ua = $server['HTTP_USER_AGENT'];

        // DoCoMo
        if (!strncmp($ua, 'DoCoMo', 6)) {
            $this->is_docomo = true;
            $this->is_ktai = true;
        }
    //DoCoMo FOMA M1000というのがある。
    elseif ( strpos($ua,'M1000') !== false ) {
        $this->is_docomo = true;
            $this->is_ktai = true;
    }
        // Vodafone(PDC)
        elseif (!strncmp($ua, 'J-PHONE', 7)) {
            $this->is_vodafone = true;
            $this->is_ktai = true;
        }
        // Vodafone(3G)
        //* Up.Browser を搭載しているものがある(auより先に評価)
        elseif (!strncmp($ua, 'Vodafone', 8)
             || !strncmp($ua, 'MOT', 3)) {
            $this->is_vodafone = true;
            $this->is_ktai = true;
        }
        // SoftBank
        elseif (!strncmp($ua, 'SoftBank', 8)) {
            $this->is_vodafone = true;
            $this->is_ktai = true;
        }

        // au
        elseif (!strncmp($ua, 'KDDI', 4)
             || !strncasecmp($ua, 'up.browser', 10)) {
            $this->is_au = true;
            $this->is_ktai = true;
        }

        // WILLCOM / DDIPOCKET
        elseif (strpos($ua, 'WILLCOM') !== false
             || strpos($ua, 'SHARP/WS') !== false
             || strpos($ua, 'DDIPOCKET') !== false) {
            $this->is_willcom = true;
            $this->is_ktai = true;
        }

        //emobile
        elseif (strpos($ua, 'emobile') !== false) {
            $this->is_emobile = true;
            $this->is_ktai = true;
        }
        else {
            $this->is_ktai = false;
        }
    }

    function is_ktai() { return $this->is_ktai; }
    function is_docomo() { return $this->is_docomo; }
    function is_vodafone() { return $this->is_vodafone; }
    function is_au() { return $this->is_au; }
    function is_willcom() { return $this->is_willcom; }
    function is_emobile() { return $this->is_emobile; }
}

?>
