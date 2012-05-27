<?php

/* account/account.html.twig */
class __TwigTemplate_e530eddd94aa3ccd33b505d54c06d639 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
            '__internal_e530eddd94aa3ccd33b505d54c06d639_1' => array($this, 'block___internal_e530eddd94aa3ccd33b505d54c06d639_1'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title_img($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        echo $this->env->getExtension('assets')->img("title/img_profil.png");
        echo "
";
    }

    // line 10
    public function block___internal_e530eddd94aa3ccd33b505d54c06d639_1($context, array $blocks = array())
    {
        // line 11
        echo "        <fieldset>
            <legend>Mes informations</legend>
            <table style=\"width: 100%;\">
                <tr>
                    <td>Nom de Compte : </td>
                    <td colspan=\"2\">";
        // line 16
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_session_, "getAccount", array(), "method"), "html", null, true);
        echo "</td>
                    <td>";
        // line 17
        echo $this->env->getExtension('assets')->img("devtool/delete.png");
        echo "</td>
                </tr>
                <tr>
                    <td style=\"text-align: center;\"><b>";
        // line 20
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_session_, "getPseudo"), "html", null, true);
        echo "</b></td>
                    <td colspan=\"2\">Rang : <b>";
        // line 21
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, ((($this->getAttribute($_session_, "getLevel") > 0)) ? ($this->getAttribute($this->getAttribute($this->getAttribute($_config_, "admin"), "rank"), $this->getAttribute($_session_, "getLevel"), array(), "array")) : ("Joueur")), "html", null, true);
        echo "</b></td>
                    <td>";
        // line 22
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/help.png"), "home", "staff");
        echo "</td>
                </tr>
                <tr>
                    <td rowspan=\"4\">";
        // line 25
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img(("avatars/" . $this->getAttribute($_account_, "avatar"))), "account", "changeimg#changeimg");
        echo "</td>
                    <td>Mot de passe : </td>
                    <td>******</td>
                    <td>";
        // line 28
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/edit.png"), "account", "changepass#changepass");
        echo "</td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td>";
        // line 32
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_account_, "email"), "html", null, true);
        echo "</td>
                    <td>";
        // line 33
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/edit.png"), "account", "changemail#changemail");
        echo "</td>
                </tr>
                <tr>
                    <td>Question : </td>
                    <td>";
        // line 37
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_account_, "question"), "html", null, true);
        echo "</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=\"2\" style=\"vertical-align: top;width: 270px;\">
                        <b><u><font color=\"red\">Informations :</font><br/></u></b>
                        <div style=\"width: 255px;\">";
        // line 43
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_account_, "infos"), "html", null, true);
        echo "</div>
                    </td>
                    <td>";
        // line 45
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/edit.png"), "account", "changeinfo#infos");
        echo "</td>
                </tr>
            </table>
        </fieldset>
        ";
    }

    // line 8
    public function block_page($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if (isset($context["cacheData"])) { $_cacheData_ = $context["cacheData"]; } else { $_cacheData_ = null; }
        if ((!$_cacheData_)) {
            // line 10
            echo "        ";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo cache::save((string) $this->renderBlock("__internal_e530eddd94aa3ccd33b505d54c06d639_1", $context, $blocks), $_name_);
            // line 50
            echo "    ";
        } else {
            // line 51
            echo "        ";
            if (isset($context["cacheData"])) { $_cacheData_ = $context["cacheData"]; } else { $_cacheData_ = null; }
            echo $_cacheData_;
            echo "
    ";
        }
        // line 53
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        if ((!twig_test_empty($_param_))) {
            // line 54
            echo "    <br/>
    ";
            // line 55
            if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
            $template = $this->env->resolveTemplate((("account/" . $_param_) . ".html.twig"));
            $template->display($context);
        }
    }

    public function getTemplateName()
    {
        return "account/account.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 55,  151 => 54,  148 => 53,  141 => 51,  138 => 50,  134 => 10,  130 => 9,  127 => 8,  118 => 45,  112 => 43,  102 => 37,  95 => 33,  90 => 32,  83 => 28,  76 => 25,  70 => 22,  64 => 21,  59 => 20,  53 => 17,  48 => 16,  41 => 11,  38 => 10,  31 => 6,  28 => 5,);
    }
}
