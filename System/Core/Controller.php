<?php

namespace Scooby\Core;

use Scooby\Helpers\Auth;
use Scooby\Helpers\Redirect;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

abstract class Controller
{
    protected $ViewData = [];

    /**
     * Analisa e carrega os templates logado e deslogado
     *
     * @param string $ViewPath
     * @param string $ViewName
     * @param array $ViewData
     * @return void
     */
    public function view(string $viewPath, string $ViewName, array $ViewData = [])
    {
        $autentication = [];
        $notAutentication = [];
        $changeTemplate = [];
        $changeAuthTemplate = [];
        include "App/Config/authConfig.php";
        $loader = new FilesystemLoader('App/Views');
        $debug = false;
        if (ENV == 'development') {
            $debug = true;
        }
        $twig = new Environment($loader, [
            'debug' => $debug,
            'cache' => 'System/SysConfig/Cache'
        ]);
        $twig->addGlobal('csrfToken', $_SESSION['csrfToken']);
        $twig->addGlobal('base_url', BASE_URL);
        $twig->addGlobal('assets', ASSET);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('upload', "Public/uploaded/");
        $twig->addGlobal('method_put', '<input type="hidden" name="_method" value="PUT">');
        $twig->addGlobal('method_delete', '<input type="hidden" name="_method" value="DELETE">');
        $twig->addGlobal('method_patch', '<input type="hidden" name="_method" value="PATCH">');
        require_once 'App/Config/twigGlobalVariables.php';
        $ViewName = ucwords($ViewName);
        if (in_array($ViewName, $notAutentication) === true or in_array(strtolower($ViewName), $notAutentication) === true) {
            require_once 'System/Html/Templates/Header.php';
            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);
            require_once 'System/Html/Templates/Footer.php';
        } elseif (in_array($ViewName, $autentication) === true or in_array(strtolower($ViewName), $autentication) === true) {
            if (Auth::authValidOrFail()) {
                require_once 'System/Html/Templates/Header.php';
                $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
                extract($ViewData);
                echo $template->render($ViewData);
                require_once 'System/Html/Templates/Footer.php';
            } else {
                Redirect::redirectTo('login');
            }
        } elseif (in_array($ViewName, $changeTemplate) === true or in_array(strtolower($ViewName), $changeTemplate) === true) {
            require_once 'System/Html/Templates/'.ucfirst($ViewName).'Header.php';
            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);
            require_once 'System/Html/Templates/'.ucfirst($ViewName).'Footer.php';
        } else if (in_array($ViewName, $changeAuthTemplate) === true or in_array(strtolower($ViewName), $changeAuthTemplate) === true) {
            Auth::authValidOrFail();
            require_once 'System/Html/Templates/'.ucfirst($ViewName).'Header.php';
            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);
            require_once 'System/Html/Templates/'.ucfirst($ViewName).'Footer.php';
        } else {
            $this->view('error', '404');
        }
    }

    /**
     * Seta um title para a view carregada
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title = ''): void
    {
        if (!empty($title)) {
            $_SESSION['pageTitle'] = $title;
        }
    }
}
