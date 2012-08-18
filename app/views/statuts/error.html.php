<?php $this->title=$title?>
<?php $this->titleImg=$img?>
<div class="verifNO">
    <h3><?php echo $this->assets->img("devtool/error.png").$title?></h3>
    <?php echo $msg?>
    <hr/>
    <meta http-equiv="refresh" content="5;url=<?php echo $url?>" />
    <?php echo $this->url->linkByUrl('Ne pas patienter plus longtemps', $url)?>
</div>
