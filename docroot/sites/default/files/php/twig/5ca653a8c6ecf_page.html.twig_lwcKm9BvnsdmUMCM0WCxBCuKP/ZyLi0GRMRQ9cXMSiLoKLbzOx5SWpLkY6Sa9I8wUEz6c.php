<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/belgrade/templates/system/page.html.twig */
class __TwigTemplate_5733a755a60a4b2af6a8a56804438310d02b69016a600541ef3d2f399b5d9f7a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'navbar' => [$this, 'block_navbar'],
            'main' => [$this, 'block_main'],
            'header' => [$this, 'block_header'],
            'highlighted' => [$this, 'block_highlighted'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'sidebar_first' => [$this, 'block_sidebar_first'],
            'action_links' => [$this, 'block_action_links'],
            'help' => [$this, 'block_help'],
            'content' => [$this, 'block_content'],
            'sidebar_second' => [$this, 'block_sidebar_second'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 59, "if" => 61, "block" => 62];
        $filters = ["clean_class" => 67, "t" => 82];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 't'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 59
        $context["container"] = (($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", []), "fluid_container", [])) ? ("container-fluid") : ("container"));
        // line 61
        if (($this->getAttribute(($context["page"] ?? null), "navigation", []) || $this->getAttribute(($context["page"] ?? null), "top_navigation", []))) {
            // line 62
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 97
        echo "
";
        // line 99
        $this->displayBlock('main', $context, $blocks);
        // line 189
        echo "
";
        // line 190
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 191
            echo "  ";
            $this->displayBlock('footer', $context, $blocks);
        }
    }

    // line 62
    public function block_navbar($context, array $blocks = [])
    {
        // line 63
        echo "    ";
        // line 64
        $context["navbar_classes"] = [0 => "navbar", 1 => (($this->getAttribute($this->getAttribute(        // line 66
($context["theme"] ?? null), "settings", []), "navbar_inverse", [])) ? ("navbar-inverse") : ("navbar-default")), 2 => (($this->getAttribute($this->getAttribute(        // line 67
($context["theme"] ?? null), "settings", []), "navbar_position", [])) ? (("navbar-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", []), "navbar_position", []))))) : (($context["container"] ?? null)))];
        // line 70
        echo "    <header";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["navbar_attributes"] ?? null), "addClass", [0 => ($context["navbar_classes"] ?? null)], "method")), "html", null, true);
        echo " id=\"navbar\" role=\"banner\">
      ";
        // line 71
        if ( !$this->getAttribute(($context["navbar_attributes"] ?? null), "hasClass", [0 => ($context["container"] ?? null)], "method")) {
            // line 72
            echo "        <div class=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
      ";
        }
        // line 74
        echo "      <div class=\"navbar-header\">
        ";
        // line 76
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation", [])) {
            // line 77
            echo "          <button type=\"button\" class=\"toggle-btn\"  data-toggle=\"collapse\" data-target=\"#off-canvas\">
              <div class=\"toggle-btn--bars\">
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
              </div>
              <span class=\"toggle-btn--name hidden-xs\">";
            // line 82
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Menu"));
            echo "</span>
          </button>
        ";
        }
        // line 85
        echo "      </div>

      ";
        // line 88
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "top_navigation", [])) {
            // line 89
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "top_navigation", [])), "html", null, true);
            echo "
      ";
        }
        // line 91
        echo "      ";
        if ( !$this->getAttribute(($context["navbar_attributes"] ?? null), "hasClass", [0 => ($context["container"] ?? null)], "method")) {
            // line 92
            echo "        </div>
      ";
        }
        // line 94
        echo "    </header>
  ";
    }

    // line 99
    public function block_main($context, array $blocks = [])
    {
        // line 100
        echo "  <div role=\"main\" class=\"main-container js-quickedit-main-content\">
      ";
        // line 102
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation", [])) {
            // line 103
            echo "        <div id=\"off-canvas\" class=\"side-flyout collapse left\">
          ";
            // line 104
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "navigation", [])), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 107
        echo "
      ";
        // line 109
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 110
            echo "        ";
            $this->displayBlock('header', $context, $blocks);
            // line 113
            echo "      ";
        }
        // line 114
        echo "


    <div class=\"container\">
      ";
        // line 119
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 120
            echo "        ";
            $this->displayBlock('highlighted', $context, $blocks);
            // line 123
            echo "      ";
        }
        // line 124
        echo "
      ";
        // line 126
        echo "      ";
        if (($context["breadcrumb"] ?? null)) {
            // line 127
            echo "        ";
            $this->displayBlock('breadcrumb', $context, $blocks);
            // line 130
            echo "      ";
        }
        // line 131
        echo "
      <div class=\"row\">

        ";
        // line 135
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 136
            echo "          ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 141
            echo "        ";
        }
        // line 142
        echo "
        ";
        // line 144
        echo "        ";
        // line 145
        $context["content_classes"] = [0 => ((($this->getAttribute(        // line 146
($context["page"] ?? null), "sidebar_first", []) && $this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) ? ("col-sm-6") : ("")), 1 => ((($this->getAttribute(        // line 147
($context["page"] ?? null), "sidebar_first", []) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])))) ? ("col-sm-9") : ("")), 2 => ((($this->getAttribute(        // line 148
($context["page"] ?? null), "sidebar_second", []) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])))) ? ("col-sm-9") : (""))];
        // line 151
        echo "
        <section";
        // line 152
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => ($context["content_classes"] ?? null)], "method")), "html", null, true);
        echo ">

          ";
        // line 155
        echo "          ";
        if (($context["action_links"] ?? null)) {
            // line 156
            echo "            ";
            $this->displayBlock('action_links', $context, $blocks);
            // line 159
            echo "          ";
        }
        // line 160
        echo "
          ";
        // line 162
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "help", [])) {
            // line 163
            echo "            ";
            $this->displayBlock('help', $context, $blocks);
            // line 166
            echo "          ";
        }
        // line 167
        echo "
          ";
        // line 169
        echo "          ";
        $this->displayBlock('content', $context, $blocks);
        // line 175
        echo "        </section>

        ";
        // line 178
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
            // line 179
            echo "          ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 184
            echo "        ";
        }
        // line 185
        echo "      </div>
    </div>
  </div>
