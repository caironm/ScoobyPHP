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

/* Pages/PasswordRescue.twig */
class __TwigTemplate_6bd3fcbe8996b0ad6e0575c7da2f6284e48bbbff8b1c5dfc4b9dd07124cc204a extends \Twig\Template
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
        echo "            ";
        // line 2
        echo "    <div class=\"bg-login\">
        <div class=\"container-fluid z-depth-5\" style=\"margin:3% 10% !important; padding:0; background-color: #ddd !important\">
                <a href=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "back\" class=\"btn black\">voltar</a>
            <h2 class=\"center\">ScoobYTasks - Recuperação de senha</h2>
            ";
        // line 6
        if (($context["msg"] ?? null)) {
            // line 7
            echo "            <span class=\"alert\"> ";
            echo ($context["msg"] ?? null);
            echo " </span>
            ";
        }
        // line 9
        echo "            <div class=\"row\">
                <div class=\"col s12 m8 offset-m2\">
                    <form class=\"login-form  z-depth-5\" method=\"post\" action=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "user/newPass\">
                        <div class=\"card\">
                            <input type=\"hidden\" name=\"csrfToken\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["csrfToken"] ?? null), "html", null, true);
        echo "\">
                            <div class=\"card-content\">
                                <div class=\"input-field\">
                                    <input class=\"validate\" id=\"email\" type=\"email\" name=\"email\">
                                    <label for=\"email\">Digite seu email cadastrado em nosso sistema</label>
                                </div>
                            </div>
                            <div class=\"card-action\">
                                <div class=\"center-align\">
                                    <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Recuperar
                                        <i class=\"material-icons right\">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class=\"row\">
                            <div class=\"col s8 \">
                                    <a href=\"";
        // line 31
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "login\" class=\"btn red\">Login</a>
                                </div>
                        <div class=\"col s4 right-align\">
                            <a href=\"";
        // line 34
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "register\" class=\"btn purple\">Registrar</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "Pages/PasswordRescue.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 34,  86 => 31,  65 => 13,  60 => 11,  56 => 9,  50 => 7,  48 => 6,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("            {# View criada em '.06-11-19 - 19:18:pm.' Via Scooby_CLI #}
    <div class=\"bg-login\">
        <div class=\"container-fluid z-depth-5\" style=\"margin:3% 10% !important; padding:0; background-color: #ddd !important\">
                <a href=\"{{ base_url }}back\" class=\"btn black\">voltar</a>
            <h2 class=\"center\">ScoobYTasks - Recuperação de senha</h2>
            {% if msg %}
            <span class=\"alert\"> {{ msg|raw }} </span>
            {% endif %}
            <div class=\"row\">
                <div class=\"col s12 m8 offset-m2\">
                    <form class=\"login-form  z-depth-5\" method=\"post\" action=\"{{ base_url }}user/newPass\">
                        <div class=\"card\">
                            <input type=\"hidden\" name=\"csrfToken\" value=\"{{ csrfToken }}\">
                            <div class=\"card-content\">
                                <div class=\"input-field\">
                                    <input class=\"validate\" id=\"email\" type=\"email\" name=\"email\">
                                    <label for=\"email\">Digite seu email cadastrado em nosso sistema</label>
                                </div>
                            </div>
                            <div class=\"card-action\">
                                <div class=\"center-align\">
                                    <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Recuperar
                                        <i class=\"material-icons right\">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class=\"row\">
                            <div class=\"col s8 \">
                                    <a href=\"{{ base_url }}login\" class=\"btn red\">Login</a>
                                </div>
                        <div class=\"col s4 right-align\">
                            <a href=\"{{ base_url }}register\" class=\"btn purple\">Registrar</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>", "Pages/PasswordRescue.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/PasswordRescue.twig");
    }
}
