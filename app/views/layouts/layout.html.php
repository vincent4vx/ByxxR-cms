<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <title><?php echo Core::conf('server.name').' - '.$this->title?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo Assets::css('style')?>
        <?php require_once __DIR__.'/scripts.html.php'?>
	<?php echo is_string($this->headerInc)?$this->headerInc:''?>
    </head> 
    <body>
        <span style="position:absolute;margin-top:161px;margin-left:190px;color:#ffffff;text-shadow:0em 0em 0.2em #000000;font-family:Vivaldi;font-size:35px;"><?php echo Core::conf('server.name')?></span>
        <?php include APP.'views/layouts/header.html.php'?>
        <div id="bg">
            <?php include APP.'views/layouts/menu/menuleft.html.php'?>
            <?php include APP.'views/layouts/menu/menurigth.html.php'?>
                <div id="Content">
                    <div class="bgContent">
			<?php include __DIR__.'/stats.html.php'?>
                    </div>
                    <?php foreach($this->session->getFlashMsg() as $msg):?>
                    <div class="verif<?php echo $msg[1]?>">
                        <?php echo $msg[0]?>
                    </div>
                    <?php endforeach?>
                    <center><?php echo Assets::img('title/img_'.$this->titleImg.'.png', 'titleImg')?></center>
                    <div class="bgContent">
			<div class="textContent">
                            <?php echo $this->contents?>
			</div>
                    </div>
                </div>
                <div id="footer">
                    <div class="rightFooter">
                        <b><?php echo Core::conf('server.name')?></b> © <?php echo date('Y')?> - All rights reserved / Tout droits réservés.<br />
                        <b>ByxxR v<?php echo VERSION?></b> © 2013 - Css and Design by <b>Nicow</b> & <b>v4vx</b> - Php and Code by <b>v4vx</b>.<br /><br />

                        Toutes les images de se site sont la propriétés mêmes de <b>Ankamas Games</b> & <b>ByxxR CMS</b>.<br />
                        <b><?php echo Core::conf('server.name')?></b> n'est en aucun cas un site lié avec <b>Ankama Games</b>.<br />
                        <b>Dofus</b> est un jeu et une marque déposé par <b>Ankamas Games</b>.
                    </div>
                </div>
	</div>
    </body>
	<?php echo is_string($this->footerInc)?$this->footerInc:''?>
</html>


