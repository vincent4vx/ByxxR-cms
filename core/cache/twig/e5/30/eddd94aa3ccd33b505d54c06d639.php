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

    // line 11
    public function block___internal_e530eddd94aa3ccd33b505d54c06d639_1($context, array $blocks = array())
    {
        // line 12
        echo "        <fieldset>
            <legend>Mes informations</legend>
            <table style=\"width: 100%;\">
                <tr>
                    <td>Nom de Compte : </td>
                    <td colspan=\"2\">";
        // line 17
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_session_, "getAccount", array(), "method"), "html", null, true);
        echo "</td>
                    <td>";
        // line 18
        echo $this->env->getExtension('assets')->img("devtool/delete.png");
        echo "</td>
                </tr>
                <tr>
                    <td style=\"text-align: center;\"><b>";
        // line 21
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_session_, "getPseudo"), "html", null, true);
        echo "</b></td>
                    <td colspan=\"2\">Rang : <b>";
        // line 22
        if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, ((($this->getAttribute($_session_, "getLevel") > 0)) ? ($this->getAttribute($this->getAttribute($this->getAttribute($_config_, "admin"), "rank"), $this->getAttribute($_session_, "getLevel"), array(), "array")) : ("Joueur")), "html", null, true);
        echo "</b></td>
                    <td>";
        // line 23
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/help.png"), "home", "staff");
        echo "</td>
                </tr>
                <tr>
                    <td rowspan=\"4\">";
        // line 26
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img(("avatars/" . $this->getAttribute($_account_, "avatar"))), "account", "changeimg");
        echo "</td>
                    <td>Mot de passe : </td>
                    <td>******</td>
                    <td>";
        // line 29
        echo $this->env->getExtension('assets')->img("devtool/edit.png");
        echo "</td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td>";
        // line 33
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_account_, "email"), "html", null, true);
        echo "</td>
                    <td>";
        // line 34
        echo $this->env->getExtension('assets')->img("devtool/edit.png");
        echo "</td>
                </tr>
                <tr>
                    <td>Question : </td>
                    <td>rrgrgeg</td>
                    <td>";
        // line 39
        echo $this->env->getExtension('assets')->img("devtool/edit.png");
        echo "</td>
                </tr>
                <tr>
                    <td colspan=\"2\" style=\"vertical-align: top;width: 270px;\">
                        <b><u><font color=\"red\">Informations :</font><br/></u></b>
                        <div style=\"width: 255px;\">";
        // line 44
        if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_account_, "infos"), "html", null, true);
        echo "</div>
                    </td>
                    <td>";
        // line 46
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
        if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
        $context["datas"] = $this->env->getExtension('Cache')->getCache($_name_);
        // line 10
        echo "    ";
        if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
        if (($_datas_ == false)) {
            // line 11
            echo "        ";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo $this->env->getExtension('Cache')->cache((string) $this->renderBlock("__internal_e530eddd94aa3ccd33b505d54c06d639_1", $context, $blocks), $_name_);
            // line 51
            echo "    ";
        } else {
            // line 52
            echo "        ";
            if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
            echo twig_escape_filter($this->env, $_datas_, "html", null, true);
            echo "
    ";
        }
        // line 54
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        if ((!twig_test_empty($_param_))) {
            // line 55
            echo "    <br/>
    ";
            // line 56
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
        return array (  157 => 56,  154 => 55,  151 => 54,  144 => 52,  141 => 51,  137 => 11,  133 => 10,  129 => 9,  126 => 8,  117 => 46,  111 => 44,  103 => 39,  95 => 34,  90 => 33,  83 => 29,  76 => 26,  70 => 23,  64 => 22,  59 => 21,  53 => 18,  48 => 17,  41 => 12,  38 => 11,  31 => 6,  28 => 5,);
    }
}
