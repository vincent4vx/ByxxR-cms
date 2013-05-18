<?php $this->title = 'Ladder votes'?>
<?php $this->titleImg='ladder_vote'?>
<table style="margin: auto;width: 75%;">
    <tr>
        <th style="width: 8px;"></th>
        <th>Pseudo</th>
        <th>Votes</th>
    </tr>
    <?php $i = 0?>
    <?php foreach($accounts as $user):?>
    <?php echo Others::ladderTr($i)?>
        <td><?php echo $user['pseudo']?></td>
        <td><?php echo $user['votes']?></td>
    </tr>
    <?php endforeach; ?>
</table>

