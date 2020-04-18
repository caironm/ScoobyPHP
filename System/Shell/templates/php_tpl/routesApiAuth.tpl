
//rotas sem autenticação
$route->group('api');
$route->post('/register', 'UserApiController@register');
$route->post('/login', 'UserApiController@login');
$route->get('/delete', 'UserApiController@delete');
$route->get('/logout', 'UserApiController@logout');
