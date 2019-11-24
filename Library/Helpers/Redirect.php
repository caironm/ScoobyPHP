<?php 

namespace Helpers;

class Redirect
{

    /**
     * Executa um redirecionamento para a url indicada
     *
     * @param string $url
     * @return void
     */
    public static function redirectTo(string $url)
    {
        return header("Location:".BASE_URL."$url");
    }

    /**
     * Retorna a quantidade de paginas informada no metodo
     * caso não seja informado um valor, retorna para a pagina anterior 
     *
     * @param integer $value
     * @return void
     */
    public static function redirectBack(int $value = -1)
    {
        echo "<script>window.history.go($value)</script>"; 
    }

    /**
     * Redireciona passando parametros para a view
     *
     * @param string $viewPath
     * @param string $ViewName
     * @param array $ViewData
     * @return void
     */
    public static function redirectWithParameters(string $back = null, string $ViewName, array $ViewData = [])
    {
        if($back == 'back' and isset($_SESSION['ACTION_PREVIOUS'])){
            $previousRoute = $_SESSION['ACTION_PREVIOUS'];
            $ViewName = $previousRoute;
        }elseif($back == null or $back != 'back'){
            $ViewName = $ViewName;
        }elseif(!isset($previousRoute)){
            $ViewName = $ViewName;
        }
        $loader = new \Twig\Loader\FilesystemLoader('App/Views');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => 'Config/Cache'
        ]);
        $template = $twig->load('Pages/' . ucfirst($ViewName) . '.twig');
        require_once 'App/Views/Templates/Header.twig';
        extract($ViewData);
        require_once 'App/Views/Templates/Footer.twig';
        echo $template->render($ViewData);
    }
}
