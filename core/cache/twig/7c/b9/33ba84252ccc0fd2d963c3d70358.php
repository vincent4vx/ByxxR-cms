<?php

/* layout.html.twig */
class __TwigTemplate_7cb933ba84252ccc0fd2d963c3d70358 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" >
    <head>
        <title>";
        // line 5
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_config_, "server"), "name"), "html", null, true);
        echo "</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        ";
        // line 7
        echo $this->env->getExtension('assets')->css("style");
        echo "
    </head> 
    <body>
        <span style=\"position:absolute;margin-top:161px;margin-left:190px;color:#ffffff;text-shadow:0em 0em 0.2em #000000;font-family:Vivaldi;font-size:35px;\">";
        // line 10
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_config_, "server"), "name"), "html", null, true);
        echo "</span>
        <div id=header style=\"background-image: url('";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->img_url("header/bgHead_1.png"), "html", null, true);
        echo "');\">
            <div id=\"memberSpaceH\">
                ";
        // line 13
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if (($this->getAttribute($_session_, "isLog", array(), "method") === false)) {
            // line 14
            echo "                    <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "login"), "html", null, true);
            echo "\" method=\"post\">
                        <input name=\"login\" class=\"input\" type=\"text\" placeholder=\"Login\" />
                        <input name=\"passlog\" class=\"input\" type=\"password\" placeholder=\"password\" />
                        <input name=\"logon\" class=\"input\" type=\"submit\" value=\"Connexion au site\"/>
                    </form>
                ";
        } else {
            // line 20
            echo "                    Bienvenue <b>";
            if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_session_, "getPseudo", array(), "method"), "html", null, true);
            echo "</b> ! ";
            echo $this->env->getExtension('url')->link("profil", "account");
            echo " - ";
            echo $this->env->getExtension('url')->link("se déconnecter", "account", "logout");
            echo " 
                ";
        }
        // line 22
        echo "            </div>
        </div>
        <div id=\"bg\">
            <div id=menuLeft>
                <div class=\"titleMenuLeft\">Le Serveur</div>
                    <a href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url(), "html", null, true);
        echo "\"><li>Accueil</li></a>
                    <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("home", "infos"), "html", null, true);
        echo "\"><li>Présentation</li></a>
                    <a href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("home", "staff"), "html", null, true);
        echo "\"><li>L'équipe</li></a>
                    <a href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "vote"), "html", null, true);
        echo "\"><li><b>Vote & Gagne</b></li></a>
                    <a href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("home", "cgu"), "html", null, true);
        echo "\"><li style=\"border-bottom: 1px solid #989898;\">Règlement</li></a>
                <br/>
                <div class=\"titleMenuLeft\">La Communauté</div>
                    <a href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("home", "join"), "html", null, true);
        echo "\"><li>Nous Rejoindre</li></a>
                    ";
        // line 35
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if ((!$this->getAttribute($_session_, "isLog", array(), "method"))) {
            // line 36
            echo "                    <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "register"), "html", null, true);
            echo "\"><li>Inscription</li></a>
                    ";
        }
        // line 38
        echo "                    <a target=\"_blank\" href=\"";
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_config_, "server"), "forum"), "html", null, true);
        echo "\"><li>Forum</li></a>
                    <a href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("ladder"), "html", null, true);
        echo "\"><li>Ladder</li></a>
                    <a href=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("ladder", "votes"), "html", null, true);
        echo "\"><li>Ladder des votes</li></a>
                    <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("ladder", "guilds"), "html", null, true);
        echo "\"><li style=\"border-bottom: 1px solid #989898;\">Ladder des guildes</li></a>
                <br/>
                ";
        // line 43
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if ($this->getAttribute($_session_, "isLog", array(), "method")) {
            // line 44
            echo "                <div class=\"titleMenuLeft\">Interative</div>
                    <a href=\"'.\$lien_perso.'\"><li>Personnages</li></a>
                    <a href=\"'.\$lien_change_name.'\"><li style=\"border-bottom: 1px solid #989898;\">Changer de nom</li></a>
                ";
        }
        // line 48
        echo "            </div>
            <div id=menuRight>
                <div id=\"bgRight\">
                    <div id=\"menuRightLien\">
                        ";
        // line 52
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if ($this->getAttribute($_session_, "isLog", array(), "method")) {
            // line 53
            echo "                        <div class=\"titleMenuRight\">";
            echo $this->env->getExtension('assets')->img("devtool/user.png", "devtoolIcon");
            echo " Mon compte</div>
                            <a href=\"";
            // line 54
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account"), "html", null, true);
            echo "\"><li>";
            echo $this->env->getExtension('assets')->img("devtool/zoom.png", "devtoolIcon");
            echo " Mon Profil</li></a>
                            <a href=\"\"><li>";
            // line 55
            echo $this->env->getExtension('assets')->img("devtool/cadeau.png", "devtoolIcon");
            echo " Mes Points (<b><small>125</small></b>)</li></a>
                            <a href=\"";
            // line 56
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "persos"), "html", null, true);
            echo "\"><li>";
            echo $this->env->getExtension('assets')->img("devtool/bug.png", "devtoolIcon");
            echo " Mes Personnages</li></a>
                            <a href=\"\"><li>";
            // line 57
            echo $this->env->getExtension('assets')->img("devtool/construction.png", "devtoolIcon");
            echo " Déblocage</li></a>
                            <a href=\"\"><li>";
            // line 58
            echo $this->env->getExtension('assets')->img("devtool/cart.png", "devtoolIcon");
            echo " Boutique</li></a>
                            <a href=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "logout"), "html", null, true);
            echo "\"><li style=\"margin-bottom:10px;border-bottom: 1px solid #989898;\">";
            echo $this->env->getExtension('assets')->img("devtool/close.png", "devtoolIcon");
            echo " Déconnexion</li></a>
                        ";
        }
        // line 61
        echo "                        ";
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if ($this->getAttribute($_session_, "isAdmin", array(), "method")) {
            // line 62
            echo "                        <div style=\"margin-top: 10px;\"class=\"titleMenuRight_ad\">Administration</div>
                            <a href=\"";
            // line 63
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("admin", "news"), "html", null, true);
            echo "\"><li>Gérez les news</li></a>
                            <a href=\"";
            // line 64
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("admin", "accounts"), "html", null, true);
            echo "\"><li>Gérez les comptes</li></a>
                            ";
            // line 65
            if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
            if ($this->getAttribute($_session_, "superAdmin", array(), "method")) {
                // line 66
                echo "                                <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("admin", "staff"), "html", null, true);
                echo "\"><li>Gérez l'équipe</li></a>
                            ";
            }
            // line 68
            echo "                            <a href=\"\"><li style=\"margin-bottom:10px;border-bottom: 1px solid #989898;\">Gérez la boutique</li></a>
                        ";
        }
        // line 70
        echo "                        ";
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if ((!$this->getAttribute($_session_, "isLog", array(), "method"))) {
            // line 71
            echo "\t\t\t<div class=\"titleMenuRight\">Pas encore inscris ?</div>
                            <center><a href=\"";
            // line 72
            echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "register"), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('assets')->img("imgInscription.png");
            echo "</a></center>
                        ";
        }
        // line 74
        echo "                    </div>
                    ";
        // line 75
        echo $this->env->getExtension('assets')->img("bottomRight.png", "bgRight");
        echo "
                </div>
            </div>
                <div id=\"Content\">
                    ";
        // line 79
        echo $this->env->getExtension('assets')->img("topContent.png");
        echo "
                    <div id=\"bgContent\">
                        <div id=\"textContent\">
                            <div id=\"cadre\" style=\"background-image:url('";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->img_url("cadres/backCadre_1.png"), "html", null, true);
        echo "')\">
