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
class __TwigTemplate_58b4b2ffd3a1192ebeff99bbfc29cfcebe4f2421cc50831b9b5ce4b6450e2b79 extends \Twig\Template
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
        echo "<div class='container-fluid z-depth-5' style=\"margin:3% 10% !important; padding:5%; background-color: #ddd !important\">
    <h2 class=\"center\">ScoobyPHP DashBoard.</h2>    
<h4 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou corretamente!</h4>
<br>
<a href='";
        // line 5
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "exit' class='btn red waves-light'>Sair</a>    
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
        return array (  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class='container-fluid z-depth-5' style=\"margin:3% 10% !important; padding:5%; background-color: #ddd !important\">
    <h2 class=\"center\">ScoobyPHP DashBoard.</h2>    
<h4 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou corretamente!</h4>
<br>
<a href='{{ base_url }}exit' class='btn red waves-light'>Sair</a>    
</div>", "Pages/DashBoard.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/DashBoard.twig");
    }
}
