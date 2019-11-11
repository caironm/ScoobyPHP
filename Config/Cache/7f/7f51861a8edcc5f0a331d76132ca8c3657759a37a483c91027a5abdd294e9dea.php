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
class __TwigTemplate_5c482f0453403d5ab1dd94cdc814ab5afa1e1bb9404e46cb3b42f2317f59e12d extends \Twig\Template
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
        echo "<div id=\"home\">
    <div class=\"container\">
        <h2 class=\"center\">
            <b>ScoobY Framework</b>
        </h2>
        <h3>
            ";
        // line 7
        echo twig_escape_filter($this->env, ($context["wellcomeMessage"] ?? null), "html", null, true);
        echo "
        </h3>
        <footer class=\"\">
            <span class=\"right footer-msg\"> Feito em <i class=\"green-text\"><strong>PG</strong></i> com muito <i
                    class=\"material-icons right red-text\">favorite</i></span>
        </footer>
    </div>
</div>    ";
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
        return array (  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div id=\"home\">
    <div class=\"container\">
        <h2 class=\"center\">
            <b>ScoobY Framework</b>
        </h2>
        <h3>
            {{ wellcomeMessage }}
        </h3>
        <footer class=\"\">
            <span class=\"right footer-msg\"> Feito em <i class=\"green-text\"><strong>PG</strong></i> com muito <i
                    class=\"material-icons right red-text\">favorite</i></span>
        </footer>
    </div>
</div>    ", "Pages/Home.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/Home.twig");
    }
}
