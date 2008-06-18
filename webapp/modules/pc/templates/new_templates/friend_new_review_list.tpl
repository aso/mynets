({if $c_friend_review_list})
<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_5">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(5)" id="mkcnt5">
        <span style="cursor: move;" class="b_b c_00">({$WORD_MY_FRIEND})最新レビュー</span>
    </div>
    <div id="cnt5" style="display:none">
        ({foreach from=$c_friend_review_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|date_format:"%m月%d日"})…&nbsp;<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$item.c_review_id})">({$item.title|t_body:'title'})</a>(({$item.nickname|t_body:'name'}))
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_friend_review_list})">もっと読む</a>
        </div>
    </div>
</div>
({/if})