<?php $this->title = 'Forum'?>
<?php $this->titleImg = 'forum'?>

<?php include __DIR__.'/../chat.html.php'?>

<?php foreach($categories as $cat):?>
<br/>
<div class="forumContainer">
    <div class="title"><?php echo $cat['name']?></div>
    <?php foreach($cat['sub_forums'] as $forum):?>
    <div class="row">
        <table>
            <tr>
                <td rowspan="2" style="width: 50%;border-right: 1px solid #4f4f4f;"><a href="<?php echo Url::forumList(array($cat['name'], $forum['name']))?>"><?php echo $forum['name']?></a></td>
                <td>50 messages</td>
                <td>Thread</td>
            </tr>
            <tr>
                <td>10 sujets</td>
                <td>12 / 05 / 2012</td>
            </tr>
        </table>
    </div>
    <?php endforeach?>
</div>
<?php endforeach?>
