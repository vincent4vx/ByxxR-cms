<?php

/* account/register.html.twig */
class __TwigTemplate_d0211f7851091c5ff2106c92d79e3736 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
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
        echo $this->env->getExtension('assets')->img("title/img_inscription.png");
        echo "
";
    }

    // line 8
    public function block_page($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
        if ($_error_) {
            // line 10
            echo "        <div class=\"verifNO\">
            <h3>";
            // line 11
            echo $this->env->getExtension('assets')->img("devtool/error.png", "devtollIcon");
            echo "Erreur lors de l'inscription</h3>
            Les champs suivants sont incorrects, veuillez les corriger.<br/>
            <ul>
                ";
            // line 14
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter($_errors_));
            foreach ($context['_seq'] as $context["_key"] => $context["champ"]) {
                // line 15
                echo "                    <li><b>";
                if (isset($context["champ"])) { $_champ_ = $context["champ"]; } else { $_champ_ = null; }
                echo twig_escape_filter($this->env, $_champ_, "html", null, true);
                echo ": </b>";
                if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
                if (isset($context["champ"])) { $_champ_ = $context["champ"]; } else { $_champ_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_errors_, $_champ_, array(), "array"), "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['champ'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 17
            echo "            </ul>
        </div>
        <br/><br/>
    ";
        }
        // line 21
        echo "    <table style=\"margin:auto;\">
        <form method=\"post\" action=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("account", "register"), "html", null, true);
        echo "?finish=1\">
            <tr>
                <td> Nom de Compte :</td>
                <td><input class=\"input";
        // line 25
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        echo (($this->getAttribute($_errors_, "Nom de Compte", array(), "array", true, true)) ? ("Error") : (""));
        echo "\" name=\"name\" type=\"text\" value=\"";
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "name"), "html", null, true);
        echo "\"></td>
            </tr>
            <tr>
                <td> Mot de passe :</td>
                <td><input class=\"input";
        // line 29
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        echo (($this->getAttribute($_errors_, "Mot de passe", array(), "array", true, true)) ? ("Error") : (""));
        echo "\" name=\"pass\" type=\"password\" value=\"";
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "pass"), "html", null, true);
        echo "\"></td>
            </tr>
            <tr>
                <td>Confirmez le mot de passe :</td>
                <td><input class=\"input";
        // line 33
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        echo (($this->getAttribute($_errors_, "Confirmez le mot de passe", array(), "array", true, true)) ? ("Error") : (""));
        echo "\" name=\"pass2\" type=\"password\" value=\"";
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "pass2"), "html", null, true);
        echo "\"></td>
            </tr>
            <tr>
                <td>Votre Pseudo :</td>
                <td><input class=\"input";
        // line 37
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        echo (($this->getAttribute($_errors_, "Pseudo", array(), "array", true, true)) ? ("Error") : (""));
        echo "\" name=\"pseudo\" type=\"text\" value=\"";
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "pseudo"), "html", null, true);
        echo "\"></td>
            </tr>
            <tr>
                <td>Votre Email :</td>
                <td><input class=\"input";
        // line 41
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        echo (($this->getAttribute($_errors_, "email", array(), "array", true, true)) ? ("Error") : (""));
        echo "\" name=\"mail\" type=\"text\" value=\"";
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "mail"), "html", null, true);
        echo "\"></td>
            </tr>
            <tr>
                <td>Question Secrète :</td>
                <td><input class=\"input\" name=\"secretquestion\" type=\"text\" value=\"";
        // line 45
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "secretquestion"), "html", null, true);
        echo "\"></td>
            </tr>
            <tr>
                <td>Réponse Secrète :</td>
                <td><input class=\"input\" name=\"secretanswer\" type=\"text\" value=\"";
        // line 49
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "secretanswer"), "html", null, true);
        echo "\"> </td>
            </tr>
            <tr>
                <td>Valider</td>
                <td><input class=\"input\" name=\"ok\" value=\"S'inscrire\" type=\"submit\"></td>
            </tr>
        </form>
    </table>
    <br/>
    <span style=\"color:red\"><center>En vous inscrivant sur nos serveurs vous prenez donc en compte le <b><a style=\"color:red\" href=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("home", "cgu"), "html", null, true);
        echo "\">réglement</a></span></b> déposé par ";
        if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_config_, "server"), "name"), "html", null, true);
        echo " !</center></span>
";
    }

    public function getTemplateName()
    {
        return "account/register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 58,  150 => 49,  142 => 45,  131 => 41,  120 => 37,  109 => 33,  98 => 29,  87 => 25,  81 => 22,  78 => 21,  72 => 17,  58 => 15,  53 => 14,  47 => 11,  44 => 10,  40 => 9,  37 => 8,  30 => 6,  27 => 5,);
    }
}
