<?php

/* admin/news_admin.html.twig */
class __TwigTemplate_e82eb7e775909b666b80b65582374a3d extends Twig_Template
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

    // line 3
    public function block_title_img($context, array $blocks = array())
    {
        echo $this->env->getExtension('assets')->img("title/img_admin.png");
        echo " ";
    }

    // line 5
    public function block_page($context, array $blocks = array())
    {
        // line 6
        echo "<fieldset>
    <legend>Publier une nouvelle</legend>
    <form action=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('url')->url("admin", "addnew"), "html", null, true);
        echo "\" method=\"post\">
        <table style=\"width: 100%;\">
            <tr>
                <td>
                    <select name=\"type\" class=\"input\" style=\"width: 100%;\">
                        <option value=\"1\">Info</option>
                        <option value=\"2\">News</option>
                        <option value=\"3\">Annonce</option>
                    </select>
                </td>
                <td><input class=\"input\" style=\"width: 99%;\" type=\"text\" name=\"title\" placeholder=\"Titre\" /></td>
            </tr>
            <tr>
                <td colspan=\"2\"><textarea name=\"new\" rows=\"10\" cols=\"50\"></textarea></td>
            </tr>
            <tr>
                <td><input class=\"input\" style=\"width: 100%;\" type=\"reset\" value=\"annuler\" /></td>
                <td><input class=\"input\" style=\"width: 100%;\" type=\"submit\" value=\"valider\" /></td>
            </tr>
        </table>
    </form>
</fieldset>
    <br/><br/>
<fieldset>
    <legend>Liste des news</legend>
    <table style=\"width: 100%\">
        <tr><th>Type</th><th>Titre</th><th>Auteur</th><th style=\"width: 16px;\"></th><th style=\"width: 16px;\"></th></tr>
        ";
        // line 35
        if (isset($context["news"])) { $_news_ = $context["news"]; } else { $_news_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_news_);
        foreach ($context['_seq'] as $context["_key"] => $context["new"]) {
            // line 36
            echo "            <tr>
                <td>";
            // line 37
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this, "getType", array(0 => $this->getAttribute($_new_, "type")), "method"), "html", null, true);
            echo "</td>
                <td>";
            // line 38
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_new_, "titre"), "html", null, true);
            echo "</td>
                <td>";
            // line 39
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_new_, "auteur"), "html", null, true);
            echo "</td>
                <td>";
            // line 40
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/delete.png"), "admin", ("delnew?id=" . $this->getAttribute($_new_, "id")));
            echo "</td>
                <td>";
            // line 41
            if (isset($context["new"])) { $_new_ = $context["new"]; } else { $_new_ = null; }
            echo $this->env->getExtension('url')->link($this->env->getExtension('assets')->img("devtool/edit.png"), "admin", ("changenew?id=" . $this->getAttribute($_new_, "id")));
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['new'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 44
        echo "    </table>
</fieldset>
";
    }

    // line 48
    public function getgetType($num = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "num" => $num,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 49
            echo "    ";
            if (isset($context["num"])) { $_num_ = $context["num"]; } else { $_num_ = null; }
            if (($_num_ == 1)) {
                // line 50
                echo "        Info
    ";
            } elseif (($_num_ == 2)) {
                // line 52
                echo "        New
    ";
            } elseif (($_num_ == 3)) {
                // line 54
                echo "        Annonce
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
        return "admin/news_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 54,  134 => 52,  130 => 50,  126 => 49,  115 => 48,  109 => 44,  99 => 41,  94 => 40,  89 => 39,  84 => 38,  79 => 37,  76 => 36,  71 => 35,  41 => 8,  37 => 6,  34 => 5,  27 => 3,);
    }
}
