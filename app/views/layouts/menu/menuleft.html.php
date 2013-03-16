<div id="menuLeft">
    <div class="titleMenuLeft"><?php echo Core::tr('layout', 'server')?></div>
    <ul>
        <li><a href="<?php echo $this->url->genUrl()?>"><?php echo Core::tr('layout', 'home')?></a></li>
        <li><a href="<?php echo $this->url->genUrl('home', 'infos')?>"><?php echo Core::tr('layout', 'presentation')?></a></li>
        <li><a href="<?php echo $this->url->genUrl('home', 'staff')?>"><?php echo Core::tr('layout', 'staff')?></a></li>
        <li><a href="<?php echo $this->url->genUrl('points', 'vote')?>" target="_blank"><b><?php echo Core::tr('layout', 'vote')?></b></a></li>
        <li style="border-bottom: 1px solid #989898;"><a href="<?php echo $this->url->genUrl('home', 'cgu')?>"><?php echo Core::tr('layout', 'rules')?></a></li>
    </ul>
    <br/>
    <div class="titleMenuLeft"><?php echo Core::tr('layout', 'community')?></div>
    <ul>
        <li><a href="<?php echo $this->url->genUrl('home', 'join')?>"><?php echo Core::tr('layout', 'join')?></a></li>
        <?php if(!$this->session->isLog()):?>
        <li><a href="<?php echo $this->url->genUrl("account", "register")?>"><?php echo Core::tr('layout', 'register')?></a></li>
        <?php endif?>
        <li><a target="_blank" href="<?php echo Core::$config['server']['forum']?>"><?php echo Core::tr('layout', 'forum')?></a></li>
        <li><a href="<?php echo $this->url->genUrl("ladder")?>"><?php echo Core::tr('layout', 'ladder')?></a></li>
        <li><a href="<?php echo $this->url->genUrl("ladder", "votes")?>"><?php echo Core::tr('layout', 'votes-ladder')?></a></li>
        <li style="border-bottom: 1px solid #989898;"><a href="<?php echo $this->url->genUrl("ladder", "guilds")?>"><?php echo Core::tr('layout', 'guilds-ladder')?></a></li>
    </ul>
    <br/>
                <!--{# {% if session.isLog() %}
                <div class="titleMenuLeft">Interative</div>
                    <a href="'.$lien_perso.'"><li>Personnages</li></a>
                    <a href="'.$lien_change_name.'"><li style="border-bottom: 1px solid #989898;">Changer de nom</li></a>
                {% endif %} #}-->
</div>
