<?php $this->title='Nous rejoindre'?>
<?php $this->titleImg='inscription'?>
<fieldset>
    <legend>Tutoriel</legend>
    <center><?php echo Assets::img("config.png")?></center><br><br>
    Pour nous rejoindre, il suffit de telecharger le client dofus 1.29, puis la config et la mettre dans le dossier Dofus. Et enfin inscrivez-vous <?php echo Url::link("ici", "account", "register")?>.
</fieldset><br/>

<fieldset>
    <legend>Téléchargements</legend>
    <?php echo Url::link(Assets::img("download.png"), "home", "downloadConf").' '.  Url::link("Config.xml", "home", "downloadConf")?><br/>
    <a href="<?php echo Core::conf('server.dofus')?>"><?php echo Assets::img("download.png")?></a> <a href="<?php echo Core::conf('server.dofus')?>">Client Dofus 1.29</a>
</fieldset>