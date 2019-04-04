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

/* themes/commerce_bootstrap/templates/commerce/commerce-checkout-form--with-sidebar.html.twig */
class __TwigTemplate_2c13975e2619752181c993d7a22906fb3b571a5ad8a1ec84f849d8cb288a595d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["trans" => 18];
        $filters = ["without" => 15];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['trans'],
                ['without'],
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
        // line 12
        echo "<div class=\"layout-checkout-form container-fluid clearfix\">
  <div class=\"row\">
    <div class=\"layout-region layout-region-checkout-main col-xs-12 col-md-8\">
      ";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_without($this->sandbox->ensureToStringAllowed(($context["form"] ?? null)), "sidebar", "actions"), "html", null, true);
        echo "
    </div>
    <div class=\"layout-region layout-region-checkout-secondary col-xs-12 col-md-4\">
      <h3>";
        // line 18
        echo t("Order Summary", array());
        echo "</h3>
      ";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "sidebar", [])), "html", null, true);
        echo "
    </div>
  </div>
  <div class=\"row\">
    <div class=\"layout-region layout-region-checkout-footer col-xs-12\">
      ";
        // line 24
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "actions", [])), "html", null, true);
        echo "
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/commerce_bootstrap/templates/commerce/commerce-checkout-form--with-sidebar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 24,  70 => 19,  66 => 18,  60 => 15,  55 => 12,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/commerce_bootstrap/templates/commerce/commerce-checkout-form--with-sidebar.html.twig", "/home/ben/www/drupal-test/themes/commerce_bootstrap/templates/commerce/commerce-checkout-form--with-sidebar.html.twig");
    }
}
