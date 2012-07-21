<?php $this->title='Nous rejoindre'?>
<?php $this->titleImg='inscription'?>
<fieldset>
    <legend>Tutoriel</legend>
    <center><?php echo $this->assets->img("config.png")?></center><br><br>
    Pour nous rejoindre, il suffit de telecharger le client dofus 1.29, puis la config et la mettre dans le dossier Dofus. Et enfin inscrivez-vous <?php echo $this->url->link("ici", "account", "register")?>.
</fieldset><br/>

<fieldset>
    <legend>Téléchargements</legend>
    <?php echo $this->url->link($this->assets->img("download.png"), "home", "downloadConf").' '.$this->url->link("Config.xml", "home", "downloadConf")?><br/>
    <a href="<?php echo Core::$config['server']['dofus']?>"><?php echo $this->assets->img("download.png")?></a> <a href="<?php echo Core::$config['server']['dofus']?>">Client Dofus 1.29</a>
</fieldset>