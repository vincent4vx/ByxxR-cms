<?php $this->title = 'Achat de code'?>
<?php $this->titleImg = 'boutique'?>
<fieldset>
    <legend>Acheter des points</legend>
    <div align="center">
    L'achat de points vous permettra de gagner <b><?php echo Core::conf('points.per_code')?></b> Points.<br />
    Les micropaiements s'effectue par <a href="http://www.starpass.fr/" target="_blank">StarPass™</a>, éditée par <a href="http://www.bdmultimedia.fr/" target="_blank">BD Multimédia</a><br /><br />
    <b>Pour obtenir vos codes d'accès :</b><br /><br />
    Veuillez cliquer sur le drapeau de votre pays<br /><br />
    <a onclick="getNumber('fr')" href="#number"><?php echo Assets::img('flags/fr.png', array('class'=>'flag','title'=>'France'))?></a>
    <a onclick="getNumber('be')" href="#number"><?php echo Assets::img('flags/be.png', array('class'=>'flag','title'=>'Belgique'))?></a>
    <a onclick="getNumber('ch')" href="#number"><?php echo Assets::img('flags/ch.png', array('class'=>'flag','title'=>'Suisse'))?></a>
    <a onclick="getNumber('lu')" href="#number"><?php echo Assets::img('flags/lu.png', array('class'=>'flag','title'=>'Luxembourg'))?></a>
    <a onclick="getNumber('ca')" href="#number"><?php echo Assets::img('flags/ca.png', array('class'=>'flag','title'=>'Canada'))?></a>
    <a onclick="getNumber('de')" href="#number"><?php echo Assets::img('flags/de.png', array('class'=>'flag','title'=>'Allemagne'))?></a>
    <a onclick="getNumber('es')" href="#number"><?php echo Assets::img('flags/es.png', array('class'=>'flag','title'=>'Espagne'))?></a>
    <a onclick="getNumber('gb')" href="#number"><?php echo Assets::img('flags/gb.png', array('class'=>'flag','title'=>'Royaume-Uni'))?></a>
    <a onclick="getNumber('it')" href="#number"><?php echo Assets::img('flags/it.png', array('class'=>'flag','title'=>'Italie'))?></a>
    <a onclick="getNumber('at')" href="#number"><?php echo Assets::img('flags/at.png', array('class'=>'flag','title'=>'Autriche'))?></a>
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
    <div id="number" style="height: 35px;vertical-align: middle;">
    
    </div>
    <br /><br />
    <form method="post" action="<?php echo Url::genUrl('points/testCode')?>">
        <input class="input" type="text" name="code" placeholder="Entrez le code ici" maxlength="8" />
        <span class="envoyer"><input class="input" type="submit" name="send" value="Envoyer" required/></span>
    </form>
    </div>
    <script type="text/javascript">
        function getNumber(pays){
            $('a[href="#number"] img').css('border', 'none');
            $('img[src$="' + pays + '.png"], img[url$="' + pays + '.png"]').css('border', '1px solid #DDD');
            $('#number').html(Assets.img('loading.gif', 'Chargement en cours...'));
            $('#number').load(Url.generate('ajax/getPhoneByCountry/' + pays + '.json'));
        }
        getNumber('fr');
    </script>
</fieldset>
<br/>
<fieldset>
    <legend>Tableau de comptes</legend>
    <?php if($log!==array()):?>
    <table id="points">
        <tr>
            <th>Informations</th><th>Valeur</th><th>Date</th>
        </tr>
        <?php $total = 0?>
        <?php foreach($log as $t):?>
        <tr class="<?php echo $t['type']==='+'?'credit':'debit'?>">
            <td><?php echo $t['info']?></td>
            <td><?php echo $t['value']?></td>
            <td><?php echo date('d / m / Y', $t['time'])?></td>
        </tr>
        <?php $total += ($t['type'] === '+' ? 1 : -1) * $t['value']?>
        <?php endforeach?>
        <tr>
            <td>Total</td><td><font color="<?php echo $total<0?'red':'green'?>"><?php echo $total?></font></td><td><?php echo strftime('%B %G', $mounth)?></td>
        </tr>
    </table>
    <?php else:?>
    <div style="color: red;text-align: center;">Pas encore de transactions enregistré pour <b><?php echo strftime('%B %G', $mounth)?></b>.</div>
    <?php endif?>
</fieldset>
