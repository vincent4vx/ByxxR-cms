<?php $this->title='Votez pour nous'?>
<?php $this->titleImg='vote'?>

Votez pour nous et gagnez jusqu'à <b><?php echo Core::conf('points.per_vote')?></b> points toute les <strong><?php echo Core::conf('points.vote_time')?></strong> minutes !<br/>
Les meilleurs voteurs seront même classés, et récompensés !<br/><br/>

<center><a onclick="window.setInterval('window.location.reload()', 1000);" href="<?php echo Url::genUrl('points/validatevote')?>" target="_blank">C'est par ici !</a></center>
