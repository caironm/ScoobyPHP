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

/* /Home.twig */
class __TwigTemplate_c6b5a3f93f19a57832d087151142d85e7cd3e528fa809606c30fb49651eb9b20 extends \Twig\Template
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
        echo "
        <div class=\"wrapper\">
            <!-- Sidebar Holder -->
            <nav id=\"sidebar\">
                <div class=\"sidebar-header\">
                    <h2>ScoobY</h2>
                    <h3>Framework</h3>
                </div>

                <ul class=\"list-unstyled components sticky-top\">
                    <p></p>
                    <li class=\"\">
                        <a href=\"#homeSubmenu\" data-toggle=\"collapse\" aria-expanded=\"false\">Documentação</a>
                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu\">
                            <li><a href=\"#\">Controllers</a></li>
                            <li><a href=\"#\">Models</a></li>
                            <li><a href=\"#\">Views</a></li>
                            <li><a href=\"#\">Helpers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=\"#\">Sobre</a>
                    </li>
                    <li>
                        <a href=\"#\">Contato</a>
                    </li>
                    <br><br>
                    <div class=\"container\">
                    <li><a href=\"https://bootstrapious.com/tutorial/files/sidebar.zip\" class=\"download btn btn-outline-success \">Download</a></li>
                    </div>
                    
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id=\"content\">

                <nav class=\"navbar navbar-default\">
                    <div class=\"container-fluid\">

                        <div class=\"navbar-header\">
                            <button type=\"button\" id=\"sidebarCollapse\" class=\"navbar-btn sticky-top\">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                            <ul class=\"nav navbar-nav navbar-right\">
                               
                            <li><a href=\"#\">Controllers</a></li>
                            <li><a href=\"#\">Models</a></li>
                            <li><a href=\"#\">Views</a></li>
                            <li><a href=\"#\">Helpers</a></li>
                      
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class=\"container\">
                <h1 class='center' style='text-align: center'><b>ScoobYFramework</b></h1>
                <h2 style='text-align: center'>
                  ";
        // line 64
        echo twig_escape_filter($this->env, ($context["wellcomeMessage"] ?? null), "html", null, true);
        echo "
                </h2>
                </div>
        </div>
";
    }

    public function getTemplateName()
    {
        return "/Home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 64,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
        <div class=\"wrapper\">
            <!-- Sidebar Holder -->
            <nav id=\"sidebar\">
                <div class=\"sidebar-header\">
                    <h2>ScoobY</h2>
                    <h3>Framework</h3>
                </div>

                <ul class=\"list-unstyled components sticky-top\">
                    <p></p>
                    <li class=\"\">
                        <a href=\"#homeSubmenu\" data-toggle=\"collapse\" aria-expanded=\"false\">Documentação</a>
                        <ul class=\"collapse list-unstyled\" id=\"homeSubmenu\">
                            <li><a href=\"#\">Controllers</a></li>
                            <li><a href=\"#\">Models</a></li>
                            <li><a href=\"#\">Views</a></li>
                            <li><a href=\"#\">Helpers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=\"#\">Sobre</a>
                    </li>
                    <li>
                        <a href=\"#\">Contato</a>
                    </li>
                    <br><br>
                    <div class=\"container\">
                    <li><a href=\"https://bootstrapious.com/tutorial/files/sidebar.zip\" class=\"download btn btn-outline-success \">Download</a></li>
                    </div>
                    
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id=\"content\">

                <nav class=\"navbar navbar-default\">
                    <div class=\"container-fluid\">

                        <div class=\"navbar-header\">
                            <button type=\"button\" id=\"sidebarCollapse\" class=\"navbar-btn sticky-top\">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                            <ul class=\"nav navbar-nav navbar-right\">
                               
                            <li><a href=\"#\">Controllers</a></li>
                            <li><a href=\"#\">Models</a></li>
                            <li><a href=\"#\">Views</a></li>
                            <li><a href=\"#\">Helpers</a></li>
                      
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class=\"container\">
                <h1 class='center' style='text-align: center'><b>ScoobYFramework</b></h1>
                <h2 style='text-align: center'>
                  {{ wellcomeMessage }}
                </h2>
                </div>
        </div>
", "/Home.twig", "/opt/lampp/htdocs/Scooby-3.0/App/Views/Home.twig");
    }
}
