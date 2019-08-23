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

/* 404.twig */
class __TwigTemplate_a262536cb83a48286b486d5cda27154018b75554d711418e96c473d70e61c8be extends \Twig\Template
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
        return "404.twig";
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
</div>", "404.twig", "/opt/lampp/htdocs/Scooby-3.0/App/Views/404.twig");
    }
}
