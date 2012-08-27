<?php $this->pageTitle='Accueil'?>
<?php $this->titleImg='accueil'?>

<?php if($news===array()):?>
<center><font color="red">Pas de nouvelles disponibles</font></center>
<?php else:?>
<?php $types=array('infos', 'news', 'announce')?>
<?php foreach($news as $new):?>
<fieldset>
    <?php $type=$types[$new['type']-1]?>
    <div class="titleNews_<?php echo $type?>">
	<span class="title_<?php echo $type?>">
	    <?php echo $this->assets->img('devtool/money.png').$type?> : 
	</span>
	<?php echo $new['title']?>
        <br />
        <small style="text-align: right;">
            Posté par <strong><?php echo $new['author']?></strong> le <em><?php echo date('d / m / Y', $new['date'])?></em>
        </small>
    </div>
    <?php echo $new['msg']?><br/>
</fieldset><br/>
<?php endforeach?>
<?php endif?>

