//Rotas de autenticação geradas automaticamente via Scooby_CLI em dateNow
$route->group(null);
$route->get('/back', 'UserController@goBack');
$route->get('/login', 'UserController@index');
$route->get('/register', 'UserController@register');
$route->post('/new-user', 'UserController@saveUser');
$route->post('/make-login', 'UserController@login');
$route->post('/password-rescue', 'UserController@newPass');
$route->get('/passwordRescue', 'UserController@passwordRescue');
$route->get('/create-password', 'UserController@saveNewPassword');
$route->post('/password-reset', 'UserController@passwordReset');

//Rotas Autenticadas
if(autentication::authValidation()){
    $route->get('/dashboard', 'DashboardController@index');
    $route->get('/exit', 'DashboardController@exit');
    $route->delete('/delete-user', 'DashboardController@deleteUser');
    $route->get('/alter-user', 'DashboardController@alterUser');
    $route->put('/update-user', 'DashboardController@updateUser');
}
