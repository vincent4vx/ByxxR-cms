<?php

/* ladder/votes.html.twig */
class __TwigTemplate_13084cbc69ad8fceed19c9d4ede41565 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
            '__internal_13084cbc69ad8fceed19c9d4ede41565_1' => array($this, 'block___internal_13084cbc69ad8fceed19c9d4ede41565_1'),
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
        echo $this->env->getExtension('assets')->img("title/img_ladder_vote.png");
        echo "
";
    }

    // line 11
    public function block___internal_13084cbc69ad8fceed19c9d4ede41565_1($context, array $blocks = array())
    {
        // line 12
        echo "            <table style=\"margin: auto;width: 75%;\">
                <tr>
                    <th style=\"width: 8px;\"></th>
                    <th>Pseudo</th>
                    <th>Votes</th>
                </tr>
                ";
        // line 18
        $context["i"] = 1;
        // line 19
        echo "                ";
        if (isset($context["accounts"])) { $_accounts_ = $context["accounts"]; } else { $_accounts_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_accounts_);
        foreach ($context['_seq'] as $context["_key"] => $context["account"]) {
            // line 20
            echo "                    ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            if (($_i_ <= 3)) {
                // line 21
                echo "                    <tr class=\"pos";
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, $_i_, "html", null, true);
                echo "\">
                        <td>";
                // line 22
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo $this->env->getExtension('assets')->img((("trophy/trophy_" . $_i_) . ".png"));
                echo "</td>
                    ";
            } else {
                // line 24
                echo "                    <tr>
                        <td>";
                // line 25
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, $_i_, "html", null, true);
                echo "</td>
                    ";
            }
            // line 27
            echo "                        <td>";
            if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_account_, "pseudo"), "html", null, true);
            echo "</td>
                        <td>";
            // line 28
            if (isset($context["account"])) { $_account_ = $context["account"]; } else { $_account_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_account_, "vote"), "html", null, true);
            echo "</td>
                    </tr>
                    ";
            // line 30
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            $context["i"] = ($_i_ + 1);
            // line 31
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['account'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 32
        echo "            </table>
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
            echo $this->env->getExtension('Cache')->cache((string) $this->renderBlock("__internal_13084cbc69ad8fceed19c9d4ede41565_1", $context, $blocks), $_name_);
            // line 34
            echo "    ";
        } else {
            // line 35
            echo "        ";
            if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
            echo twig_escape_filter($this->env, $_datas_, "html", null, true);
            echo "
    ";
        }
    }

    public function getTemplateName()
    {
        return "ladder/votes.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 35,  123 => 34,  119 => 11,  115 => 10,  111 => 9,  108 => 8,  103 => 32,  97 => 31,  94 => 30,  88 => 28,  82 => 27,  76 => 25,  73 => 24,  67 => 22,  61 => 21,  57 => 20,  51 => 19,  49 => 18,  41 => 12,  38 => 11,  31 => 6,  28 => 5,);
    }
}
