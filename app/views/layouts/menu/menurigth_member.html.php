<div class="titleMenuRight">{{ img("devtool/user.png", "devtoolIcon") }} Mon compte</div>
<a href="{{ url("account") }}"><li>{{ img("devtool/zoom.png", "devtoolIcon") }} Mon Profil</li></a>
<!--{# <a href=""><li>{{ img("devtool/cadeau.png", "devtoolIcon") }} Mes Points (<b><small>125</small></b>)</li></a> #}-->
<a href="{{ url("characters", "persos") }}"><li>{{ img("devtool/bug.png", "devtoolIcon") }} Mes Personnages</li></a>
<!--{# <a href=""><li>{{ img("devtool/construction.png", "devtoolIcon") }} Déblocage</li></a>
<a href=""><li>{{ img("devtool/cart.png", "devtoolIcon") }} Boutique</li></a> #}-->
<a href="{{ url("account", "logout") }}"><li style="margin-bottom:10px;border-bottom: 1px solid #989898;"><?php echo $this->assets->img("devtool/close.png", "devtoolIcon") ?> Déconnexion</li></a>
