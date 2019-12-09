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

/* create.html.twig */
class __TwigTemplate_ad42b82de468abb5f8e5f7b2080f7389601ae1a7dd69cd308c259a19ac643e96 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("index.html.twig", "create.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "<form method=\"POST\" action=\"/create\">
  <div class=\"form-group\">
    <label for=\"tanggal\">Tanggal</label>
    <input type=\"date\" class=\"form-control\" id=\"tanggal\" name=\"tanggal\" value=";
        // line 7
        echo twig_escape_filter($this->env, ($context["default_date"] ?? null), "html", null, true);
        echo ">
  </div>
  <div class=\"form-group\">
    <label for=\"berat-max\">Berat Maksimal</label>
    <input type=\"text\" class=\"form-control\" id=\"berat-max\" name=\"berat-max\">
  </div>
  <div class=\"form-group\">
    <label for=\"berat-min\">Berat Minimal</label>
    <input type=\"text\" class=\"form-control\" id=\"berat-min\" name=\"berat-min\">
  </div>
  <input type=\"submit\" name=\"simpan\" value=\"Simpan\" class=\"btn btn-primary\" />
</form>
";
    }

    public function getTemplateName()
    {
        return "create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 7,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "create.html.twig", "/Users/tempest/work/sirclo-test/berat/resources/views/create.html.twig");
    }
}
