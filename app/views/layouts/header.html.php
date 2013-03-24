<div id="header" style="background-image: url('<?php echo Core::conf('root')?>public/images/header/bgHead_1.png');">
    <div id="memberSpaceH">
        <?php if(!$this->session->isLog()):?>
        <form action="<?php echo Url::genUrl('user/login?url='.urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']))?>" method="post">
                <input name="login" class="input" type="text" placeholder="Login" />
                <input name="passlog" class="input" type="password" placeholder="password" />
                <input class="input" type="submit" value="Connexion au site"/>
            </form>
        <?php else:?>
        Bienvenue <b><?php echo $this->session->pseudo?></b> ! <a href="">Profil</a> - <a href="<?php echo Url::genUrl('user/logout')?>">Se déconnecter</a>
         <?php endif?>
    </div>
</div>
