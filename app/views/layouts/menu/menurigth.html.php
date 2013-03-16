<div id="menuRight">
    <div id="bgRight">
        <div id="menuRightLien">
            <?php
            if(!$this->session->isLog())
                include './menurigth_guess.html.php';
            else{
                include './menurigth_member.html.php';
                if($this->session->isAdmin())
                    include './menurigth_admin.html.php';
            }
            ?>
        </div>
    </div><?php echo $this->assets->img("bottomRight.png", "bgRight")?>
</div>
