<?php $this->title='Classement des personnages'?>
<?php $this->titleImg='ladder'?>
<table style="width: 95%;margin: auto;">
    <tr>
        <th width="8"></th>
        <th>Nom</th>
        <th width="30"><?php echo Assets::img("heads/SmallHead_0.png")?></th>
        <th>Level</th>
        <th><a href="<?php echo Url::genUrl('ladder/perso/xp')?>">Xp</a></th>
        <th><a href="<?php echo Url::genUrl('ladder/perso/kamas')?>">Kamas</a></th>
    </tr>
    <?php $i=0?>
    <?php foreach($chars as $char):?>
    <?php echo Others::ladderTr($i)?>
        <td><?php echo $char['name']?></td>
        <td><?php echo Assets::img(Others::getHead($char['class'], $char['sexe']))?></td>
        <td><?php echo $char['level']?></td>
        <td><?php echo $char['xp']?></td>
        <td><?php echo $char['kamas']?></td>
    </tr>
    <?php endforeach?>
</table>
