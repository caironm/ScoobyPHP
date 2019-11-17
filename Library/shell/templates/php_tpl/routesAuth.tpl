//Rotas de autenticação geradas automaticamente via Scooby_CLI em dateNow
$route["/back"] = "/home";
$route["/login"] = "/user/index";
$route["/register"] = "/user/register";
$route['/new-user'] = '/user/saveUser';
$route['/make-login'] = '/user/login';
$route["/exit"] = "/user/exit";
$route["/passwordRescue"] = "/user/passwordRescue";

//Rotas Autenticadas
if(Helpers\Auth::authValidation()){
    $route['/dashboard'] = '/user/loged';
    $route['/delete-user/{id}'] = '/user/deleteUser/:id';
}