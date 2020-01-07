//Rotas de autenticação geradas automaticamente via Scooby_CLI em 19-11-19 - 00:07:am
$router->group(null);
$router->get('/back', 'UserController:goBack');
$router->get('/login', 'UserController:index');
$router->get('/register', 'UserController:register');
$router->post('/new-user', 'UserController:saveUser');
$router->post('/make-login', 'UserController:login');
$router->post('/password-rescue', 'UserController:newPass');
$router->get('/passwordRescue', 'UserController:passwordRescue');
$router->get('/create-password', 'UserController:saveNewPassword');
$router->post('/password-reset', 'UserController:passwordReset');

//Rotas Autenticadas
if(Auth::authValidation()){
    $router->get('/dashboard', 'DashboardController:index');
    $router->get('/exit', 'DashboardController:exit');
    $router->delete('/delete-user', 'DashboardController:deleteUser');
    $router->get('/alter-user', 'DashboardController:alterUser');
    $router->put('/update-user', 'DashboardController:updateUser');
}
