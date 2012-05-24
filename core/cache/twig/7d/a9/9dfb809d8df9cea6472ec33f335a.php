<?php

/* ladder/guilds.html.twig */
class __TwigTemplate_7da99dfb809d8df9cea6472ec33f335a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
            '__internal_7da99dfb809d8df9cea6472ec33f335a_1' => array($this, 'block___internal_7da99dfb809d8df9cea6472ec33f335a_1'),
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

    // line 4
    public function block_title_img($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        echo $this->env->getExtension('assets')->img("title/img_ladder_guilde.png");
        echo "
";
    }

    // line 10
    public function block___internal_7da99dfb809d8df9cea6472ec33f335a_1($context, array $blocks = array())
    {
        // line 11
        echo "            <table style=\"margin: auto;width: 85%;\">
                <tr>
                    <th style=\"width: 8px;\"></th>
                    <th>Nom</th>
                    <th>level</th>
                    <th>XP</th>
                </tr>
                ";
        // line 18
        $context["i"] = 1;
        // line 19
        echo "                ";
        if (isset($context["guilds"])) { $_guilds_ = $context["guilds"]; } else { $_guilds_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_guilds_);
        foreach ($context['_seq'] as $context["_key"] => $context["guild"]) {
            // line 20
            echo "                    ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            if (($_i_ <= 3)) {
                // line 21
                echo "                        <tr class=\"pos";
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
                echo "                        <tr>
                            <td>";
                // line 25
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, $_i_, "html", null, true);
                echo "</td>
                    ";
            }
            // line 27
            echo "                            <td>";
            if (isset($context["guild"])) { $_guild_ = $context["guild"]; } else { $_guild_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_guild_, "name"), "html", null, true);
            echo "</td>
                            <td>";
            // line 28
            if (isset($context["guild"])) { $_guild_ = $context["guild"]; } else { $_guild_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_guild_, "lvl"), "html", null, true);
            echo "</td>
                            <td>";
            // line 29
            if (isset($context["guild"])) { $_guild_ = $context["guild"]; } else { $_guild_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_guild_, "xp"), "html", null, true);
            echo "</td>
                        </tr>
                    ";
            // line 31
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            $context["i"] = ($_i_ + 1);
            // line 32
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guild'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 33
        echo "            </table>
        ";
    }

    // line 7
    public function block_page($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
        $context["datas"] = $this->env->getExtension('Cache')->getCache($_name_);
        // line 9
        echo "    ";
        if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
        if (($_datas_ == false)) {
            // line 10
            echo "        ";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo $this->env->getExtension('Cache')->cache((string) $this->renderBlock("__internal_7da99dfb809d8df9cea6472ec33f335a_1", $context, $blocks), $_name_);
            // line 35
            echo "    ";
        } else {
            // line 36
            echo "        ";
            if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
            echo twig_escape_filter($this->env, $_datas_, "html", null, true);
            echo "
    ";
        }
    }

    public function getTemplateName()
    {
        return "ladder/guilds.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 36,  129 => 35,  125 => 10,  121 => 9,  117 => 8,  114 => 7,  109 => 33,  103 => 32,  100 => 31,  94 => 29,  89 => 28,  83 => 27,  77 => 25,  74 => 24,  68 => 22,  62 => 21,  58 => 20,  52 => 19,  50 => 18,  41 => 11,  38 => 10,  31 => 5,  28 => 4,);
    }
}
