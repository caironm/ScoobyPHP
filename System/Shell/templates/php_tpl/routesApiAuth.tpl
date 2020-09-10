
//rotas sem autenticação
$route->group('api');
$route->post('/register', 'UserApiController@register');
$route->post('/login', 'UserApiController@login');
$route->delete('/delete', 'UserApiController@delete');
$route->get('/logout', 'UserApiController@logout');
$route->get('/update', 'UserApiController@update');
$route->put('/alter', 'UserApiController@alter');
$route->post('/password-rescue', 'UserApiController@passwordRescue');
$route->post('/password-token', 'UserApiController@tokenValidate');
$route->put('/password-update', 'UserApiController@updatePassword');
$route->post('/user-email', 'UserApiController@getUserEmail');
$route->get('/user-name', 'UserApiController@getUserName');