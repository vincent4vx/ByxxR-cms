<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <title><?php echo Core::$config['server']['name'].' - '.$this->title?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo $this->assets->css('style')?>
	<?php echo is_string($this->headerInc)?$this->headerInc:''?>
    </head> 
    <body>
        <span style="position:absolute;margin-top:161px;margin-left:190px;color:#ffffff;text-shadow:0em 0em 0.2em #000000;font-family:Vivaldi;font-size:35px;"><?php echo Core::$config['server']['name']?></span>
        <div id=header style="background-image: url('<?php echo Core::$config['root']?>public/images/header/bgHead_1.png');">
            <div id="memberSpaceH">
                <?php if(!$this->session->isLog()):?>
                    <form action="<?php echo $this->url->genUrl('account', 'login')?>" method="post">
                        <input name="login" class="input" type="text" placeholder="Login" />
                        <input name="passlog" class="input" type="password" placeholder="password" />
                        <input name="logon" class="input" type="submit" value="Connexion au site"/>
                    </form>
                <?php else:?>
                    Bienvenue <b><?php echo $this->session->pseudo?></b> ! {{ link("profil", "account") }} - {{ link("se déconnecter", "account", "logout") }} 
                <?php endif?>
            </div>
        </div>
        <div id="bg">
            <div id=menuLeft>
                <div class="titleMenuLeft"><?php echo Core::tr('layout', 'server')?></div>
		<a href="<?php echo $this->url->genUrl()?>"><li><?php echo Core::tr('layout', 'home')?></li></a>
		<a href="<?php echo $this->url->genUrl('home', 'infos')?>"><li><?php echo Core::tr('layout', 'presentation')?></li></a>
                    <a href="<?php echo $this->url->genUrl('home', 'staff')?>"><li><?php echo Core::tr('layout', 'staff')?></li></a>
                    <a href="<?php echo $this->url->genUrl('points', 'vote')?>" target="_blank"><li><b><?php echo Core::tr('layout', 'vote')?></b></li></a>
                    <a href="<?php echo $this->url->genUrl('home', 'cgu')?>"><li style="border-bottom: 1px solid #989898;"><?php echo Core::tr('layout', 'rules')?></li></a>
                <br/>
                <div class="titleMenuLeft"><?php echo Core::tr('layout', 'community')?></div>
                    <a href="<?php echo $this->url->genUrl('home', 'join')?>"><li><?php echo Core::tr('layout', 'join')?></li></a>
                    <?php if(!$this->session->isLog()):?>
                    <a href="{{ url("account", "register") }}"><li><?php echo Core::tr('layout', 'register')?></li></a>
                    <?php endif?>
                    <a target="_blank" href="{{ config.server.forum }}"><li><?php echo Core::tr('layout', 'forum')?></li></a>
                    <a href="{{ url("ladder") }}"><li><?php echo Core::tr('layout', 'ladder')?></li></a>
                    <a href="{{ url("ladder", "votes") }}"><li><?php echo Core::tr('layout', 'votes-ladder')?></li></a>
                    <a href="{{ url("ladder", "guilds") }}"><li style="border-bottom: 1px solid #989898;"><?php echo Core::tr('layout', 'guilds-ladder')?></li></a>
                <br/>
                <!--{# {% if session.isLog() %}
                <div class="titleMenuLeft">Interative</div>
                    <a href="'.$lien_perso.'"><li>Personnages</li></a>
                    <a href="'.$lien_change_name.'"><li style="border-bottom: 1px solid #989898;">Changer de nom</li></a>
                {% endif %} #}-->
            </div>
            <div id=menuRight>
                <div id="bgRight">
                    <div id="menuRightLien">
                        <?php if($this->session->isLog()):?>
                        <div class="titleMenuRight">{{ img("devtool/user.png", "devtoolIcon") }} Mon compte</div>
                            <a href="{{ url("account") }}"><li>{{ img("devtool/zoom.png", "devtoolIcon") }} Mon Profil</li></a>
                            <!--{# <a href=""><li>{{ img("devtool/cadeau.png", "devtoolIcon") }} Mes Points (<b><small>125</small></b>)</li></a> #}-->
                            <a href="{{ url("characters", "persos") }}"><li>{{ img("devtool/bug.png", "devtoolIcon") }} Mes Personnages</li></a>
                            <!--{# <a href=""><li>{{ img("devtool/construction.png", "devtoolIcon") }} Déblocage</li></a>
                            <a href=""><li>{{ img("devtool/cart.png", "devtoolIcon") }} Boutique</li></a> #}-->
                            <a href="{{ url("account", "logout") }}"><li style="margin-bottom:10px;border-bottom: 1px solid #989898;"><?php echo $this->assets->img("devtool/close.png", "devtoolIcon") ?> Déconnexion</li></a>
                        <?php endif?>
                        <?php if($this->session->isAdmin()):?>
                        <div style="margin-top: 10px;"class="titleMenuRight_ad">Administration</div>
                            <a href="{{ url("admin", "news") }}"><li>Gérez les news</li></a>
                            <a href="{{ url("admin", "accounts") }}"><li>Gérez les comptes</li></a>
                            <?php if($this->session->superAdmin()):?>
                                <a href="{{ url("admin", "staff") }}"><li>Gérez l'équipe</li></a>
                            <?php endif?>
			    {{ link('<li style="margin-bottom:10px;border-bottom: 1px solid #989898;">Vider le cache</li>', "admin", "emptycache") }}
                            <!--{# <a href=""><li style="margin-bottom:10px;border-bottom: 1px solid #989898;">Gérez la boutique</li></a> #}-->
                        <?php endif?>
                        <?php if(!$this->session->isLog()):?>
			<div class="titleMenuRight">Pas encore inscris ?</div>
                            <center><a href="{{ url("account", "register") }}"><?php echo $this->assets->img("imgInscription.png")?></a></center>
                        <?php endif?>
                    </div>
                    <?php echo $this->assets->img("bottomRight.png", "bgRight")?>
                </div>
            </div>
                <div id="Content">
                    <?php echo $this->assets->img("topContent.png")?>
                    <div id="bgContent">
			<?php echo $this->stats?>
                    </div>
                    <?php echo $this->assets->img("bottomContent.png")?>
                    <center><?php echo $this->assets->img('title/img_'.$this->titleImg.'.png')?></center>
                    <?php echo $this->assets->img("topContent.png")?>
                    <div id="bgContent">
			<div id="textContent">
                            <?php echo $this->contents?>
			</div>
                    </div>
                    <?php echo $this->assets->img("bottomContent.png")?>
                </div>
                <div id="footer">
                    <div class="rightFooter">
                        <b><?php echo Core::$config['server']['name']?></b> © <?php echo date('Y')?> - All rights reserved / Tout droits réservés.<br />
                        <b>ByxxR v<?php echo VERSION?></b> © 2012 - Css and Design by <b>Nicow</b> & <b>v4vx</b> - Php and Code by <b>v4vx</b>.<br /><br />

                        Toutes les images de se site sont la propriétés mêmes de <b>Ankamas Games</b> & <b>ByxxR CMS</b>.<br />
                        <b><?php echo Core::$config['server']['name']?></b> n'est en aucun cas un site lié avec <b>Ankama Games</b>.<br />
                        <b>Dofus</b> est un jeu et une marque déposé par <b>Ankamas Games</b>.
                    </div>
                </div>
    </body>
	<?php echo is_string($this->footerInc)?$this->footerInc:''?>
</html>


