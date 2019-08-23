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

/* Error/404.twig */
class __TwigTemplate_664d5cb84261b8a8fb57dcd81635246b7017cc295b27011b37ceb7c52a7d05df extends \Twig\Template
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
        echo "<div class=\"error\">
    <div class=\"error-message\">
        <div class=\"square\">
            <span class='title'>404</span>
            <h4>Página não encontrada!</h4>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Error/404.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"error\">
    <div class=\"error-message\">
        <div class=\"square\">
            <span class='title'>404</span>
            <h4>Página não encontrada!</h4>
        </div>
    </div>
</div>", "Error/404.twig", "/opt/lampp/htdocs/Scooby-3.0/App/Views/Error/404.twig");
    }
}
