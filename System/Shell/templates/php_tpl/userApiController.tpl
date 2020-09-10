<?php

//Controller de autenticação gerado automaticamente via Scooby-CLI em dateNow

namespace Scooby\Controllers;

use Scooby\Helpers\Jwt;
use Scooby\Helpers\Login;
use Scooby\Helpers\Request;
use Scooby\Helpers\Validation;
use Scooby\Models\PasswordUserToken;
use Scooby\Models\User;

class UserApiController extends Controller
{
    /**
     * Registra um novo usuario
     *
     * @return void
     */
    public function register(): void
    {
        $data = Request::getRequestData();
        if (!Validation::emailMatch($data->email, 'users', 'email')) {
            $this->Json(['data' => 'Email já cadastrado, por favor tente com um email diferente']);
        }
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Login::passwordHash($data->pass);
        $user->save();
        $this->Json(['data' => 'Usuário salvo com sucesso']);
    }

    /**
     * Efetua o login
     *
     * @return void
     */
    public function login(): void
    {
        $data = Request::getRequestData();
        if (Login::loginValidate($data->email, $data->pass)) {
            $token = Jwt::jwtCreate(['id' => $_SESSION['id'], 'email' => $data->email]);
            Jwt::jwtRefresh($token);
            $this->Json(['data' => $token]);
        } else {
            $this->Json(['data' => 'Usuário ou senha incorretos']);
        }
    }

    /**
     * Deleta usuario
     *
     * @return void
     */
    public function delete(): void
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $data = Jwt::jwtPayloadDecode(Jwt::jwtGetToken());
        $user = User::find($data->id);
        if ($user->delete()) {
            Jwt::jwtExpire(Jwt::jwtGetToken());
            $this->Json(['data' => 'Usuário deletado com sucesso']);
        }
        $this->Json(['data' => 'Falha ao deletar usuário']);
    }

    /**
     * Executa o logout do usuário
     *
     * @return void
     */
    public function logout(): void
    {
       Jwt::jwtValidate(Jwt::jwtGetToken());
       Jwt::jwtExpire(Jwt::jwtGetToken());
       $this->Json(['data' => 'Usuário deslogado com sucesso']);
    }

    /**
     * Retorna os dados do usuario
     *
     * @return void
     */
    public function update(): void
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;
        $user = new User;
        $u = $user->find($id);
        if ($u == null) {
            $this->Json(['data' => $GLOBALS['SOMETHING_WRONG']]);
        }
        $this->Json([
            'name' => $u->name,
            'email' => $u->email
        ]);
    }

    /**
     * Altera o usuario logado no sistema
     *
     * @return void
     */
    public function alter(): void
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $data = Request::getRequestData();
        $user = new User;
        $u = $user->find(Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id);
        if (empty($data->name)) {
            $data->name = $u->name;
        }
        if (empty($data->email)) {
            $data->email = $u->email;
        }
        if (empty($data->pass)) {
            $data->pass = $u->password;
        }
        $u->name = $data->name;
        $u->email = $data->email;
        $u->password = $data->pass;
        if (!$u->save()) {
            $this->Json(['data' => $GLOBALS['SOMETHING_WRONG']]);
        }
        $this->json(['data' => $GLOBALS['UPDATE_DATA_SUCCESS']]);
    }

    public function passwordRescue ()
    {
        $data = Request::getRequestData();
        $email = $data->email;
        $token = $data->token;
        if (Validation::emailMatch($email, 'users', 'email')) {
            $this->Json([
                'status' => false,
                'data' => 'Email Não existente em nossa base de dados'
            ]);
        }
        $user = new User;
        $u = $user->where('email', $email)->first();
        $newPass = new PasswordUserToken;
        $newPass->user_id = $u->id;
        $newPass->token = $token;
        $newPass->used = 0;
        $newPass->save();
        $this->Json([
            'status' => true,
            'UserName' => $u->name
        ]);
    }

    public function tokenValidate()
    {
        $data = Request::getRequestData();
        $token = $data->token;
        $tokenUsed = new PasswordUserToken;
        $used = $tokenUsed->where('token', $token)->first();
        if ($used->used != 0) {
            $this->Json([
                'status' => false,
                'data' => 'Token Inválido'
            ]);
        }
        $this->Json([
            'status' => true
        ]);
    }

    public function updatePassword()
    {
        $data = Request::getRequestData();
        $newPass = new PasswordUserToken;
        $p = $newPass->where('token', $data->token)->first();
        $p->used = 1;
        $p->save();
        $user = new User;
        $id = $p->user_id;
        $u = $user->where('id', $id)->update(['password' => Login::passwordHash($data->newPassword)]);
        if (!$u or !$p)
        {
            $this->Json([
                'status' => false
            ]);
        }
        $this->Json([
            'status' => true
        ]);
    }

    public function getUserName()
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = null;
        if (empty(Request::getRequestData()->id)) {
            $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;
        } else {
            $id = Request::getRequestData()->id;
        }
        $user = new User;
        $name = $user->find($id);
        if (!$name) {
            $this->Json([
                'status' => false
            ]);
        }
        $this->Json([
            'ownerName' => $name->name
        ]);
    }

    public function getUserEmail()
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = null;
        if (empty(Request::getRequestData()->id)) {
            $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;
        } else {
            $id = Request::getRequestData()->id;
        }
        $user = new User;
        $email = $user->find($id);
        if (!$email) {
            $this->Json([
                'status' => false
            ]);
        }
        $this->Json([
            'ownerEmail' => $email->email
        ]);
    }
}