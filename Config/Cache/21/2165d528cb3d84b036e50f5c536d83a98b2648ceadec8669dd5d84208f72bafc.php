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

/* Pages/Register.twig */
class __TwigTemplate_975d0f03ed3f60976e8ee83666ae07b1221ed4161e0717a43b1bd9a35e9f84d5 extends \Twig\Template
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
        // line 2
        echo "<div class=\"container-fluid bg-login\">
    <h3 class=\"center\">ScoobYTasks - Novo Usuário</h3>
    ";
        // line 4
        if (($context["msg"] ?? null)) {
            // line 5
            echo "    <span class=\"alert center\">";
            echo ($context["msg"] ?? null);
            echo "</span>
    ";
        }
        // line 7
        echo "    <div class=\"row\">
        <div class=\"col s12 m8 offset-m2\">
            <form class=\"login-form  z-depth-5\" method=\"post\" action=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "user/saveUser\">
                <div class=\"card\">
                    <input type=\"hidden\" name=\"csrfToken\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["csrfToken"] ?? null), "html", null, true);
        echo "\">
                    <div class=\"card-content\">
                        <div class=\"input-field\">
                            <input class=\"validate\" id=\"name\" type=\"text\" name=\"name\">
                            <label for=\"name\">Nome</label>
                        </div>
                        <div class=\"input-field\">
                            <input class=\"validate\" id=\"email\" type=\"email\" name=\"email\">
                            <label for=\"email\">Email</label>
                        </div>

                        <div class=\"row\">
                            <div class=\"col s12 m8 l12\">
                                <div class=\"input-field\">
                                    <input id=\"password\" type=\"password\" name=\"pass\">
                                    <label for=\"password\">Senha</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"card-action\">
                        <div class=\"center-align\">
                            <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Criar Conta
                                <i class=\"material-icons right\">send</i>
                            </button> </div>
                    </div>
                </div>
            </form>
            <div class=\"row\">
                <div class=\"col s4\">
                    <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "user/index\" class=\"btn purple\">Login</a>
                </div>
                <div class=\"col s8 right-align\">
                    <a href=\"#\" class=\"btn red\">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Pages/Register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 41,  58 => 11,  53 => 9,  49 => 7,  43 => 5,  41 => 4,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# View criada em '.05-11-19 - 22:21:pm.' Via Scooby_CLI #}
<div class=\"container-fluid bg-login\">
    <h3 class=\"center\">ScoobYTasks - Novo Usuário</h3>
    {% if msg %}
    <span class=\"alert center\">{{ msg|raw }}</span>
    {% endif %}
    <div class=\"row\">
        <div class=\"col s12 m8 offset-m2\">
            <form class=\"login-form  z-depth-5\" method=\"post\" action=\"{{ base_url }}user/saveUser\">
                <div class=\"card\">
                    <input type=\"hidden\" name=\"csrfToken\" value=\"{{ csrfToken }}\">
                    <div class=\"card-content\">
                        <div class=\"input-field\">
                            <input class=\"validate\" id=\"name\" type=\"text\" name=\"name\">
                            <label for=\"name\">Nome</label>
                        </div>
                        <div class=\"input-field\">
                            <input class=\"validate\" id=\"email\" type=\"email\" name=\"email\">
                            <label for=\"email\">Email</label>
                        </div>

                        <div class=\"row\">
                            <div class=\"col s12 m8 l12\">
                                <div class=\"input-field\">
                                    <input id=\"password\" type=\"password\" name=\"pass\">
                                    <label for=\"password\">Senha</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"card-action\">
                        <div class=\"center-align\">
                            <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Criar Conta
                                <i class=\"material-icons right\">send</i>
                            </button> </div>
                    </div>
                </div>
            </form>
            <div class=\"row\">
                <div class=\"col s4\">
                    <a href=\"{{ base_url }}user/index\" class=\"btn purple\">Login</a>
                </div>
                <div class=\"col s8 right-align\">
                    <a href=\"#\" class=\"btn red\">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
</div>", "Pages/Register.twig", "/opt/lampp/htdocs/ScoobyPHP/App/Views/Pages/Register.twig");
    }
}
