<div id="menuLeft">
    <div class="titleMenuLeft"><?php echo I18n::tr('server', 'layout')?></div>
    <ul>
        <li><a href="<?php echo Url::genUrl()?>"><?php echo I18n::tr('home', 'layout')?></a></li>
        <li><a href="<?php echo Url::genUrl('home', 'infos')?>"><?php echo I18n::tr('presentation', 'layout')?></a></li>
        <li><a href="<?php echo Url::genUrl('home', 'staff')?>"><?php echo I18n::tr('staff', 'layout')?></a></li>
        <li><a href="<?php echo Url::genUrl('points', 'vote')?>"><b><?php echo I18n::tr('vote', 'layout')?></b></a></li>
        <li><a href="<?php echo Url::genUrl('home', 'cgu')?>"><?php echo I18n::tr('rules', 'layout')?></a></li>
    </ul>
    <br/>
    <div class="titleMenuLeft"><?php echo I18n::tr('community', 'layout')?></div>
    <ul>
        <li><a href="<?php echo Url::genUrl('home', 'join')?>"><?php echo I18n::tr('join', 'layout')?></a></li>
        <?php if(!$this->session->isLog()):?>
        <li><a href="<?php echo Url::genUrl("user", "register")?>"><?php echo I18n::tr('register', 'layout')?></a></li>
        <?php endif?>
        <li><a target="_blank" href="<?php echo Url::forum()?>"><?php echo I18n::tr('forum', 'layout')?></a></li>
        <li><a href="<?php echo Url::genUrl("ladder")?>">Classement</a></li>
        <li><a href="<?php echo Url::genUrl("ladder", "votes")?>">Top Votes</a></li>
        <li><a href="<?php echo Url::genUrl("ladder", "guilds")?>">Top Guildes</a></li>
    </ul>
    <br/>
                <!--{# {% if session.isLog() %}
                <div class="titleMenuLeft">Interative</div>
                    <a href="'.$lien_perso.'"><li>Personnages</li></a>
                    <a href="'.$lien_change_name.'"><li style="border-bottom: 1px solid #989898;">Changer de nom</li></a>
                {% endif %} #}-->
</div>
