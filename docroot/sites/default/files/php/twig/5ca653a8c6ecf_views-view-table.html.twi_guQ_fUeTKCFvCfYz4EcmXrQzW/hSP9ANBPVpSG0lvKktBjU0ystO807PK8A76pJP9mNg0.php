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

/* themes/bootstrap/templates/views/views-view-table.html.twig */
class __TwigTemplate_50a8dfb04ee12ae3dceaa024ed09084d2fe234f9dabba93efb59fad9fb47de6c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 36, "set" => 40, "for" => 72];
        $filters = ["merge" => 109];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['merge'],
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
        // line 36
        if (($context["responsive"] ?? null)) {
            // line 37
            echo "  <div class=\"table-responsive\">
";
        }
        // line 40
        $context["classes"] = [0 => "table", 1 => ((        // line 42
($context["bordered"] ?? null)) ? ("table-bordered") : ("")), 2 => ((        // line 43
($context["condensed"] ?? null)) ? ("table-condensed") : ("")), 3 => ((        // line 44
($context["hover"] ?? null)) ? ("table-hover") : ("")), 4 => ((        // line 45
($context["striped"] ?? null)) ? ("table-striped") : ("")), 5 => ((        // line 46
($context["sticky"] ?? null)) ? ("sticky-enabled") : (""))];
        // line 49
        echo "<table";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 50
        if (($context["caption_needed"] ?? null)) {
            // line 51
            echo "    <caption>
      ";
            // line 52
            if (($context["caption"] ?? null)) {
                // line 53
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption"] ?? null)), "html", null, true);
                echo "
      ";
            } else {
                // line 55
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
                echo "
      ";
            }
            // line 57
            echo "      ";
            if (( !twig_test_empty(($context["summary"] ?? null)) ||  !twig_test_empty(($context["description"] ?? null)))) {
                // line 58
                echo "        <details>
          ";
                // line 59
                if ( !twig_test_empty(($context["summary"] ?? null))) {
                    // line 60
                    echo "            <summary>";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["summary"] ?? null)), "html", null, true);
                    echo "</summary>
          ";
                }
                // line 62
                echo "          ";
                if ( !twig_test_empty(($context["description"] ?? null))) {
                    // line 63
                    echo "            ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null)), "html", null, true);
                    echo "
          ";
                }
                // line 65
                echo "        </details>
      ";
            }
            // line 67
            echo "    </caption>
  ";
        }
        // line 69
        echo "  ";
        if (($context["header"] ?? null)) {
            // line 70
            echo "    <thead>
    <tr>
      ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["header"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["column"]) {
                // line 73
                echo "        ";
                if ($this->getAttribute($context["column"], "default_classes", [])) {
                    // line 74
                    echo "          ";
                    // line 75
                    $context["column_classes"] = [0 => "views-field", 1 => ("views-field-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(                    // line 77
($context["fields"] ?? null), $context["key"], [], "array")))];
                    // line 80
                    echo "        ";
                }
                // line 81
                echo "      <th";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["column"], "attributes", []), "addClass", [0 => ($context["column_classes"] ?? null)], "method"), "setAttribute", [0 => "scope", 1 => "col"], "method")), "html", null, true);
                echo ">";
                // line 82
                if ($this->getAttribute($context["column"], "wrapper_element", [])) {
                    // line 83
                    echo "<";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "wrapper_element", [])), "html", null, true);
                    echo ">";
                    // line 84
                    if ($this->getAttribute($context["column"], "url", [])) {
                        // line 85
                        echo "<a href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "url", [])), "html", null, true);
                        echo "\" title=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "title", [])), "html", null, true);
                        echo "\">";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "content", [])), "html", null, true);
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "sort_indicator", [])), "html", null, true);
                        echo "</a>";
                    } else {
                        // line 87
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "content", [])), "html", null, true);
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "sort_indicator", [])), "html", null, true);
                    }
                    // line 89
                    echo "</";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "wrapper_element", [])), "html", null, true);
                    echo ">";
                } else {
                    // line 91
                    if ($this->getAttribute($context["column"], "url", [])) {
                        // line 92
                        echo "<a href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "url", [])), "html", null, true);
                        echo "\" title=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "title", [])), "html", null, true);
                        echo "\">";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "content", [])), "html", null, true);
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "sort_indicator", [])), "html", null, true);
                        echo "</a>";
                    } else {
                        // line 94
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "content", [])), "html", null, true);
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "sort_indicator", [])), "html", null, true);
                    }
                }
                // line 97
                echo "</th>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "    </tr>
    </thead>
  ";
        }
        // line 102
        echo "  <tbody>
  ";
        // line 103
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 104
            echo "    <tr";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["row"], "attributes", [])), "html", null, true);
            echo ">
      ";
            // line 105
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "columns", []));
            foreach ($context['_seq'] as $context["key"] => $context["column"]) {
                // line 106
                echo "        ";
                if ($this->getAttribute($context["column"], "default_classes", [])) {
                    // line 107
                    echo "          ";
                    $context["column_classes"] = [0 => "views-field"];
                    // line 108
                    echo "          ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["column"], "fields", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                        // line 109
                        echo "            ";
                        $context["column_classes"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["column_classes"] ?? null)), [0 => ("views-field-" . $this->sandbox->ensureToStringAllowed($context["field"]))]);
                        // line 110
                        echo "          ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 111
                    echo "        ";
                }
                // line 112
                echo "      <td";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["column"], "attributes", []), "addClass", [0 => ($context["column_classes"] ?? null)], "method")), "html", null, true);
                echo ">";
                // line 113
                if ($this->getAttribute($context["column"], "wrapper_element", [])) {
                    // line 114
                    echo "<";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "wrapper_element", [])), "html", null, true);
                    echo ">
          ";
                    // line 115
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["column"], "content", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["content"]) {
                        // line 116
                        echo "            ";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["content"], "separator", [])), "html", null, true);
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["content"], "field_output", [])), "html", null, true);
                        echo "
          ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['content'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 118
                    echo "          </";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "wrapper_element", [])), "html", null, true);
                    echo ">";
                } else {
                    // line 120
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["column"], "content", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["content"]) {
                        // line 121
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["content"], "separator", [])), "html", null, true);
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["content"], "field_output", [])), "html", null, true);
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['content'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                }
                // line 124
                echo "        </td>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 126
            echo "    </tr>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "  </tbody>
