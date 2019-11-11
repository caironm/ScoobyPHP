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
class __TwigTemplate_6d3a599b8eaca9acb2a212b98a9869075275ac9537133b20027e8c45d89986a3 extends \Twig\Template
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
</div>", "Error/404.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Error/404.twig");
    }
}
