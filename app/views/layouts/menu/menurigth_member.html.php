<div class="titleMenuRight">
    <?php echo Assets::img("devtool/user.png")?> Mon compte
</div>
<ul>
<li><a href="<?php echo Url::genUrl('user')?>"><?php echo Assets::img("devtool/zoom.png")?> Mon Profil</a></li>
<!--{# <a href=""><li>{{ img("devtool/cadeau.png", "devtoolIcon") }} Mes Points (<b><small>125</small></b>)</li></a> #}-->
<!--<li><a href=""><?php echo Assets::img("devtool/bug.png")?> Mes Personnages</a></li>-->
<!--{# <a href=""><li>{{ img("devtool/construction.png", "devtoolIcon") }} Déblocage</li></a>
<a href=""><li>{{ img("devtool/cart.png", "devtoolIcon") }} Boutique</li></a> #}-->
<li><a href="<?php echo Url::genUrl('user/logout')?>"><?php echo Assets::img("devtool/close.png") ?> Déconnexion</a></li>
</ul>
