<?php $this->title='L\'équipe'?>
<?php $this->titleImg='equipe'?>
<table style="width: 100%">
    <?php foreach($staff as $account):?>
    <tr>
	<td rowspan="2" style="width: 145px;text-align: center;">
	    <strong><?php echo $account['pseudo']?></strong><br/>
	    <?php echo Assets::img('avatars/'.(!empty($account['avatar']) ? $account['avatar'] : '53.jpg'))?>
	</td>
        <td><?php echo I18n::tr('rank', 'home/staff')?> : <b><?php echo Core::conf('admin.rank.'.$account['level'])?></b></td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
	    <b><u><font color="red"><?php echo I18n::tr('info', 'home/staff')?> :</font></u></b><br/>
	    <?php echo !empty($account['info']) ? $account['info'] : I18n::tr('no-info', 'home/staff')?>
	</td>
    </tr>
    <?php endforeach?>
</table>
