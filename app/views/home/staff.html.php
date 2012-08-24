<?php $this->title='L\'équipe'?>
<?php $this->titleImg='equipe'?>
<table style="width: 100%">
    <?php foreach($staff as $account):?>
    <tr>
	<td rowspan="2" style="width: 145px;text-align: center;">
	    <strong><?php echo $account['pseudo']?></strong><br/>
	    <?php echo $this->assets->img('avatars/'.$account['avatar'])?>
	</td>
	<td><?php echo Core::tr('home/staff', 'rank')?> : <b><?php echo Core::$config['admin']['rank'][$account['level']]?></b></td>	
    </tr>
    <tr>
        <td style="vertical-align: top;">
	    <b><u><font color="red"><?php echo Core::tr('home/staff', 'info')?> :</font></u></b><br/>
	    <?php echo $account['infos']!='' ? $account['infos'] : Core::tr('home/staff', 'no-info')?>
	</td>
    </tr>
    <?php endforeach?>
</table>
