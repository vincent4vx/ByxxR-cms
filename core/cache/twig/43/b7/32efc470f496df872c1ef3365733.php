<?php

/* home/staff.html.twig */
class __TwigTemplate_43b732efc470f496df872c1ef3365733 extends Twig_Template
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
        echo $this->env->getExtension('assets')->img("title/img_equipe.png");
        echo "
";
    }

    // line 8
    public function block_page($context, array $blocks = array())
    {
        // line 9
        echo "    <table>
        ";
        // line 10
        if (isset($context["staff"])) { $_staff_ = $context["staff"]; } else { $_staff_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_staff_);
        foreach ($context['_seq'] as $context["_key"] => $context["account"]) {
            // line 11
            echo "            <tr>
                <td style=\"text-align: center;\"><b>";
            // line 12
            if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_account_, "pseudo"), "html", null, true);
            echo "</b><br/>";
            if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
            echo $this->env->getExtension('assets')->img(("avatars/" . $this->getAttribute($_account_, "avatar")));
            echo "</td>
                <td>
                    <table style=\"padding: 0px;\">
                        <tr>
                            <td>Rang : <b>";
            // line 16
            if (isset($context["config"])) { $_config_ = $context["config"]; } else { $_config_ = null; }
            if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_config_, "admin"), "rank"), $this->getAttribute($_account_, "level"), array(), "array"), "html", null, true);
            echo "</b></td>
                        </tr>
                        <tr>
                            <td><b><u><font color=\"red\">Informations :</font></u></b><br/>";
            // line 19
            if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
            echo twig_escape_filter($this->env, (((!twig_test_empty($this->getAttribute($_account_, "infos")))) ? ($this->getAttribute($_account_, "infos")) : ("Aucunes informations disponibles...")), "html", null, true);
            echo "</td>
                        </tr>
                    </table>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['account'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 25
        echo "    </table>
";
    }

    public function getTemplateName()
    {
        return "home/staff.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 25,  70 => 19,  62 => 16,  51 => 12,  48 => 11,  43 => 10,  40 => 9,  37 => 8,  30 => 6,  27 => 5,);
    }
}
