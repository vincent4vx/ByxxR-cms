<div class="titleMenuRight">
    <?php echo Assets::img("devtool/user.png")?> Mon compte
</div>
<ul>
<li><a href="<?php echo Url::genUrl('user')?>"><?php echo Assets::img("devtool/zoom.png")?> Mon Profil</a></li>
<li><a href="<?php echo Url::genUrl('points/buyPoints')?>"><?php echo Assets::img("devtool/cadeau.png")?> Mes Points (<span style="font-weight: bold;font-size: <?php $s=1-(strlen($this->session->points)-2)/10;echo $s>1?1:$s;?>em;"><?php echo $this->session->points?></span>)</a></li>
<!--<li><a href=""><?php echo Assets::img("devtool/bug.png")?> Mes Personnages</a></li>-->
<!--{# <a href=""><li>{{ img("devtool/construction.png", "devtoolIcon") }} Déblocage</li></a>
<a href=""><li>{{ img("devtool/cart.png", "devtoolIcon") }} Boutique</li></a> #}-->
<li><a href="<?php echo Url::genUrl('user/logout')?>"><?php echo Assets::img("devtool/close.png") ?> Déconnexion</a></li>
</ul>
