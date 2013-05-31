<?php $this->title = 'Forum : nouveau sujet'?>
<?php echo Assets::js('sceditor/minified/jquery.sceditor.bbcode.min')?>
<?php echo Assets::css('editor')?>
<?php echo Assets::js('sceditor/languages/fr')?>
<fieldset>
    <legend>Nouveau sujet</legend>
    <form action="" method="post">
        <table style="width: 100%;">
            <tr>
                <td style="width: 85px;">Titre du sujet : </td>
                <td><input style="width: 99%;" type="text" name="title" placeholder="Titre" required value="<?php if(!empty($_POST['title']))echo $_POST['title']?>"/></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="content" rows="20" cols="50" id="editor" required><?php if(!empty($_POST['content']))echo $_POST['content']?></textarea></td>
            </tr>
            <tr>
                <td><input style="width: 100%;" type="reset" value="annuler" /></td>
                <td><input style="width: 100%;" type="submit" value="valider" /></td>
            </tr>
        </table>
    </form>
</fieldset>
<script type="text/javascript">
    $("#editor").sceditor({
        plugins: "bbcode",
        emoticonsRoot: Url.baseUrl() + "public/images/",
        locale: 'fr'
    });
</script>
