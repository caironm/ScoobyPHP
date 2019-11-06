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
class __TwigTemplate_2af06decd4315589830c608fd9ced0eb11d2ba8de84d2f04c52347a98b758ed9 extends \Twig\Template
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
    <div class=\"container-fluid\">
        <h2 class=\"center white-text\">ScoobYTasks - Login</h2>
        ";
        // line 5
        if (($context["msg"] ?? null)) {
            // line 6
            echo "        <span class=\"alert\"> ";
            echo ($context["msg"] ?? null);
            echo " </span>
        ";
        }
        // line 8
        echo "        <div class=\"row\">
            <div class=\"col s12 m8 offset-m2\">
                <form class=\"login-form\" method=\"post\" action=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "user/login\">
                    <div class=\"card\">
                        <input type=\"hidden\" name=\"csrfToken\" value=\"";
        // line 12
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
        // line 38
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "user/register\" class=\"btn purple\">Registrar</a>
                    </div>
                    <div class=\"col s8 right-align\">
                        <a href=\"#\" class=\"btn red\">Esqueci a senha</a>
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
        return array (  90 => 38,  61 => 12,  56 => 10,  52 => 8,  46 => 6,  44 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("    {# View criada em '.05-11-19 - 22:21:pm.' Via Scooby_CLI #}
<div class=\"bg-login\">
    <div class=\"container-fluid\">
        <h2 class=\"center white-text\">ScoobYTasks - Login</h2>
        {% if msg %}
        <span class=\"alert\"> {{ msg|raw }} </span>
        {% endif %}
        <div class=\"row\">
            <div class=\"col s12 m8 offset-m2\">
                <form class=\"login-form\" method=\"post\" action=\"{{ base_url }}user/login\">
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
                        <a href=\"{{ base_url }}user/register\" class=\"btn purple\">Registrar</a>
                    </div>
                    <div class=\"col s8 right-align\">
                        <a href=\"#\" class=\"btn red\">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>", "Pages/Login.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/Login.twig");
    }
}
