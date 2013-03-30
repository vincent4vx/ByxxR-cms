<?php $this->title='Vote déjà effectué'?>
<?php $this->titleImg='vote'?>

Vous avez déjà voté il y a moins de <b><?php echo Core::conf('points.vote_time')?></b> minutes. Votre vote n'est donc pas pris en compte.<br/>
    Veuillez revenir dans : <?php echo Assets::img('devtool/time.png')?> <b id="timer"></b>
    <?php echo Assets::js('tools')?>
    <script>
	decompte(<?php echo $time?>, "timer");
    </script>
