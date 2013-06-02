<?php $this->title = 'Achat de code'?>
<?php $this->titleImg = 'boutique'?>
<div align="center">
L'achat de points vous permettra de gagner <b><?php echo Core::conf('points.per_code')?></b> Points.<br />
Les micropaiements s'effectue par <a href="http://www.starpass.fr/" target="_blank">StarPass™</a>, éditée par <a href="http://www.bdmultimedia.fr/" target="_blank">BD Multimédia</a><br /><br />
<b>Pour obtenir vos codes d'accès :</b><br /><br />
Veuillez cliquer sur le drapeau de votre pays<br /><br />
<a onclick="getNumber('fr')" href="#number"><?php echo Assets::img('flags/fr.png', array('class'=>'aImg','title'=>'France'))?></a>
<a onclick="getNumber('be')" href="#number"><?php echo Assets::img('flags/be.png', array('class'=>'aImg','title'=>'Belgique'))?></a>
<a onclick="getNumber('ch')" href="#number"><?php echo Assets::img('flags/ch.png', array('class'=>'aImg','title'=>'Suisse'))?></a>
<a onclick="getNumber('lu')" href="#number"><?php echo Assets::img('flags/lu.png', array('class'=>'aImg','title'=>'Luxembourg'))?></a>
<a onclick="getNumber('ca')" href="#number"><?php echo Assets::img('flags/ca.png', array('class'=>'aImg','title'=>'Canada'))?></a>
<a onclick="getNumber('de')" href="#number"><?php echo Assets::img('flags/de.png', array('class'=>'aImg','title'=>'Allemagne'))?></a>
<a onclick="getNumber('es')" href="#number"><?php echo Assets::img('flags/es.png', array('class'=>'aImg','title'=>'Espagne'))?></a>
<a onclick="getNumber('gb')" href="#number"><?php echo Assets::img('flags/gb.png', array('class'=>'aImg','title'=>'Royaume-Uni'))?></a>
<a onclick="getNumber('it')" href="#number"><?php echo Assets::img('flags/it.png', array('class'=>'aImg','title'=>'Italie'))?></a>
<a onclick="getNumber('at')" href="#number"><?php echo Assets::img('flags/at.png', array('class'=>'aImg','title'=>'Autriche'))?></a>
<br/>
<style>
    .starpass_telephone, .starpass_cout{
        margin: 2px;
    }
    .starpass_cout{
        font-style: italic;
        color: #1e8a00;
        font-size: 85%;
    }
</style>
<div id="number">
    
</div>
<br /><br />
<form method="post" action="<?php echo Url::genUrl('points/testCode')?>">
    <input class="input" type="text" name="code" placeholder="Entrez le code ici" maxlength="8" />
    <span class="envoyer"><input class="input" type="submit" name="send" value="Envoyer" required/></span>
</form>
</div>
<script type="text/javascript">
    function getNumber(pays){
        $('#number').load(Url.generate('ajax/getPhoneByCountry/' + pays));
    }
</script>
