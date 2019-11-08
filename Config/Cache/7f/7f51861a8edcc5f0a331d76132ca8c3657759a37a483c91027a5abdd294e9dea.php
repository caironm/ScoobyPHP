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
        echo "    <div class=\"navbar-fixed\">
        <nav>
            <div class=\"nav-wrapper black z-depth-5\">
                <a href=\"#\" class=\"brand-logo center\">ScoobyPHP</a>
                <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
                    <li><a href=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "login\" class=\"btn green waves-light\">Entrar</a></li>
                    <li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "register\" class=\"btn grey darken-4 waves-light\">Cadastrar</a></li>
                </ul>
            </div>
        </nav>
        <ul class=\"sidenav\" id=\"mobile-demo\">
            <li><a href=\"";
        // line 12
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "login\" class=\"btn green waves-light\">Entrar</a></li>
        </ul>
    </div>
    <div id=\"home\">
    <div class=\"container\">
        <h2 class=\"center\">
            <b>ScoobY Framework</b>
        </h2>
        <h3>
            ";
        // line 21
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
        return array (  68 => 21,  56 => 12,  48 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("    <div class=\"navbar-fixed\">
        <nav>
            <div class=\"nav-wrapper black z-depth-5\">
                <a href=\"#\" class=\"brand-logo center\">ScoobyPHP</a>
                <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
                    <li><a href=\"{{ base_url }}login\" class=\"btn green waves-light\">Entrar</a></li>
                    <li><a href=\"{{ base_url }}register\" class=\"btn grey darken-4 waves-light\">Cadastrar</a></li>
                </ul>
            </div>
        </nav>
        <ul class=\"sidenav\" id=\"mobile-demo\">
            <li><a href=\"{{ base_url }}login\" class=\"btn green waves-light\">Entrar</a></li>
        </ul>
    </div>
    <div id=\"home\">
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
