<?php

/* ladder/perso.html.twig */
class __TwigTemplate_9147e7bc0f55df98aff336158338c0a7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
            '__internal_9147e7bc0f55df98aff336158338c0a7_1' => array($this, 'block___internal_9147e7bc0f55df98aff336158338c0a7_1'),
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
        echo $this->env->getExtension('assets')->img("title/img_ladder.png");
        echo "
";
    }

    // line 11
    public function block___internal_9147e7bc0f55df98aff336158338c0a7_1($context, array $blocks = array())
    {
        // line 12
        echo "        <table style=\"width: 95%;margin: auto;\">
            <tr>
                <th width=\"8\"></th>
                <th>Nom</th>
                <th width=\"30\">";
        // line 16
        echo $this->env->getExtension('assets')->img("heads/SmallHead_0.png");
        echo "</th>
                <th>Level</th>
                <th>";
        // line 18
        echo $this->env->getExtension('url')->link("XP", "ladder", "index?order=xp");
        echo "</th>
                <th>";
        // line 19
        echo $this->env->getExtension('url')->link("Kamas", "ladder", "index?order=kamas");
        echo "</th>
            </tr>
            ";
        // line 21
        $context["i"] = 1;
        // line 22
        echo "            ";
        if (isset($context["persos"])) { $_persos_ = $context["persos"]; } else { $_persos_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_persos_);
        foreach ($context['_seq'] as $context["_key"] => $context["perso"]) {
            // line 23
            echo "                ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            if (($_i_ <= 3)) {
                // line 24
                echo "                <tr class=\"pos";
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, $_i_, "html", null, true);
                echo "\">
                    <td>";
                // line 25
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo $this->env->getExtension('assets')->img((("trophy/trophy_" . $_i_) . ".png"));
                echo "</td>
                ";
            } else {
                // line 27
                echo "                <tr>
                    <td>";
                // line 28
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, $_i_, "html", null, true);
                echo "</td>
                ";
            }
            // line 30
            echo "                    <td>";
            if (isset($context["perso"])) { $_perso_ = $context["perso"]; } else { $_perso_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_perso_, "name"), "html", null, true);
            echo "</td>
                    <td>";
            // line 31
            if (isset($context["perso"])) { $_perso_ = $context["perso"]; } else { $_perso_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this, "head", array(0 => $this->getAttribute($_perso_, "class"), 1 => $this->getAttribute($_perso_, "sexe")), "method"), "html", null, true);
            echo "</td>
                    <td>";
            // line 32
            if (isset($context["perso"])) { $_perso_ = $context["perso"]; } else { $_perso_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_perso_, "level"), "html", null, true);
            echo "</td>
                    <td>";
            // line 33
            if (isset($context["perso"])) { $_perso_ = $context["perso"]; } else { $_perso_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_perso_, "xp"), "html", null, true);
            echo "</td>
                    <td>";
            // line 34
            if (isset($context["perso"])) { $_perso_ = $context["perso"]; } else { $_perso_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_perso_, "kamas"), "html", null, true);
            echo "</td>
                </tr>
                ";
            // line 36
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            $context["i"] = ($_i_ + 1);
            // line 37
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['perso'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 38
        echo "        </table>
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
            echo $this->env->getExtension('Cache')->cache((string) $this->renderBlock("__internal_9147e7bc0f55df98aff336158338c0a7_1", $context, $blocks), $_name_);
            // line 40
            echo "    ";
        } else {
            // line 41
            echo "        ";
            if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
            echo $_datas_;
            echo "
    ";
        }
    }

    // line 45
    public function gethead($class = null, $sexe = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "class" => $class,
            "sexe" => $sexe,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 46
            echo "    ";
            if (isset($context["class"])) { $_class_ = $context["class"]; } else { $_class_ = null; }
            if (($_class_ == 1)) {
                // line 47
                echo "        ";
                $context["head"] = "feca";
                // line 48
                echo "    ";
            } elseif (($_class_ == 2)) {
                // line 49
                echo "        ";
                $context["head"] = "osa";
                // line 50
                echo "    ";
            } elseif (($_class_ == 3)) {
                // line 51
                echo "        ";
                $context["head"] = "enu";
                // line 52
                echo "    ";
            } elseif (($_class_ == 4)) {
                // line 53
                echo "        ";
                $context["head"] = "sram";
                // line 54
                echo "    ";
            } elseif (($_class_ == 5)) {
                // line 55
                echo "        ";
                $context["head"] = "xel";
                // line 56
                echo "    ";
            } elseif (($_class_ == 6)) {
                // line 57
                echo "        ";
                $context["head"] = "eca";
                // line 58
                echo "    ";
            } elseif (($_class_ == 7)) {
                // line 59
                echo "        ";
                $context["head"] = "eni";
                // line 60
                echo "    ";
            } elseif (($_class_ == 8)) {
                // line 61
                echo "        ";
                $context["head"] = "iop";
                // line 62
                echo "    ";
            } elseif (($_class_ == 9)) {
                // line 63
                echo "        ";
                $context["head"] = "cra";
                // line 64
                echo "    ";
            } elseif (($_class_ == 10)) {
                // line 65
                echo "        ";
                $context["head"] = "sadi";
                // line 66
                echo "    ";
            } elseif (($_class_ == 11)) {
                // line 67
                echo "        ";
                $context["head"] = "sacri";
                // line 68
                echo "    ";
            } elseif (($_class_ == 12)) {
                // line 69
                echo "        ";
                $context["head"] = "pand";
                // line 70
                echo "    ";
            }
            // line 71
            echo "
    ";
            // line 72
            if (isset($context["sexe"])) { $_sexe_ = $context["sexe"]; } else { $_sexe_ = null; }
            if (($_sexe_ == 0)) {
                // line 73
                echo "        ";
                if (isset($context["head"])) { $_head_ = $context["head"]; } else { $_head_ = null; }
                $context["head"] = ($_head_ . "_m");
                // line 74
                echo "    ";
            } else {
                // line 75
                echo "        ";
                if (isset($context["head"])) { $_head_ = $context["head"]; } else { $_head_ = null; }
                $context["head"] = ($_head_ . "_f");
                // line 76
                echo "    ";
            }
            // line 77
            echo "    ";
            if (isset($context["head"])) { $_head_ = $context["head"]; } else { $_head_ = null; }
            echo $this->env->getExtension('assets')->img((("heads/" . $_head_) . ".png"));
            echo "
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "ladder/perso.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  270 => 77,  267 => 76,  263 => 75,  260 => 74,  256 => 73,  253 => 72,  250 => 71,  247 => 70,  244 => 69,  241 => 68,  238 => 67,  235 => 66,  232 => 65,  229 => 64,  226 => 63,  223 => 62,  220 => 61,  217 => 60,  214 => 59,  211 => 58,  208 => 57,  205 => 56,  202 => 55,  199 => 54,  196 => 53,  193 => 52,  190 => 51,  187 => 50,  184 => 49,  181 => 48,  178 => 47,  174 => 46,  162 => 45,  153 => 41,  150 => 40,  146 => 11,  142 => 10,  138 => 9,  135 => 8,  130 => 38,  124 => 37,  121 => 36,  115 => 34,  110 => 33,  105 => 32,  100 => 31,  94 => 30,  88 => 28,  85 => 27,  79 => 25,  73 => 24,  69 => 23,  63 => 22,  61 => 21,  56 => 19,  52 => 18,  47 => 16,  41 => 12,  38 => 11,  31 => 6,  28 => 5,);
    }
}
