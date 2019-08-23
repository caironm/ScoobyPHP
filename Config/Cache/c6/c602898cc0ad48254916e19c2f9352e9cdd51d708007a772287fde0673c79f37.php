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

/* Pages/Failure.twig */
class __TwigTemplate_e38ecb6adee0ede0a6bd765fec44b566965500e5d01c1e2583822e2a3b3c5779 extends \Twig\Template
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
        echo " <script>
 Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href>Why do I have this issue?</a>'
}).then(function (result) {
    if (result.value) {
        window.location = \"home\";
    }
})
  </script>
";
    }

    public function getTemplateName()
    {
        return "Pages/Failure.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source(" <script>
 Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href>Why do I have this issue?</a>'
}).then(function (result) {
    if (result.value) {
        window.location = \"home\";
    }
})
  </script>
", "Pages/Failure.twig", "/opt/lampp/htdocs/Scooby-3.0/App/Views/Pages/Failure.twig");
    }
}
