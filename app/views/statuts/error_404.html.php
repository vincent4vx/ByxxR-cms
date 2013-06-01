<?php $this->title='Erreur 404'?>
<?php $this->titleImg='404'?>
<div class="verifNO">
    <h3><?php echo Assets::img("devtool/error.png")?>Erreur 404</h3>
    <p>
        La page que vous demandé n'existe pas, ou est en construction.<br/>
        Vous allez être redirigé vers la page d'accueil.
    </p>
    <hr/>
    <?php Url::redirect('', 5)?>
    <a href="<?php echo Url::genUrl()?>">Ne pas patienter...</a>
</div>

