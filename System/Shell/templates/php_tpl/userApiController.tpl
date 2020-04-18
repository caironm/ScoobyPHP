<?php

//Controller de autenticação gerado automaticamente via Scooby-CLI em dateNow

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Helpers\Jwt;
use Scooby\Helpers\Login;
use Scooby\Helpers\Request;
use Scooby\Helpers\Validation;
use Scooby\Models\User;

class UserApiController extends Controller
{
    /**
     * Registra um novo usuario
     *
     * @return bool
     */
    public function register(): bool
    {
        $data = Request::getRequestData();
        if (!Validation::emailMatch($data->email, 'users', 'email')) {
            $this->Json(['data' => 'Email já cadastrado, por favor tente com um email diferente']);
            return false;
        }
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Login::passwordHash($data->pass);
        $user->save();
        $this->Json(['data' => 'Usuário salvo com sucesso']);
        return true;
    }

    /**
     * Efetua o login
     *
     * @return void
     */
    public function login()
    {
        $data = Request::getRequestData();
        if (Login::loginValidate($data->email, $data->pass)) {
            $token = Jwt::jwtCreate(['id' => $_SESSION['id'], 'email' => $data->email]);
            Jwt::jwtRefresh($token);
            $this->Json(['token' => $token]);
        } else {
            $this->Json(['data' => 'Usuário ou senha incorretos']);
        }
    }

    /**
     * Deleta usuario
     *
     * @return void
     */
    public function delete()
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $data = Jwt::jwtPayloadDecode(Jwt::jwtGetToken());
        $user = User::find($data->id);
        if ($user->delete()) {
            Jwt::jwtExpire(Jwt::jwtGetToken());
            $this->Json(['data' => 'Usuário deletado com sucesso']);
        } else {
            $this->Json(['data' => 'Falha ao deletar usuário']);
        }
    }

    public function logout()
    {
       Jwt::jwtValidate(Jwt::jwtGetToken());
       Jwt::jwtExpire(Jwt::jwtGetToken());
       $this->Json(['data' => 'Usuário deslogado com sucesso']);
    }
}