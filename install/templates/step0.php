<table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
    <tbody>
    <tr>
        <td colspan="2" style="text-align:center;">
        <h1>file check</h1></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
        <p class="style2">必要なファイルが正しくアップロードされているかをチェックします。</p></td>
    </tr>
    <tr>
        <td style="text-align:right;width:120px">
        </td>
        <td style="text-align:left;width:360px">
        <p>
        <?php echo $msg; ?><br />
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;padding-top:10px;">
        
        <?php
        if ($parm_err['flag']) {
        ?>
        <form name="login_form" method="post" action="step1.php" target="_parent">
        <input type="hidden" name="task" value="step0" />
        <input type="hidden" name="set_language" value="<?= $set_language ?>" />
        <p class="GREEN fsxl">インストールできます。</p>
        <p class="style2">※インストーラーを中止する場合はブラウザを閉じて、手動で設定を行ってください。</p>
        <input type="button" value="次のステップへ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
        </form>
        </td>
    </tr>
        <?php
        } else {
        ?>
        <tr>
        <td colspan="2" style="text-align:center;padding-top:10px;">
        <form name="check_form" method="post" action="step0.php" target="_parent">
        <input type="hidden" name="task" value="step0" />
        <input type="hidden" name="set_language" value="<?= $set_language ?>" />
        <span class="style2">エラーが検出されました。上記のファイルを正しくアップロードし直し、再度チェックして下さい。
        </span><br /><input type="submit" value="再実行" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
        </form>
        </td>
    </tr>
        <?php
        }
        ?>
    </tbody>
</table>