</table>
";
        // line 130
        if (($context["responsive"] ?? null)) {
            // line 131
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/bootstrap/templates/views/views-view-table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  306 => 131,  304 => 130,  300 => 128,  293 => 126,  286 => 124,  278 => 121,  274 => 120,  269 => 118,  259 => 116,  255 => 115,  250 => 114,  248 => 113,  244 => 112,  241 => 111,  235 => 110,  232 => 109,  227 => 108,  224 => 107,  221 => 106,  217 => 105,  212 => 104,  208 => 103,  205 => 102,  200 => 99,  193 => 97,  188 => 94,  178 => 92,  176 => 91,  171 => 89,  167 => 87,  157 => 85,  155 => 84,  151 => 83,  149 => 82,  145 => 81,  142 => 80,  140 => 77,  139 => 75,  137 => 74,  134 => 73,  130 => 72,  126 => 70,  123 => 69,  119 => 67,  115 => 65,  109 => 63,  106 => 62,  100 => 60,  98 => 59,  95 => 58,  92 => 57,  86 => 55,  80 => 53,  78 => 52,  75 => 51,  73 => 50,  68 => 49,  66 => 46,  65 => 45,  64 => 44,  63 => 43,  62 => 42,  61 => 40,  57 => 37,  55 => 36,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/bootstrap/templates/views/views-view-table.html.twig", "/home/ben/www/drupal-test/themes/bootstrap/templates/views/views-view-table.html.twig");
    }
}
