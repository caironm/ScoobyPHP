<?php

namespace Scooby\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as db;

class Login
{

    /**
     * Gera a sessão de logado do usuario
     *
     * @param string $id
     * @param string $email
     * @return void
     */
    private static function sessionLoginGenerate(int $id, string $email, string $name, $time = null): void
    {
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['logedIn'] = $time;
        $_SESSION['statusLog'] = true;
    }

    /**
     * Destroi a sessão atual do usuaio
     *
     * @return void
     */
    public static function sessionLoginDestroy(): void
    {
        $_SESSION['id'] = "";
        $_SESSION['email'] = "";
        $_SESSION['name'] = "";
        $_SESSION['logedIn'] = null;
        $_SESSION['statusLog'] = false;
    }

    /**
     * Destroy a sessão logada e redireciona o usuario
     *
     * @param string $viewName
     * @return void
     */
    public static function sessionLoginDestroyWithRedirect(string $viewName = HOME)
    {
        $_SESSION['id'] = "";
        $_SESSION['email'] = "";
        $_SESSION['name'] = "";
        $_SESSION['logedIn'] = null;
        $_SESSION['statusLog'] = false;
        Redirect::redirectTo($viewName);
    }

    /**
     * Criptografa a senha do usuario
     *
     * @param string $pass
     * @return string
     */
    public static function passwordHash($pass): string
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }


    /**
     * Testa se o email cadastrado existe no banco de dados
     *
     * @param string $email
     * @param string $pass
     * @return bool
     */
    public static function loginValidate($email, $pass, $table = 'users', $emailField = 'email', $passwordField = 'password', $idField = 'id', $nameField = 'name'): bool
    {
        $helper = new Helper;
        if (Csrf::csrfTokenValidate() === true) {
            $helper->illuminateDb();
            $storageEmail = DB::table($table)->where($emailField, $email)->value($emailField);
            if ($storageEmail == $email) {
                $storagePass = DB::table($table)->where($emailField, $email)->value($passwordField);
                if (password_verify($pass, $storagePass)) {
                    $id = DB::table($table)->where($emailField, $email)->value($idField);
                    $name = DB::table($table)->where($emailField, $email)->value($nameField);
                    $time = Carbon::now();
                    self::sessionLoginGenerate($id, $storageEmail, $name, $time);
                    return true;
                } else {
                    self::sessionLoginDestroy();
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Retorna as informações do usuário logado
     *
     * @param string $info
     * @return string
     */
    public static function userInfo(string $info = 'userId'): ?string
    {
        Auth::authValidOrFail();
        if (!class_exists('User')) {
            $user = Models\User::find($_SESSION['id']);
            return null;
        }
        $arr = [
            'userName' => $user->name,
            'userId' => $_SESSION['id'],
            'userEmail' => $user->email,
            'logedIn' => $_SESSION['logedIn']
        ];
        return $arr[$info];
    }

    /**
     * Caso o susario esteja logado ele sera redirecionado para a tela de dashboad
     * não acessando mais a tela de login
     *
     * @return void
     */
    public static function isLogedRedirect(): void
    {
        if (Auth::authValidation()) {
            Redirect::redirectTo('dashboard');
        }
    }
}
