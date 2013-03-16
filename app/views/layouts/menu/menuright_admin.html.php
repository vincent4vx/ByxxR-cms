<div style="margin-top: 10px;"class="titleMenuRight_ad">Administration</div>
<a href="{{ url("admin", "news") }}"><li>Gérez les news</li></a>
<a href="{{ url("admin", "accounts") }}"><li>Gérez les comptes</li></a>
<?php if($this->session->superAdmin()):?>
<a href="{{ url("admin", "staff") }}"><li>Gérez l'équipe</li></a>
<?php endif?>
{{ link('<li style="margin-bottom:10px;border-bottom: 1px solid #989898;">Vider le cache</li>', "admin", "emptycache") }}
<!--{# <a href=""><li style="margin-bottom:10px;border-bottom: 1px solid #989898;">Gérez la boutique</li></a> #}-->
