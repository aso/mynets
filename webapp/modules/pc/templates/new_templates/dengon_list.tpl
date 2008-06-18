({********************************})
({******ここから：伝言板の表示一覧******})

<table border="0" cellspacing="0" cellpadding="0" style="width:440px;margin:0px auto;" class="border_07">
  <tr>
    <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    <td style="width:424px;" class="bg_00"><img src="./skin/dummy.gif" style="width:424px;height:7px;" class="dummy">
    </td>
    <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
  </tr>
  <tr>
    <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    <td class="bg_01">
({*ここから：伝言板の表示＞内容*})
({*ここから：header*})
({*小タイトル*})
      <div class="border_01">
      <table border="0" cellspacing="0" cellpadding="0" style="width:422px;">
    <tr>
      <td style="width:36px;" class="bg_06">
        <div id="aj01"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></div>
      </td>
      <td style="width:200px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">伝言板の表示</span></td>
      <td style="width:286px;" align="right" class="bg_06">&nbsp;</td>
    </tr>
      </table>
      </div>
({*ここまで：header*})
({*ここから：body*})
({*ここから：主内容*})
      <table border="0" cellspacing="0" cellpadding="0" style="width:424px;">
    <tr>
      <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy">
      </td>
      <td class="bg_01">
({*if $c_dengon_comment*})
        <table border="0" cellspacing="0" cellpadding="0" style="width:422px;">
({*ここから：主内容＞伝言板の表示*})
        <tr>
        <td class="border_01 bg_02 padding_s" style="width:422px;border-top:none;">
        <table>
        ({foreach from=$c_dengon_comment item=c_dengon})
           <tr bgcolor="({cycle values="#eeeeee,#d0d0d0"})">
            <td width="120" valign="top"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_dengon.c_member_id_from})"><span class="DOM_fh_diary_comment_writer">({$c_dengon.nickname|t_body:'name'|default:"&nbsp;"})</span></a><br>({$c_dengon.r_datetime|date_format:"%m/%d %H:%M"})</td>
            <td width="300">({$c_dengon.body|t_body:'dengon'|default:"&nbsp;"})
               ({if $c_dengon.c_member_id_from == $u || $target_c_member_id == $u})
                [<a href="({t_url m=pc a=page_fh_dengon_delete_c_dengon_comment_confirm})&amp;target_c_dengon_comment_id=({$c_dengon.c_dengon_comment_id})&amp;target_c_member_id_to=({$target_c_member_id})">削除</a>]
                ({/if})
            </td>
           </tr>
        ({/foreach})
        </table>

({*ここから：主内容＞伝言板の表示＞フッターメニュー*})
          <div align="right">
          <table border="0" cellspacing="0" cellpadding="0" style="width:130px;">
            <tr>
              <td style="width:130px;text-align:left;padding:1px 0px;">
            <img src="./skin/dummy.gif" class="icon arrow_1">
            <a href="({t_url m=pc a=page_fh_dengon})&amp;target_c_member_id=({$target_c_member_id})">→もっと読む・入力</a>
              </td>
            </tr>
          </table>
          </div>
({*ここまで：主内容＞伝言板の表示＞フッターメニュー*})

        </td>
          </tr>

({*ここまで：主内容＞伝言板の表示*})

        </table>
({*/if*})
      </td>
      <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy">
      </td>
    </tr>
    <tr>
      <td class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="height:1px;" class="dummy"></td>
    </tr>
      </table>
({*ここまで：主内容*})
({*ここまで：body*})
({*ここから：footer*})
({*ここまで：footer*})
    </td>
    <td class="bg_00"><img src="./skin/dummy.gif"></td>
  </tr>
  <tr>
    <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    <td class="bg_00"><img src="./skin/dummy.gif" style="width:424px;height:7px;" class="dummy"></td>
    <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
  </tr>
</table>
({******ここまで：最新情報一覧******})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_m">
