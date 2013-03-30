<?php $this->title='Votez pour nous'?>
<?php $this->titleImg='vote'?>

Votez pour nous et gagnez jusqu'à <b><?php echo Core::conf('points.per_vote')?></b> points toute les <strong><?php echo Core::conf('points.vote_time')?></strong> minutes !<br/>
Les meilleurs voteurs seront même classés, et récompensés !<br/><br/>

<h2 style="color: red;text-align: center;">Veuillez remettre l'image droite pour valider le vote !</h2>

<center><form action="<?php echo Url::genUrl('points/validatevote')?>" method="post">
    <?php echo $api->getCaptcha()?>
    <input type="submit" value="Voter !"/>
</form></center>
