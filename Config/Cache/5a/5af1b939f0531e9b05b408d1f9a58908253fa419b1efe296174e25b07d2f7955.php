<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* Pages/Home.twig */
class __TwigTemplate_ca2741e13777146b872cf110b7a771ab8b30a26e6c85d296d30b4a958a54ac30 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"container\">
    <h1 class='center'>
        <b>ScoobY Framework</b>
    </h1>
    <h2>
        ";
        // line 6
        echo twig_escape_filter($this->env, ($context["wellcomeMessage"] ?? null), "html", null, true);
        echo "
    </h2>
</div>
";
    }

    public function getTemplateName()
    {
        return "Pages/Home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container\">
    <h1 class='center'>
        <b>ScoobY Framework</b>
    </h1>
    <h2>
        {{ wellcomeMessage }}
    </h2>
</div>
", "Pages/Home.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/Home.twig");
    }
}