\t\t\t\t<div style=\"position:absolute;margin-top:9px;\">Serveur :  
                                    <span style=\"color:#11ff00\">OnLine</span>
\t\t\t\t</div>
\t\t\t\t<div style=\"position:absolute;margin-top:30px;\">Base de données :  
                                    <span style=\"color:#11ff00\">OnLine</span>
\t\t\t\t</div>
\t\t\t\t<div style=\"position:absolute;margin-top:52px;\">Comptes :  
                                    <b>155</b>
\t\t\t\t</div>
\t\t\t\t<div style=\"position:absolute;margin-top:73px;\">Personnages :  
\t\t\t\t <b>1547</b>
\t\t\t\t</div>
\t\t\t\t<div style=\"position:absolute;margin-top:94px;\">Guildes : 
                                    <b>10</b>
\t\t\t\t</div>
\t\t\t\t<div style=\"position:absolute;margin-top:115px;\">Connectés : 
                                    <b>5</b>
\t\t\t\t</div>
                            </div>
                        </div>
                    </div>
                    ";
        // line 104
        echo $this->env->getExtension('assets')->img("bottomContent.png");
        echo "
                    <center>";
        // line 105
        $this->displayBlock('title_img', $context, $blocks);
        echo "</center>
                    ";
        // line 106
        echo $this->env->getExtension('assets')->img("topContent.png");
        echo "
                    <div id=\"bgContent\">
