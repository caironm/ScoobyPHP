<?php

namespace Helpers;

class Login
{

    /**
     * Gera a sessão de logado do usuario
     *
     * @param string $id
     * @param string $email
     * @return void
     */
    private static function sessionLoginGenerate(int $id, string $email)
    {
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['statusLog'] = true;
    }

    /**
     * Destroi a sessão atual do usuaio
     *
     * @return void
     */
    public static function sessionLoginDestroy()
    {
        $_SESSION['id'] = "";
        $_SESSION['email'] = "";
        $_SESSION['statusLog'] = false;
        
        return Redirect::redirectTo('Home');
    }

    /**
     * Criptografa a senha do usuario
     *
     * @param string $pass
     * @return void
     */
    public static function passwordHash(string $pass)
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }


    /**
     * Testa se o email cadastrado existe no banco de dados
     *
     * @param string $email
     * @param string $pass
     * @return void
     */
    public static function loginValidate(string $email, string $pass)
    {
        $helper = new Helper;
        if (Csrf::csrfTokenValidate() === true) {
            $db = $helper->pdoDb();
            $sql = "SELECT * from users WHERE email = ?";
            $stmt = $db->dbConnection()->prepare($sql);
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $storage = $stmt->fetch();
                if ($storage['email'] == $email) {
                    $storagePass = $storage['pass'];
                    if (password_verify($pass, $storagePass)) {
                        self::sessionLoginGenerate($storage['id'], $storage['email']);
                        return true;
                    } else {
                        self::sessionLoginDestroy();
                    }
                } else {
                    return false;
                }
            } else {
                Redirect::redirectTo('home');
                return false;
            }
        } else {
            Redirect::redirectTo('failure');
            return false;
        }
    }
}
