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
 * @author     shinji hyodo
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/03/06] shinji hyodo added
 * ========================================================================
 */
class emoji_entity
{
    var $name;
    var $docomo;
    var $au;
    var $softbank;

    function emoji_entity( $name, $d, $a, $sb )
    {
        $this->name = $name;
        $this->docomo = $d;
        $this->au = $a;
        if (strlen($sb) == 2) {
            $this->softbank = pack('cc',0x1b,0x24) . $sb . pack('c',0x0f);
        } else {
            $this->softbank = $sb;
        }
    }
    function unescape()
    {
        if ($GLOBALS['__Framework']['ktai_carrier']=='docomo' ){
            return $this->docomo;
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'au'){
            return $this->au;
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'softbank'){
            return $this->softbank;
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'willcom'){
            return $this->docomo;                   //Willcom端末はドコモと同じフォーマット
        } elseif ($GLOBALS['__Framework']['ktai_carrier']== 'emobile'){
            return $this->docomo;                   //ドコモと同じフォーマット
        }
        return "　";
    }
}
function emoji_entity_unescape($str, $amp_escaped = false)
{
    $amp = ($amp_escaped) ? '&amp;' : '&';
    $regexp = "/$amp" . "em_([^;]*);/";
    return preg_replace_callback($regexp, 'emoji_entity_unescape_callback', $str);
}
function emoji_entity_unescape_callback($matches)
{
    $entity = $GLOBALS['EMOJI']['ENTITIES'][$matches[1]];
    if ( $entity != null ){
        return $entity->unescape();
    } else {
        return $matches[1];
    }
}
$GLOBALS['EMOJI']['ENTITIES']['sun'] = new emoji_entity('sun',pack('n',0xf89f),pack('n',0xf660),'Gj' );
$GLOBALS['EMOJI']['ENTITIES']['cloud'] = new emoji_entity('cloud',pack('n',0xf8a0),pack('n',0xf665),'Gi' );
$GLOBALS['EMOJI']['ENTITIES']['rain'] = new emoji_entity('rain',pack('n',0xf8a1),pack('n',0xf664),'Gk' );
$GLOBALS['EMOJI']['ENTITIES']['snowman'] = new emoji_entity('snowman',pack('n',0xf8a2),pack('n',0xf65d),'Gh' );
$GLOBALS['EMOJI']['ENTITIES']['thunder'] = new emoji_entity('thunder',pack('n',0xf8a3),pack('n',0xf65f),'E]' );
$GLOBALS['EMOJI']['ENTITIES']['typhoon'] = new emoji_entity('typhoon',pack('n',0xf8a4),pack('n',0xf641),'Pc' );
$GLOBALS['EMOJI']['ENTITIES']['aries'] = new emoji_entity('aries',pack('n',0xf8a7),pack('n',0xf667),'F_' );
$GLOBALS['EMOJI']['ENTITIES']['taurus'] = new emoji_entity('taurus',pack('n',0xf8a8),pack('n',0xf668),'F`' );
$GLOBALS['EMOJI']['ENTITIES']['gemini'] = new emoji_entity('gemini',pack('n',0xf8a9),pack('n',0xf669),'Fa' );
$GLOBALS['EMOJI']['ENTITIES']['cancer'] = new emoji_entity('cancer',pack('n',0xf8aa),pack('n',0xf66a),'Fb' );
$GLOBALS['EMOJI']['ENTITIES']['leo'] = new emoji_entity('leo',pack('n',0xf8ab),pack('n',0xf66b),'Fc' );
$GLOBALS['EMOJI']['ENTITIES']['virgo'] = new emoji_entity('virgo',pack('n',0xf8ac),pack('n',0xf66c),'Fd' );
$GLOBALS['EMOJI']['ENTITIES']['libra'] = new emoji_entity('libra',pack('n',0xf8ad),pack('n',0xf66d),'Fe' );
$GLOBALS['EMOJI']['ENTITIES']['scorpio'] = new emoji_entity('scorpio',pack('n',0xf8ae),pack('n',0xf66e),'Ff' );
$GLOBALS['EMOJI']['ENTITIES']['sagittarius'] = new emoji_entity('sagittarius',pack('n',0xf8af),pack('n',0xf66f),'Fg' );
$GLOBALS['EMOJI']['ENTITIES']['capricorn'] = new emoji_entity('capricorn',pack('n',0xf8b0),pack('n',0xf670),'Fh' );
$GLOBALS['EMOJI']['ENTITIES']['aquarius']= new emoji_entity('aquarius',pack('n',0xf8b1),pack('n',0xf671),'Fi' );
$GLOBALS['EMOJI']['ENTITIES']['pisces']= new emoji_entity('pisces',pack('n',0xf8b2),pack('n',0xf672),'Fj' );
$GLOBALS['EMOJI']['ENTITIES']['parking'] = new emoji_entity('parking',pack('n',0xf8cd),pack('n',0xf67e),pack('c*',0x1b,0x24,0x45,0x6f,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['house'] = new emoji_entity('house',pack('n',0xf8c4),pack('n',0xf684),pack('c*',0x1b,0x24,0x47,0x56,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['camera'] = new emoji_entity('camera',pack('n',0xf8e2),pack('n',0xf6ee),pack('c*',0x1b,0x24,0x47,0x28,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['book'] = new emoji_entity('book',pack('n',0xf8e4),pack('n',0xf677),pack('c*',0x1b,0x24,0x45,0x68,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['telephone'] = new emoji_entity('telephone',pack('n',0xf8e8),pack('n',0xf7b3),pack('c*',0x1b,0x24,0x47,0x29,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['present'] = new emoji_entity('present',pack('n',0xf8e6),pack('n',0xf6a8),pack('c*',0x1b,0x24,0x45,0x32,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['foot'] = new emoji_entity('foot',pack('n',0xf8f9),pack('n',0xf3eb),pack('c*',0x1b,0x24,0x51,0x56,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['mail'] = new emoji_entity('mail',pack('n',0xf977),pack('n',0xf6fa),pack('c*',0x1b,0x24,0x45,0x23,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['key'] = new emoji_entity('key',pack('n',0xf97d),pack('n',0xf6f2),pack('c*',0x1b,0x24,0x47,0x5f,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['search'] = new emoji_entity('search',pack('n',0xf981),pack('n',0xf6f1),pack('c*',0x1b,0x24,0x45,0x34,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['new'] = new emoji_entity('new',pack('n',0xf982),pack('n',0xf7e5),pack('c*',0x1b,0x24,0x46,0x32,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['pen'] = new emoji_entity('pen',pack('n',0xf952),pack('n',0xf679),pack('c*',0x1b,0x24,0x4F,0x21,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['1square'] = new emoji_entity('1square',pack('n',0xf987),pack('n',0xf6fb),pack('c*',0x1b,0x24,0x46,0x3c,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['2square'] = new emoji_entity('2square',pack('n',0xf988),pack('n',0xf6fc),pack('c*',0x1b,0x24,0x46,0x3d,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['3square'] = new emoji_entity('3square',pack('n',0xf989),pack('n',0xf740),pack('c*',0x1b,0x24,0x46,0x3e,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['4square'] = new emoji_entity('4square',pack('n',0xf98A),pack('n',0xf741),pack('c*',0x1b,0x24,0x46,0x3f,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['5square'] = new emoji_entity('5square',pack('n',0xf98B),pack('n',0xf742),pack('c*',0x1b,0x24,0x46,0x40,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['6square'] = new emoji_entity('6square',pack('n',0xf98C),pack('n',0xf743),pack('c*',0x1b,0x24,0x46,0x41,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['7square'] = new emoji_entity('7square',pack('n',0xf98D),pack('n',0xf744),pack('c*',0x1b,0x24,0x46,0x42,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['8square'] = new emoji_entity('8square',pack('n',0xf98E),pack('n',0xf745),pack('c*',0x1b,0x24,0x46,0x43,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['9square'] = new emoji_entity('9square',pack('n',0xf98F),pack('n',0xf746),pack('c*',0x1b,0x24,0x46,0x44,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['0square'] = new emoji_entity('0square',pack('n',0xf990),pack('n',0xf7c9),pack('c*',0x1b,0x24,0x46,0x45,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['heart'] = new emoji_entity('heart',pack('n',0xf991),pack('n',0xf7b2),pack('c*',0x1b,0x24,0x47,0x29,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['crown'] = new emoji_entity('crown',pack('n',0xf9bf),pack('n',0xf7f9),pack('c*',0x1b,0x24,0x45,0x2e,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['wrench'] = new emoji_entity('wrench',pack('n',0xf9bd),pack('n',0xf7a4),pack('c*',0x1b,0x24,0x45,0x36,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['ticket'] = new emoji_entity('ticket',pack('n',0xf8df),pack('n',0xf676),pack('c*',0x1b,0x24,0x45,0x45,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['birthday'] = new emoji_entity('birthday',pack('n',0xf8e7),pack('n',0xf7bd),pack('c*',0x1b,0x24,0x4f,0x6b,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['bulb'] = new emoji_entity('bulb',pack('n',0xf9a0),pack('n',0xf64e),pack('c*',0x1b,0x24,0x45,0x2f,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['memo'] = new emoji_entity('memo',pack('n',0xf8ea),pack('n',0xf365),pack('c*',0x1b,0x24,0x4f,0x21,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['face_goody'] = new emoji_entity('face_goody',pack('n',0xf995),pack('n',0xf649),pack('c*',0x1b,0x24,0x47,0x76,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['face_wink'] = new emoji_entity('face_wink',pack('n',0xf9ce),pack('n',0xf7f3),pack('c*',0x1b,0x24,0x50,0x25,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['tennis'] = new emoji_entity('tennis',pack('n',0xf8b6),pack('n',0xf690),pack('c*',0x1b,0x24,0x47,0x35,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['thumbs_up'] = new emoji_entity('thumbs_up',pack('n',0xf9cc),pack('n',0xf6d2),pack('c*',0x1b,0x24,0x47,0x2e,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['dollar'] = new emoji_entity('dollar',pack('n',0xf9ba),pack('n',0xf796),pack('c*',0x1b,0x24,0x45,0x4f,0x0f) );
$GLOBALS['EMOJI']['ENTITIES']['ktai'] = new emoji_entity('ktai',pack('n',0xf8e9),pack('n',0xf7a5),'G*');
$GLOBALS['EMOJI']['ENTITIES']['pc'] = new emoji_entity('pc',pack('n',0xf9bb),pack('n',0xf7e8),'G,');
?>
