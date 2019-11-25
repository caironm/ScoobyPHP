<?php

//Controller de autenticação gerado automaticamente via Scooby-CLI em dateNow

namespace Controllers;

use \Core\Controller;
use Helpers\Email;
use Helpers\FlashMessage;
use Helpers\Login;
use Helpers\Redirect;
use Helpers\Request;
use Helpers\Session;
use Helpers\Validation;
use Models\PasswordUserToken;
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
            Redirect::redirectTo('dashboard');
        } else {
            $this->Load("pages", "login", [
                "msg" => FlashMessage::toast("Opss", "Falha na autenticação, por favor tente novamente.", "error")
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
        $msg = null;
        if(!empty($_GET['msg'])){
            $msg = $_GET['msg'];
            Redirect::getUrlError($msg);
        }
        $this->Load("pages", "register", ['error' => $msg]);
    }

    /**
     * Adiciona um novo usuario no banco de dados
     *
     * @return void
     */
    public function saveUser()
    {
        Request::validate('name', ['required', 'string', 'max'], 'nome', 60);
        Request::validate('email', ['required', 'email'], 'email');
        Request::validate('pass', ['required', 'string', 'min'], 'senha', 4);
        if (Request::input("name") and Request::input("email") and Request::input("pass")) {
            $name = Request::input("name");
            $email = Request::input("email");
            $pass = Login::passwordHash(Request::input("pass"));
            if (Validation::emailMatch($email, "users", "email")) {
                $user = new User;
                $user->name = $name;
                $user->email = $email;
                $user->password = $pass;
                if ($user->save()) {
                    $this->Load("pages", "Login", [
                        "msg" => FlashMessage::toast("Tudo Certo...", "Usuário cadastrado com sucesso.", "success")
                    ]);
                } 
            } elseif (Validation::emailMatch($email, "users", "email") === false and !empty($email)) {
                $this->Load("pages", 'Register', [
                    "msg" => FlashMessage::toast("Opss...", "Email já cadastrado, por favor tente com um email diferente", "warning")
                ]);
            }
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
     * e envia o email
     *
     * @return void
     */
    public function newPass()
    {
        if (empty(Request::input("email"))) {
            $this->Load('pages', 'PasswordRescue', [
                'msg' => FlashMessage::toast('Opss...', 'O campo de email é obrigatório!', 'warning')
            ]);
            exit;
        }
        $email = Request::input("email");
        $token = md5(rand(999, 999999));
        $user = new User;
        $u = $user->where('email', $email)->first();
        if ($u != null) {
            $newPass = new PasswordUserToken;
            $newPass->user_id = $u->id;
            $newPass->token = $token;
            $newPass->used = 0;
            $newPass->save();

            $msg = <<<HTML
                <h3>Recuperação de senha</h3>
                <p>Este é o link para você efetuar a recuperação de senha do <strong>ScoobyPHP</strong></p>
                <p>127.0.0.1/App/create-password?token=$token</p>
                <a href="create-password?token=$token">Clique aqui para redefinir sua senha</a>
HTML;
            $send = Email::sendEmailWithSmtp('ScoobyPHP', $msg, ['viniterriani.vt@gmail.com' => 'ScoobyTem'], [$email => $u->name]);
            if ($send) {
                $this->Load('Pages', 'login', [
                    'msg' => FlashMessage::toast('Ok', 'Email para confirmação enviado com sucesso', 'success')

                ]);
            } else {
                FlashMessage::toast('Opss...', 'Algo saiu errado, Email não enviado', 'error');
            }
        } else {
            $this->Load('pages', 'PasswordRescue', [
                'msg' => FlashMessage::toast('Opss...', 'Emeil não encontrado em nossa base de dados, por favor tente novamente com um emial diferente', 'error')
            ]);
        }
    }

    /**
     * Valida o token pasado por url e chama a view de redefinição de senha
     *
     * @return void
     */
    public function saveNewPassword()
    {
        $token = $_GET['token'];
        $_SESSION['token'] = $token;
        $newPass = new PasswordUserToken;
        $p = $newPass->where('token', $token)->first();
        if (empty($_GET['token'])) {
            $this->Load('pages', 'PasswordRescue', [
                'msg' => FlashMessage::toast('Erro...', 'Token Inválido', 'error')
            ]);
            exit;
        }
        if ($p != null and $p->used == 0) {
            $this->Load('pages', 'NewPassword', ['token' => $token]);
        } else {
            $this->Load('pages', 'PasswordRescue', [
                'msg' => FlashMessage::toast('Erro...', 'Link Inválido', 'error')
            ]);
            exit;
        }
    }

    /**
     * Executa a redefinição de senha e invalida o token usado
     *
     * @return void
     */
    public function passwordReset()
    {
        $token = $_POST['passwordToken'];
        if (empty($_POST['new-password']) and empty($_POST['confirm-password'])) {
            $this->Load('pages', 'NewPassword', [
                'msg' => FlashMessage::toast('Opss...', 'Os campos são obrigatórios', 'warning')
            ]);
            exit;
        } elseif ($_POST['new-password'] != $_POST['confirm-password']) {
            $this->Load('pages', 'NewPassword', [
                'msg' => FlashMessage::toast('Opss...', 'As senhas não batem', 'warning')
            ]);
            exit;
        }
        $newPass = new PasswordUserToken;
        $p = $newPass->where('token', $token)->first();
        $p->used = 1;
        $p->save();
        $user = new User;
        $id = $p->user_id;
        $u = $user->where('id', $id)->update(['password' => Login::passwordHash($_POST['new-password'])]);
        if ($u and $p) {
            $this->Load('pages', 'login', [
                'msg' => FlashMessage::toast('Tudo Certo...', 'Senha alterada com sucesso', 'success')
            ]);
        }
    }

    /**
     * Faz o redirecionamento para a área logada do sistema
     *
     * @return void
     */
    public function loged()
    {
        $this->Load('pages', 'DashBoard');
    }

    /**
     * Deleta o usuario logado
     *
     * @param integer $id
     * @return void
     */
    public function deleteUser()
    {
        $id = $_SESSION['id'];
        $user = new User;
        $u = $user->find($id);
        $u->delete();
        return Redirect::redirectTo('login');
    }

    /**
     * Busca as informações dos usuario e chama a view de edição
     *
     * @return void
     */
    public function alterUser()
    {
        $id = Session::getSession('id');
        $user = new User;
        $u = $user->find($id);
        if ($u == null) {
            $this->Load('pages', 'Dashboard', [
                'msg' => FlashMessage::toast('Error:', 'Algo saiu errado, por favor tente novante', 'error')
            ]);
            exit;
        }
        $this->Load('pages', 'UpdateUser', [
            'name' => $u->name,
            'email' => $u->email
        ]);
    }

    /**
     * Atualiza as informações do usuario
     *
     * @return void
     */
    public function updateUser()
    {
        $id = Session::getSession('id');
        $name = Request::post('name');
        $email = Request::post('email');
        $password = Request::post('pass');
        $user =  new User;
        $u = $user->find($id);
        if (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->save();
            FlashMessage::modalWithHref('Ok...', 'Usuário alterado com sucesso', 'success', 'dashboard');
            exit;
        }if (empty($name)) {
            $u->password = Login::passwordHash($password);
            $u->email = $email;
            $u->save();
            FlashMessage::modalWithHref('Ok...', '123Usuário alterado com sucesso', 'success', 'dashboard');
            exit;
        }elseif (empty($email)) {
            $u->name = $name;
            $u->password = Login::passwordHash($password);
            $u->save();
            FlashMessage::modalWithHref('Ok...', 'Usuário alterado com sucesso', 'success', 'dashboard');
            exit;
        }elseif (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->save();
            FlashMessage::modalWithHref('Ok...', 'Usuário alterado com sucesso', 'success', 'dashboard');
            exit;
        }
        $u->name = $name;
        $u->email = $email;
        $u->password = Login::passwordHash($password);
        $u->save();
        FlashMessage::modalWithHref('Ok...', 'Usuário alterado com sucesso', 'success', 'dashboard');
        exit;
    }
}
