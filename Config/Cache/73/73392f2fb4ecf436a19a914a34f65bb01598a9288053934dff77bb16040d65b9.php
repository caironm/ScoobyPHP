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

/* Pages/Login.twig */
class __TwigTemplate_66e1da050a79df9d9250b4d0e3ddf4b7450a16c58063290596a9a69d123d2068 extends \Twig\Template
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
        echo "    ";
        // line 2
        echo "<div class=\"bg-login\">
    <div class=\"container-fluid z-depth-5\" style=\"margin:3% 10% !important; padding:0; background-color: #ddd !important\">
    <a href=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "back\" class=\"btn black\">voltar</a>
        <h2 class=\"center\">ScoobYTasks - Login</h2>
        ";
        // line 6
        if (($context["msg"] ?? null)) {
            // line 7
            echo "        <span class=\"alert\"> ";
            echo ($context["msg"] ?? null);
            echo " </span>
        ";
        }
        // line 9
        echo "        <div class=\"row\">
            <div class=\"col s12 m8 offset-m2\">
                <form class=\"login-form  z-depth-5\" method=\"post\" action=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "user/login\">
                    <div class=\"card\">
                        <input type=\"hidden\" name=\"csrfToken\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["csrfToken"] ?? null), "html", null, true);
        echo "\">
                        <div class=\"card-content\">
                            <div class=\"input-field\">
                                <input class=\"validate\" id=\"email\" type=\"email\" name=\"email\">
                                <label for=\"email\">Email</label>
                            </div>
                            <div class=\"row\">
                                <div class=\"col s12 m12 l12\">
                                    <div class=\"input-field\">
                                        <input id=\"password\" type=\"password\" name=\"pass\">
                                        <label for=\"password\">Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-action\">
                            <div class=\"center-align\">
                                <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Entrar
                                    <i class=\"material-icons right\">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class=\"row\">
                    <div class=\"col s4\">
                        <a href=\"";
        // line 39
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "register\" class=\"btn purple\">Registrar</a>
                    </div>
                    <div class=\"col s8 right-align\">
                        <a href=\"";
        // line 42
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "passwordRescue\" class=\"btn red\">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Pages/Login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 42,  94 => 39,  65 => 13,  60 => 11,  56 => 9,  50 => 7,  48 => 6,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("    {# View criada em '.07-11-19 - 23:31:pm.' Via Scooby_CLI #}
<div class=\"bg-login\">
    <div class=\"container-fluid z-depth-5\" style=\"margin:3% 10% !important; padding:0; background-color: #ddd !important\">
    <a href=\"{{ base_url }}back\" class=\"btn black\">voltar</a>
        <h2 class=\"center\">ScoobYTasks - Login</h2>
        {% if msg %}
        <span class=\"alert\"> {{ msg|raw }} </span>
        {% endif %}
        <div class=\"row\">
            <div class=\"col s12 m8 offset-m2\">
                <form class=\"login-form  z-depth-5\" method=\"post\" action=\"{{ base_url }}user/login\">
                    <div class=\"card\">
                        <input type=\"hidden\" name=\"csrfToken\" value=\"{{ csrfToken }}\">
                        <div class=\"card-content\">
                            <div class=\"input-field\">
                                <input class=\"validate\" id=\"email\" type=\"email\" name=\"email\">
                                <label for=\"email\">Email</label>
                            </div>
                            <div class=\"row\">
                                <div class=\"col s12 m12 l12\">
                                    <div class=\"input-field\">
                                        <input id=\"password\" type=\"password\" name=\"pass\">
                                        <label for=\"password\">Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-action\">
                            <div class=\"center-align\">
                                <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Entrar
                                    <i class=\"material-icons right\">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class=\"row\">
                    <div class=\"col s4\">
                        <a href=\"{{ base_url }}register\" class=\"btn purple\">Registrar</a>
                    </div>
                    <div class=\"col s8 right-align\">
                        <a href=\"{{ base_url }}passwordRescue\" class=\"btn red\">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>", "Pages/Login.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/Login.twig");
    }
}
