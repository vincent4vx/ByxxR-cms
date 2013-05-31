<?php $this->title = 'Forum : '.$name?>
<?php $this->titleImg = 'forum'?>

<div id="forumNavBar">
<?php
$uri = $bar = array();
$bar[] = '<a href="'.Url::forum().'">Accueil</a>';
foreach($current as $page){
    $uri[] = $page;
    $bar[] = '<a href="'.Url::forumList($uri, false).'">'.urldecode($page).'</a>';
}
echo implode(' &gt; ', $bar);
?>
</div>

<div class="forumContainer">
    <div class="title">Forums dans : `<?php echo $name?>`</div>
    <?php foreach($sub_forums as $forum):?>
    <div class="row">
        <table>
            <tr>
                <td rowspan="2" style="width: 50%;border-right: 1px solid #4f4f4f;"><a href="<?php echo Url::forumList(array_merge($current, array(urlencode($forum['name']))), false)?>"><?php echo $forum['name']?></a></td>
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
<br/>
<div class="forumContainer">
    <div class="title">Sujets</div>
    <?php foreach($threads as $t):?>
    <div class="row">
        <table>
            <tr>
                <td><?php echo $t['name']?></td>
                <td>Réponses : <?php echo $t['msg_num']?></td>
            </tr>
        </table>
    </div>
    <?php endforeach?>
</div>
