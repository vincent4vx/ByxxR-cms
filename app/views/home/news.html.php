<?php $this->title='Accueil'?>
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
	    <?php echo Assets::img('devtool/money.png').$type?> :
	</span>
	<?php echo $new['title']?>
        <br />
        <small style="text-align: right;">
            Posté par <strong><?php echo $new['author']?></strong> le <em><?php echo date('d / m / Y', $new['date'])?></em>
        </small>
    </div>
    <?php echo BBCode::parse($new['content'])?><br/>
</fieldset><br/>
<?php endforeach?>
<br/>
<div id="pagination">
    <?php echo Others::pagination($page, $end, Url::genUrl('home', 'news'), 3)?>
</div>
<?php endif?>

