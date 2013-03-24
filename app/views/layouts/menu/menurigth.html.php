<div id="menuRight">
    <div id="bgRight">
        <div id="menuRightLien">
            <?php
            if(!$this->session->isLog())
                include __DIR__.'/menurigth_guess.html.php';
            else{
                include __DIR__.'/menurigth_member.html.php';
                if($this->session->isAdmin())
                    include __DIR__.'/menuright_admin.html.php';
            }
            ?>
        </div>
    </div><?php echo Assets::img("bottomRight.png", "bgRight")?>
</div>
