<?php

/* home/news.html.twig */
class __TwigTemplate_9bf01d74ab3d79a273bcc40998ebb3c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'title_img' => array($this, 'block_title_img'),
            '__internal_9bf01d74ab3d79a273bcc40998ebb3c1_1' => array($this, 'block___internal_9bf01d74ab3d79a273bcc40998ebb3c1_1'),
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
        echo $this->env->getExtension('assets')->img("title/img_accueil.png");
    }

    // line 9
    public function block___internal_9bf01d74ab3d79a273bcc40998ebb3c1_1($context, array $blocks = array())
    {
        // line 10
        echo "            ";
        if (isset($context["news"])) { $_news_ = $context["news"]; } else { $_news_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_news_);
        foreach ($context['_seq'] as $context["_key"] => $context["new"]) {
            // line 11
            echo "            <fieldset>
                ";
            // line 12
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this, "title_new", array(0 => $this->getAttribute($_new_, "type"), 1 => $this->getAttribute($_new_, "titre"), 2 => $this->getAttribute($_new_, "auteur")), "method"), "html", null, true);
            echo "<br/>
                ";
            // line 13
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute($_new_, "text"), "html", null, true));
            echo "
            </fieldset>
            <br/>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['new'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 17
        echo "        ";
    }

    // line 6
    public function block_page($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
        $context["datas"] = $this->env->getExtension('Cache')->getCache($_name_);
        // line 8
        echo "    ";
        if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
        if (($_datas_ == false)) {
            // line 9
            echo "        ";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo $this->env->getExtension('Cache')->cache((string) $this->renderBlock("__internal_9bf01d74ab3d79a273bcc40998ebb3c1_1", $context, $blocks), $_name_);
            // line 18
            echo "    ";
        } else {
            // line 19
            echo "            ";
            if (isset($context["datas"])) { $_datas_ = $context["datas"]; } else { $_datas_ = null; }
            echo $_datas_;
            echo "
    ";
        }
    }

    // line 23
    public function gettitle_new($type = null, $titre = null, $auteur = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "type" => $type,
            "titre" => $titre,
            "auteur" => $auteur,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 24
            echo "    ";
            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
            if (($_type_ == 1)) {
                // line 25
                echo "    <div class=\"titleNews_infos\">
        <span class=\"title_infos\">
            ";
                // line 27
                echo $this->env->getExtension('assets')->img("devtool/money.png", "devtoolIcon");
                echo " Information : 
        </span>
        ";
                // line 29
                if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_new_, "titre"), "html", null, true);
                echo "
        <br />
        <small style=\"text-align: right;\">
            Posté par <b>";
                // line 32
                if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_new_, "auteur"), "html", null, true);
                echo "</b>
        </small>
    </div>
    ";
            } elseif (($_type_ == 2)) {
                // line 36
                echo "    <div class=\"titleNews_news\">
        <span class=\"title_news\">
            ";
                // line 38
                echo $this->env->getExtension('assets')->img("devtool/money.png", "devtoolIcon");
                echo " New : 
        </span>
        ";
                // line 40
                if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_new_, "titre"), "html", null, true);
                echo "
        <br />
        <small style=\"text-align: right;\">
            Posté par <b>";
                // line 43
                if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_new_, "auteur"), "html", null, true);
                echo "</b>
        </small>
    </div>
    ";
            } elseif (($_type_ == 3)) {
                // line 47
                echo "    <div class=\"titleNews_announce\">
        <span class=\"title_announce\">
            ";
                // line 49
                echo $this->env->getExtension('assets')->img("devtool/money.png", "devtoolIcon");
                echo " Annonce : 
        </span>
        ";
                // line 51
                if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_new_, "titre"), "html", null, true);
                echo "
        <br />
        <small style=\"text-align: right;\">
            Posté par <b>";
                // line 54
                if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_new_, "auteur"), "html", null, true);
                echo "</b>
        </small>
    </div>
    ";
            }
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "home/news.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 54,  167 => 51,  162 => 49,  158 => 47,  150 => 43,  143 => 40,  138 => 38,  134 => 36,  126 => 32,  119 => 29,  114 => 27,  110 => 25,  106 => 24,  93 => 23,  84 => 19,  81 => 18,  77 => 9,  73 => 8,  69 => 7,  66 => 6,  62 => 17,  51 => 13,  46 => 12,  43 => 11,  37 => 10,  34 => 9,  28 => 4,);
    }
}
