<?php $this->title = 'Gestion des news'?>
<?php $this->titleImg = 'admin'?>
<?php echo Assets::js('sceditor/minified/jquery.sceditor.bbcode.min')?>
<?php echo Assets::css('editor')?>
<?php echo Assets::js('sceditor/languages/fr')?>
<fieldset>
    <legend>Publier une nouvelle</legend>
    <form action="<?php echo Url::genUrl('admin/news/create')?>" method="post">
        <table style="width: 100%;">
            <tr>
                <td>
                    <select name="type" class="input" style="width: 100%;">
                        <option value="1">Info</option>
                        <option value="2">News</option>
                        <option value="3">Annonce</option>
                    </select>
                </td>
                <td><input class="input" style="width: 99%;" type="text" name="title" placeholder="Titre" required/></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="content" rows="20" cols="50" id="editor"></textarea></td>
            </tr>
            <tr>
                <td><input class="input" style="width: 100%;" type="reset" value="annuler" /></td>
                <td><input class="input" style="width: 100%;" type="submit" value="valider" /></td>
            </tr>
        </table>
    </form>
</fieldset>
<fieldset>
    <legend>Liste des news</legend>
    <table style="width: 100%">
        <tr><th style="width: 55px;">Type</th><th>Titre</th><th style="width: 95px;">Auteur</th><th style="width: 16px;"></th><th style="width: 16px;"></th></tr>
        <?php foreach($news as $new):?>
        <tr>
            <td>
                <?php
                switch($new['type']){
                    case 1:
                        echo 'Info';
                        break;
                    case 2:
                        echo 'New';
                        break;
                    case 3:
                        echo 'Annonce';
                        break;
                }
                ?>
            </td>
            <td><?php echo $new['title']?></td>
            <td><?php echo $new['author']?></td>
            <td><a href="<?php echo Url::genUrl('admin/news/delete/'.$new['id'])?>"><?php echo Assets::img("devtool/delete.png")?></a></td>
            <td><a href="<?php echo Url::genUrl('admin/news/edit/'.$new['id'])?>"><?php echo Assets::img("devtool/edit.png")?></a></td>
        </tr>
        <?php endforeach?>
    </table>
</fieldset>
<script type="text/javascript">
    $("#editor").sceditor({
        plugins: "bbcode",
        emoticonsRoot: Url.baseUrl() + "public/images/",
        locale: 'fr'
    });
</script>