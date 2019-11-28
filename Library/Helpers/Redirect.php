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
     * Redireciona passando uma msg via url
     *
     * @param string $url
     * @param string $msg
     * @return void
     */
    public static function redirectWithMessage($url, $msg)
    {
        $msg = base64_encode($msg);
        header("Location:$url?msg=$msg");
    }

    /**
     * Exibe a menssagem passada pela url
     *
     * @param string $msg
     * @return void
     */
    public static function getUrlError(string $msg)
    {
        FlashMessage::toast('Erro:', base64_decode($msg), 'error');
    } 
}
