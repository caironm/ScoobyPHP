//Rotas do ResourceController $name automaticamente via - Scooby_CLI em dateNow
$router->group("$routeName");
$router->get('/', "$name:index");
$router->get('/create', "$name:create");
$router->post('/store', "$name:store");
$router->get('/show/{id}', "$name:show");
$router->get('/edit/{id}', "$name:edit");
$router->post('/update/{id}', "$name:update");
$router->get('/destroy/{id}', "$name:destroy");
