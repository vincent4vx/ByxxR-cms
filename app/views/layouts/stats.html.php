<div class="textContent">
    <div id="cadre" style="background-image:url('<?php echo Core::conf('root').'public/images/cadres/backCadre_1.png'?>')">
	<div style="position:absolute;margin-top:9px;">Statut :
            <?php $stats = Others::getStats()?>
            <?php if($stats['state']):?>
                <span style="color:#11ff00">En ligne</span>
            <?php else:?>
                <span style="color: red">Hors ligne</span>
            <?php endif?>
	</div>
	<div style="position:absolute;margin-top:30px;">Comptes :
            <b><?php echo $stats['accounts']?></b>
	</div>
	<div style="position:absolute;margin-top:52px;">Personnages :
	    <b><?php echo $stats['characters']?></b>
	</div>
	<div style="position:absolute;margin-top:73px;">Connectés :
	    <b><?php echo $stats['online']?></b>
	</div>
	<div style="position:absolute;margin-top:94px;">Niveau moyen :
            <b><?php echo number_format($stats['lvl_moy'], 0)?></b>
	</div>
	<div style="position:absolute;margin-top:115px;">Leader :
	    <b><?php echo $stats['leader']?></b>
	</div>
    </div>
</div>