";
    }

    // line 110
    public function block_header($context, array $blocks = [])
    {
        // line 111
        echo "            ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
        echo "
        ";
    }

    // line 120
    public function block_highlighted($context, array $blocks = [])
    {
        // line 121
        echo "          <div class=\"highlighted\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
        echo "</div>
          ";
    }

    // line 127
    public function block_breadcrumb($context, array $blocks = [])
    {
        // line 128
        echo "          ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["breadcrumb"] ?? null)), "html", null, true);
        echo "
        ";
    }

    // line 136
    public function block_sidebar_first($context, array $blocks = [])
    {
        // line 137
        echo "            <aside class=\"col-sm-3\" role=\"complementary\">
              ";
        // line 138
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
        echo "
            </aside>
          ";
    }

    // line 156
    public function block_action_links($context, array $blocks = [])
    {
        // line 157
        echo "              <ul class=\"action-links\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null)), "html", null, true);
        echo "</ul>
            ";
    }

    // line 163
    public function block_help($context, array $blocks = [])
    {
        // line 164
        echo "              ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true);
        echo "
            ";
    }

    // line 169
    public function block_content($context, array $blocks = [])
    {
        // line 170
        echo "            <a id=\"main-content\"></a>
            <div class=\"container-fluid\">
              ";
        // line 172
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
            </div>
          ";
    }

    // line 179
    public function block_sidebar_second($context, array $blocks = [])
    {
        // line 180
        echo "            <aside class=\"col-sm-3\" role=\"complementary\">
              ";
        // line 181
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
        echo "
            </aside>
          ";
    }

    // line 191
    public function block_footer($context, array $blocks = [])
    {
        // line 192
        echo "    <footer class=\"footer\" role=\"contentinfo\">
      ";
        // line 193
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
        echo "
    </footer>
  ";
    }

    public function getTemplateName()
    {
        return "themes/belgrade/templates/system/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  388 => 193,  385 => 192,  382 => 191,  375 => 181,  372 => 180,  369 => 179,  362 => 172,  358 => 170,  355 => 169,  348 => 164,  345 => 163,  338 => 157,  335 => 156,  328 => 138,  325 => 137,  322 => 136,  315 => 128,  312 => 127,  305 => 121,  302 => 120,  295 => 111,  292 => 110,  285 => 185,  282 => 184,  279 => 179,  276 => 178,  272 => 175,  269 => 169,  266 => 167,  263 => 166,  260 => 163,  257 => 162,  254 => 160,  251 => 159,  248 => 156,  245 => 155,  240 => 152,  237 => 151,  235 => 148,  234 => 147,  233 => 146,  232 => 145,  230 => 144,  227 => 142,  224 => 141,  221 => 136,  218 => 135,  213 => 131,  210 => 130,  207 => 127,  204 => 126,  201 => 124,  198 => 123,  195 => 120,  192 => 119,  186 => 114,  183 => 113,  180 => 110,  177 => 109,  174 => 107,  168 => 104,  165 => 103,  162 => 102,  159 => 100,  156 => 99,  151 => 94,  147 => 92,  144 => 91,  138 => 89,  135 => 88,  131 => 85,  125 => 82,  118 => 77,  115 => 76,  112 => 74,  106 => 72,  104 => 71,  99 => 70,  97 => 67,  96 => 66,  95 => 64,  93 => 63,  90 => 62,  84 => 191,  82 => 190,  79 => 189,  77 => 99,  74 => 97,  70 => 62,  68 => 61,  66 => 59,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/belgrade/templates/system/page.html.twig", "/home/ben/www/drupal-test/themes/belgrade/templates/system/page.html.twig");
    }
}
