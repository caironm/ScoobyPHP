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

/* Pages/DashBoard.twig */
class __TwigTemplate_63a1102212301c33e8432ef6c16a2d387ac85881133da45b4ec62626e1b4ef72 extends \Twig\Template
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
        echo "<div class='container'>
    <a href='";
        // line 2
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "exit' class='btn red waves-light'>Sair</a>
<h3 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou corretamente!</h3>
</div>";
    }

    public function getTemplateName()
    {
        return "Pages/DashBoard.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class='container'>
    <a href='{{ base_url }}exit' class='btn red waves-light'>Sair</a>
<h3 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou corretamente!</h3>
</div>", "Pages/DashBoard.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/DashBoard.twig");
    }
}
