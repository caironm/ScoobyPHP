<?php

namespace Core;

class Core
{
    /**
     * Inicia a aplicação
     *
     * @return void
     */
    public function run()
    {
        $url= '/';
        $parans = [];

        if(isset($_GET['url'])){
            $url .= $_GET['url'];
        }

        if(!empty($url) and $url != '/'){
            $url = explode('/', $url);
            array_shift($url);
            $currentController = $url[0]."Controller";
            array_shift($url);

            if(isset($url) and !empty($url)){
                $currentAction = $url[0];
                array_shift($url);
            }else{
                $currentAction = 'index';
            }

            if(count($url) > 0){
                $parans = $url;
            }
        }else{
            $currentController = ucfirst(HOME)."Controller";
            $currentAction = "index";
        }

        $currentController = ucfirst($currentController);

        $prefix = '\Controllers\\';

        if(empty($currentAction)){
            $currentAction = 'index';
        }
        
        if (file_exists('Controllers/'.$currentController.'.php') or 
        !method_exists($prefix.$currentController, $currentAction)) {
            $currentController = 'NotfoundController';
            $currentAction = 'index';
        }

        $newController = $prefix.$currentController;

        $controller = new $newController();
        call_user_func_array([$controller, $currentAction], $parans);
    }

}
