<?php

namespace Core;

use Helpers\Helper;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Controller
{
    protected $ViewData = [];

    /**
     * Retorna view
     *
     * @param string $ViewPath
     * @param string $ViewName
     * @param array $ViewData
     * @return void
     */
    public function View(string $viewPath, string $ViewName, array $ViewData = [])
    {
        require_once 'App/Views/Templates/Template.twig';
        extract($ViewData);
        require_once "App/Views/".ucfirst($viewPath)."/".ucfirst($ViewName).".twig";
    }

    /**
     * Analisa e carrega os templates logado e deslogado
     *
     * @param string $ViewPath
     * @param string $ViewName
     * @param array $ViewData
     * @return void
     */
    public function Load(string $viewPath, string $ViewName, array $ViewData = [])
    {
        $helper = new Helper;
        include "Config/authConfig.php";
        $loader = new FilesystemLoader('App/Views');
        $twig = new Environment($loader, [
            'debug' => true,
            'cache' => 'Config/Cache'
        ]);

        if (in_array($ViewName, $notAutentication) === true or in_array(strtolower($ViewName), $notAutentication) === true) {

            require_once 'App/Views/Templates/Header.twig';

            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);

            require_once 'App/Views/Templates/Footer.twig';

        } elseif (in_array($ViewName, $autentication) === true or in_array(strtolower($ViewName), $autentication) === true) {
            
            $auth = $helper->auth();
            require_once 'App/Views/Templates/Header.twig';

            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);

            require_once 'App/Views/Templates/Footer.twig';

        } elseif (in_array($ViewName, $changeTemplate) === true or in_array(strtolower($ViewName), $changeTemplate) === true) {
            
            require_once 'App/Views/Templates/' . ucfirst($ViewName) . 'Header.twig';
           
            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);
            
            require_once 'App/Views/Templates/' . ucfirst($ViewName) . 'Footer.twig';
        
        } elseif (in_array($ViewName, $changeAuthTemplate) === true or in_array(strtolower($ViewName), $changeAuthTemplate) === true) {
           
            $auth = $helper->auth();
            require_once 'App/Views/Templates' . ucfirst($ViewName) . 'Header.twig';
           
            $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
            extract($ViewData);
            echo $template->render($ViewData);
            
            require_once 'App/Views/Templates/' . ucfirst($ViewName) . 'Footer.twig';
        
        } else {
            $this->Load('error', '404');
        }
    }
}
