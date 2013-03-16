<div id="header" style="background-image: url('<?php echo Core::$config['root']?>public/images/header/bgHead_1.png');">
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
