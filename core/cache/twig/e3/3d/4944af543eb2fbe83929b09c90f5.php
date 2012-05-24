<?php

/* statuts/success.html.twig */
class __TwigTemplate_e33d4944af543eb2fbe83929b09c90f5 extends Twig_Template
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

    // line 4
    public function block_title_img($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
        echo $this->env->getExtension('assets')->img((("title/" . $_image_) . ".png"));
        echo "
";
    }

    // line 7
    public function block_page($context, array $blocks = array())
    {
        // line 8
        echo "    <div class=\"verifOK\">
        <h3>";
        // line 9
        echo $this->env->getExtension('assets')->img("devtool/infos.png");
        echo " ";
        if (isset($context["titre"])) { $_titre_ = $context["titre"]; } else { $_titre_ = null; }
        echo twig_escape_filter($this->env, $_titre_, "html", null, true);
        echo "</h3>
        ";
        // line 10
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        echo $_message_;
        echo "
        <hr/>
        <meta http-equiv=\"refresh\" content=\"5;url=";
        // line 12
        if (isset($context["controller"])) { $_controller_ = $context["controller"]; } else { $_controller_ = null; }
        if (isset($context["method"])) { $_method_ = $context["method"]; } else { $_method_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url($_controller_, $_method_), "html", null, true);
        echo "\" />
        ";
        // line 13
        if (isset($context["controller"])) { $_controller_ = $context["controller"]; } else { $_controller_ = null; }
        if (isset($context["method"])) { $_method_ = $context["method"]; } else { $_method_ = null; }
        echo $this->env->getExtension('url')->link("ne pas patienter", $_controller_, $_method_);
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "statuts/success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 13,  57 => 12,  51 => 10,  44 => 9,  41 => 8,  38 => 7,  30 => 5,  27 => 4,);
    }
}
