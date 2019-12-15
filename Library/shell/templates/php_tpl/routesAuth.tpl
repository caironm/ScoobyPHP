//Rotas de autenticação geradas automaticamente via Scooby_CLI em 19-11-19 - 00:07:am
$router->group(null);
$router->get('/back', 'HomeController:index');
$router->get('/login', 'UserController:index');
$router->get('/register', 'UserController:register');
$router->post('/new-user', 'UserController:saveUser');
$router->post('/make-login', 'UserController:login');
$router->get('/exit', 'UserController:exit');
$router->post('/password-rescue', 'UserController:newPass');
$router->get('/passwordRescue', 'UserController:passwordRescue');
$router->get('/create-password', 'UserController:saveNewPassword');
$router->post('/password-reset', 'UserController:passwordReset');

//Rotas Autenticadas
if(Auth::authValidation()){
    $router->get('/dashboard', 'UserController:loged');
    $router->get('/delete-user', 'UserController:deleteUser');
    $router->get('/alter-user', 'UserController:alterUser');
    $router->post('/update-user', 'UserController:updateUser');
}
