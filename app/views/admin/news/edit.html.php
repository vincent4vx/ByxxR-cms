<?php $this->title = 'Edition de la nouvelle N°'.$id?>
<?php $this->titleImg = 'admin'?>
<?php echo Assets::js('sceditor/minified/jquery.sceditor.bbcode.min')?>
<?php echo Assets::css('editor')?>
<?php echo Assets::js('sceditor/languages/fr')?>
<form action="" method="post">
    <table style="width: 100%;">
        <tr>
            <td>
                <select name="type" class="input" style="width: 100%;">
                    <option value="1" <?php if($type==1)echo'selected'?>>Info</option>
                    <option value="2" <?php if($type==2)echo'selected'?>>News</option>
                    <option value="3" <?php if($type==3)echo'selected'?>>Annonce</option>
                </select>
            </td>
            <td><input class="input" style="width: 99%;" type="text" name="title" placeholder="Titre" value="<?php echo $title?>" required/></td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="content" rows="20" cols="50" id="editor"><?php echo $content?></textarea></td>
        </tr>
        <tr>
            <td><input class="input" style="width: 100%;" type="reset" value="annuler" /></td>
            <td><input class="input" style="width: 100%;" type="submit" value="valider" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $("#editor").sceditor({
        plugins: "bbcode",
        emoticonsRoot: Url.baseUrl() + "public/images/",
        locale: 'fr'
    });
</script>
