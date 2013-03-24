<div style="margin-top: 10px;"class="titleMenuRight_ad">Administration</div>
<li><a href="">Gérez les news</a></li>
<li><a href="">Gérez les comptes</a></li>
<?php if($this->session->superAdmin()):?>
    <li><a href="">Gérez l'équipe</a></li>
<?php endif?>
<li style="border-bottom: 1px solid #989898;"><a href="">Vider le cache</a></li>
<!--{# <a href=""><li style="margin-bottom:10px;border-bottom: 1px solid #989898;">Gérez la boutique</li></a> #}-->
