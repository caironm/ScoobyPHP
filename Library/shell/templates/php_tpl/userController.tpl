<?php

//Controller de autenticação gerado automaticamente via Scooby-CLI dateNow

namespace Controllers;

use \Core\Controller;
use Helpers\FlashMessage;
use Helpers\Login;
use Helpers\Redirect;
use Helpers\Request;
use Helpers\Validation;
use Models\User;

class UserController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index()
    {
        $this->Load("pages", "login");
    }

    /**
     * Recupera os valores de login digitados pelo usuario e efetua o login
     *
     * @return void
     */
    public function login()
    {
            $email =  Request::input("email");
            $pass =  Request::input("pass");
            if (Login::loginValidate($email, $pass, "users", "email", "password", "id")) {
                $this->Load("pages", "DashBoard");
            } else {
                $this->Load("pages", "login", [
                    "msg" => FlashMessage::msg("Opss", "Falha na autenticação, por favor tente novamente.", "error")
                ]);
            }
    }

    /**
     * Carrega a view de cadastro de usuario
     *
     * @return void
     */
    public function register()
    {
        $this->Load("pages", "register");
    }

    /**
     * Adiciona um novo usuario no banco de dados
     *
     * @return void
     */
    public function saveUser()
    {   
            $name = Request::input("name");
            $email = Request::input("email");
            $pass = Login::passwordHash(Request::input("pass"));
            if (Validation::emailMatch($email, "users", "email")) {
                $user = new User;
                $user->name = $name;
                $user->email= $email;
                $user->password = $pass; 
                if ($user->save()) {
                    $this->Load("pages", "login", [
                        "msg" => FlashMessage::msg("Tudo Certo...", "Usuário cadastrado com sucesso.", "success")
                    ]);
                } else {
                    $this->Load("pages", "Register", [
                        "msg" => FlashMessage::msg("Opss...", "Algo saiu errado, por favor tente mais tarde.", "error")
                    ]);
                }
            } else {
                $this->Load("pages", "register", [
                    "msg" => FlashMessage::msg("Opss...", "Email já cadastrado, por favor tente com um email diferente", "warning")
                ]);
            }
    }

    /**
     * Faz o logout do usuario
     *
     * @return void
     */
    public function exit()
    {
        Login::sessionLoginDestroyWithRedirect("login");
    }

    /**
     * Chama a view de recuperação de usuário
     *
     * @return void
     */
    public function passwordrescue()
    {
        $this->Load("pages", "PasswordRescue");
    }

    /**
     * Executa a lógica de recuperação de senha do usuário
     *
     * @return void
     */
    public function newPass()
    {
        //$email = Request::input("email");
    }
}