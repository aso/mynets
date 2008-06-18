            ({if $c_friend_intro_list})
<!-- ******************************** -->
<!-- ******ここから：他者評価一覧****** -->
            <table border="0" cellspacing="0" cellpadding="0" style="width:440px;margin:0px auto;" class="border_07">
                <tr>
                    <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    <td style="width:424px;" class="bg_00"><img src="./skin/dummy.gif" style="width:424px;height:7px;" class="dummy"></td>
                    <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                </tr>
                <tr>
                    <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    <td class="bg_01">
<!-- *ここから：他者評価一覧＞＞内容* -->
({*ここから：header*})
<!-- 小タイトル -->
                    <div class="border_01">
                    <table border="0" cellspacing="0" cellpadding="0" style="width:422px;">
                        <tr>
                            <td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
                            <td style="width:386px;" class="bg_06" align="center"><span class="b_b">({$WORD_MY_FRIEND})からの紹介文</span></td>
                        </tr>
                    </table>
                    </div>
({*ここまで：header*})
({*ここから：body*})
<!-- 主内容 -->
                    <table border="0" cellspacing="0" cellpadding="0" style="width:424px;">
                        <tr>
                            <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            <td class="bg_01">
                            <table border="0" cellspacing="0" cellpadding="0" style="width:422px;">
                            ({foreach from=$c_friend_intro_list item=item})
                                <tr>
                                    <td style="width:124px;border-right:none;border-top:none;" class="bg_03 border_01 padding_l" align="center">
                                        <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
                                        <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" border="0"><br>({$item.nickname|t_body:'name'})</a>
                                    </td>
                                    <td  class="bg_02 border_01 padding_l" style="width:298px;border-right:none;border-top:none;">
                                    ({$item.intro|t_truncate:"200"|nl2br|t_body:'title'})
                                    </td>
                                </tr>
                            ({/foreach})
                            </table>
({*ここまで：body*})
({*ここから：footer*})
<!-- 小メニュー -->
                            <table border="0" cellspacing="0" cellpadding="0" style="width:422px;">
                                <tr>
                                    <td style="width:1px;" class="bg_04"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                        <td style="width:290px;" class="bg_02"><span class="bg_02" style="width:290px;"><img src="./skin/dummy.gif" style="width:290px;height:1px;" class="dummy"></span></td>
                                        <td style="width:130px;" class="bg_02 lh_140 padding_s">
                                            <img src="./skin/dummy.gif" class="icon arrow_1">
                                            <a href="({t_url m=pc a=page_fh_intro})">全て見る</a>
                                            <br>
                                            <img src="./skin/dummy.gif" class="icon arrow_1">
                                            <a href="({t_url m=pc a=page_h_manage_friend})">紹介文を書く</a>                                     </td>
                                        <td style="width:1px;" class="bg_04"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                              </tr>
                                    <tr>
                                        <td style="width:1px;height:1px;" class="bg_04" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                    </tr>
                                </table>
({*ここまで：footer*})
                          </td>
                                <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
                            <tr>
                                <td class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
                        </table>
<!-- *ここまで：他者評価一覧＞＞内容* -->
                        </td>
                        <td class="bg_00"><img src="./skin/dummy.gif"></td>
                    </tr>
                    <tr>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:424px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                </table>
<!-- ******ここまで：他者評価一覧****** -->
<!-- ******************************** -->

                <img src="./skin/dummy.gif" class="v_spacer_m">
            ({/if})
