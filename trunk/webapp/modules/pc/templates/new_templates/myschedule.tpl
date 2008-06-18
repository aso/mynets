        ({if $calendar})
<!-- ***************************** -->
<!-- ******ここから：週間予定****** -->
            ({t_form m=pc a=do_h_home_insert_c_schedule})
            <input type="hidden" name="sessid" value="({$PHPSESSID})">
            <input type="hidden" name="w" value="({$w})">

            <table border="0" cellspacing="0" cellpadding="0" style="width:440px;margin:0px auto;" class="border_07">
                <tr>
                    <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    <td style="width:424px;" class="bg_00"><img src="./skin/dummy.gif" style="width:424px;height:7px;" class="dummy"></td>
                    <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                </tr>
                <tr>
                    <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    <td class="bg_01" style="width:424px;">
<!-- ここから：主内容＞＞カレンダー -->
                        ({if $msg})
                        <div class="border_01 bg_02">
                            <div class="padding_s" align="left">
                            <span class="caution">({$msg})</span>
                            </div>
                        </div>
                        ({/if})
                        <div class="border_01 bg_02 padding_s" align="left">
                        予定 <input type="text" name="title" value="" size="24">
                        <select name="start_date">
                        ({foreach from=$calendar item=item})
                            <option value="({$item.year})-({$item.month})-({$item.day})"({if $item.now}) selected="selected"({/if})>({$item.month})/({$item.day})(({$item.dayofweek}))</option>
                        ({/foreach})
                        </select>
                        <input type="submit" class="submit" value="追加">
                        &nbsp;
                        <a href="({t_url m=pc a=page_h_home})&amp;w=({$w-1})" title="前の週">＜</a>
                        <a href="({t_url m=pc a=page_h_home})" title="今週">■</a>
                        <a href="({t_url m=pc a=page_h_home})&amp;w=({$w+1})" title="次の週">＞</a>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0" style="width:424px;">
                            <tr>
                            ({foreach from=$calendar item=item name=calendar})
                                <td style="width:({if $smarty.foreach.calendar.last})64({else})60({/if})px;({if !$smarty.foreach.calendar.last})border-right:none;({/if})" align="left" valign="top" class="border_01 bg_0({if $item.now})9({else})2({/if})({if $item.dayofweek == "日"}) c_02({elseif $item.dayofweek == "土"}) c_03({/if}) padding_s">
                                ({if $item.now})<span class="b_b">({/if})
                                ({if $smarty.foreach.calendar.first || $item.day == 1})
                                ({$item.month})/({/if})
                                ({$item.day})<br>
                                (({$item.dayofweek}))<br>
                                ({if $item.now})</span>({/if})
                                <div>
                                ({* 誕生日 *})
                                ({foreach from=$item.birth item=item_birth})
                                    <img src="({t_img_url_skin filename=icon_birthday})" class="icon"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item_birth.c_member_id})">({$item_birth.nickname|t_body:'name'})さん</a><br>
                                ({/foreach})
                                ({* イベント *})
                                ({foreach from=$item.event item=item_event})
                                    <img src="({if $item_event.is_join})({t_img_url_skin filename=icon_event_R})({else})({t_img_url_skin filename=icon_event_B})({/if})" class="icon"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$item_event.c_commu_topic_id})">({$item_event.name|t_truncate:36:".."|t_body:'name'})</a><br>
                                ({/foreach})
                                ({* スケジュール *})
                                ({foreach from=$item.schedule item=item_schedule})
                                    <img src="({t_img_url_skin filename=icon_pen})" class="icon"><a href="({t_url m=pc a=page_h_schedule})&amp;target_c_schedule_id=({$item_schedule.c_schedule_id})">({$item_schedule.title|t_body:'title'})</a><br>
                                ({/foreach})
                                </div>
                                </td>
                            ({/foreach})
                            </tr>
                        </table>

                        <div style="text-align:right;padding-right:20px;" class="border_01 bg_02 padding_s">
                        <img src="./skin/dummy.gif" class="icon arrow_1">
                        <a href="({t_url m=pc a=page_h_calendar})">月別カレンダー</a>
                        </div>

<!-- ここまで：主内容＞＞カレンダー -->
                        </td>
                        <td class="bg_00"><img src="./skin/dummy.gif"></td>
                    </tr>
                    <tr>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:424px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                </table>

                </form>
<!-- ******ここまで：週間予定****** -->
<!-- ***************************** -->

                <img src="./skin/dummy.gif" class="v_spacer_m">

            ({/if})