\t\t\t<div id=\"textContent\">
                            ";
        // line 109
        $this->displayBlock('page', $context, $blocks);
        // line 111
        echo "\t\t\t</div>
                    </div>
                    ";
        // line 113
        echo $this->env->getExtension('assets')->img("bottomContent.png");
        echo "
                </div>
                <div id=\"footer\">
                    <div class=\"rightFooter\">
                        <b>";
        // line 117
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_config_, "server"), "name"), "html", null, true);
        echo "</b> © 2012 - All rights reserved / Tout droits réservés.<br />
                        <b>ByxxR v";
        // line 118
        echo twig_escape_filter($this->env, constant("VERSION"), "html", null, true);
        echo "</b> © 2012 - Css and Design by <b>Nicow</b> & <b>v4vx</b> - Php and Code by <b>v4vx</b>.<br /><br />

                        Toutes les images de se site sont la propriétés mêmes de <b>Ankamas Games</b> & <b>ByxxR CMS</b>.<br />
                        <b>";
        // line 121
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_config_, "server"), "name"), "html", null, true);
        echo "</b> n'est en aucun cas un site lié avec <b>Ankama Games</b>.<br />
                        <b>Dofus</b> est un jeu et une marque déposé par <b>Ankamas Games</b>.
                    </div>
                </div>
    </body>
</html>

";
    }

    // line 105
    public function block_title_img($context, array $blocks = array())
    {
    }

    // line 109
    public function block_page($context, array $blocks = array())
    {
        // line 110
        echo "                            ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  327 => 110,  324 => 109,  319 => 105,  306 => 121,  300 => 118,  295 => 117,  288 => 113,  284 => 111,  282 => 109,  276 => 106,  272 => 105,  268 => 104,  243 => 82,  237 => 79,  230 => 75,  227 => 74,  220 => 72,  217 => 71,  213 => 70,  209 => 68,  203 => 66,  200 => 65,  196 => 64,  192 => 63,  189 => 62,  185 => 61,  178 => 59,  174 => 58,  170 => 57,  164 => 56,  160 => 55,  154 => 54,  149 => 53,  146 => 52,  140 => 48,  134 => 44,  131 => 43,  126 => 41,  122 => 40,  118 => 39,  112 => 38,  106 => 36,  103 => 35,  99 => 34,  93 => 31,  89 => 30,  85 => 29,  81 => 28,  77 => 27,  49 => 14,  46 => 13,  36 => 10,  30 => 7,  24 => 5,  19 => 2,  161 => 56,  158 => 55,  155 => 54,  148 => 52,  145 => 51,  141 => 11,  137 => 10,  133 => 9,  130 => 8,  121 => 46,  115 => 44,  107 => 39,  102 => 38,  95 => 34,  90 => 33,  83 => 29,  76 => 26,  70 => 22,  64 => 22,  59 => 20,  53 => 18,  48 => 17,  41 => 11,  38 => 11,  31 => 6,  28 => 5,);
    }
}
