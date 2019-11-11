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

/* Error/Failure.twig */
class __TwigTemplate_e31b2df76eb0ac0ce8faaf6902171ec353c1e3d1e7d42d17bcc31edc9f6b7ab5 extends \Twig\Template
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
<br>
   <h1 class='text-center'> Erro de autenticação </h1>
</div>";
    }

    public function getTemplateName()
    {
        return "Error/Failure.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container\">
<br>
   <h1 class='text-center'> Erro de autenticação </h1>
</div>", "Error/Failure.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Error/Failure.twig");
    }
}
