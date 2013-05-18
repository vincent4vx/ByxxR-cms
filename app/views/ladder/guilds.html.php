<?php $this->title = 'Classement des guildes'?>
<?php $this->titleImg='ladder_guilde'?>
<table style="margin: auto;width: 85%;">
    <tr>
        <th style="width: 8px;">#</th>
        <th>Nom</th>
        <th>level</th>
        <th>XP</th>
    </tr>
    <?php $i=0?>
    <?php foreach($guilds as $g):?>
    <?php echo Others::ladderTr($i)?>
        <td><?php echo $g['name']?></td>
        <td><?php echo $g['lvl']?></td>
        <td><?php echo $g['xp']?></td>
    </tr>
    <?php endforeach; ?>
</table>

