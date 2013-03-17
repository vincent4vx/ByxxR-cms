<?php $this->title='Présentation du serveur'?>
<?php $this->titleImg='presentation'?>
<b><u><font color="red">Rates :</font></u></b>
<br/>
<ul id="rates">
    <li>Expérience: <em><?php echo $xp?></em></li>
    <li>Drop: <em><?php echo $drop?></em></li>
    <li>Kamas: <em><?php echo $kamas?></em></li>
    <li>Honneur: <em><?php echo $honor?></em></li>
    <li>Défie: <em><?php echo $pvp?></em></li>
</ul>
<br/>
<b><u><font color="red">Histoire :</font></u></b><br/><br/>
<?php echo Core::conf('server.histoire')?>