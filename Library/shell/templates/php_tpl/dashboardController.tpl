<?php
//Controller gerado automaticamente via - Scooby-CLI em dateNow

namespace Controllers;

namespace Controllers;

use \Core\Controller;
use \Models\User;
use \Helpers\Redirect;
use \Helpers\FlashMessage;
use \Helpers\Login;
use \Helpers\Session;
use \Helpers\Request;


class DashboardController extends Controller
{
   public function index(): void
   {
        FlashMessage::getFlashMessage('error');
    	$this->Load("Pages", "DashBoard", []);
   }

    /**
     * Faz o logout do usuario
     *
     * @return void
     */
    public function exit(): void
    {
        Login::sessionLoginDestroyWithRedirect("login");
    }

     /**
     * Deleta o usuario logado
     *
     * @param integer $id
     * @return void
     */
    public function deleteUser(): void
    {
        $id = $_SESSION['id'];
        $user = new User;
        $u = $user->find($id);
        $u->delete();
        Redirect::redirectTo('login');
    }
/**
     * Busca as informações dos usuario e chama a view de edição
     *
     * @return void
     */
    public function alterUser(): void
    {
        $id = Session::getSession('id');
        $user = new User;
        $u = $user->find($id);
        if ($u == null) {
            $this->Load('pages', 'Dashboard', [
                'msg' => FlashMessage::toast('Error:', SOMETHING_WRONG, 'error')
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
    public function updateUser(): void
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
            FlashMessage::flashMessage('error', 'Ok...', UPDATE_DATA_SUCCESS, 'success', 'dashboard');
            exit;
        }if (empty($name)) {
            $u->password = Login::passwordHash($password);
            $u->email = $email;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', UPDATE_DATA_SUCCESS, 'success', 'dashboard');
            exit;
        }elseif (empty($email)) {
            $u->name = $name;
            $u->password = Login::passwordHash($password);
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', UPDATE_DATA_SUCCESS, 'success', 'dashboard');
            exit;
        }elseif (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', UPDATE_DATA_SUCCESS, 'success', 'dashboard');
            exit;
        }
        $u->name = $name;
        $u->email = $email;
        $u->password = Login::passwordHash($password);
        $u->save();
        FlashMessage::flashMessage('error', 'Ok...', UPDATE_DATA_SUCCESS, 'success', 'dashboard');
        exit;
    }
}
