<div style="margin-top: 10px;"class="titleMenuRight_ad">Administration</div>
<ul>
<?php if($this->session->handle_news):?>
    <li><a href="<?php echo Url::genUrl('admin/news')?>">Gérez les news</a></li>
<?php endif?>
<li><a href="">Gérez les comptes</a></li>
<?php if($this->session->superAdmin()):?>
    <li><a href="">Gérez l'équipe</a></li>
<?php endif?>
<li><a href="">Vider le cache</a></li>
<!--{# <a href=""><li style="margin-bottom:10px;border-bottom: 1px solid #989898;">Gérez la boutique</li></a> #}-->
</ul>
