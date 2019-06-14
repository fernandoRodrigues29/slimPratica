<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/hello[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/usuarios', function (Request $request, Response $response, array $args) {
    // Sample log message
    $tabela = $this->db->table('usuarios'); 
    $usuarios = $tabela->get();

    // Render index view
    return $this->renderer->render($response, 'usuarios/index.phtml', ['usuarios'=>$usuarios]);
})->add($auth);
$app->post('/usuarios', function (Request $request, Response $response, array $args) {
    $data = [
        'nome'=>filter_input(INPUT_POST, 'nome'),
        'login'=>filter_input(INPUT_POST, 'email'),
        'password'=>filter_input(INPUT_POST, 'senha') 
    ];
    var_dump($data);
   
    // Sample log message
    $tabela = $this->db->table('usuarios'); 
    $usuarios = $tabela->insert($data);

    // Render index view
    return $response->withStatus(302)->withHeader('Location','/usuarios');
})->add($auth);
$app->get('/usuarios/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
   // Sample log message
    $tabela = $this->db->table('usuarios'); 
    $usuarios = $tabela->where('id',$id)->delete();

    // Render index view
    return $response->withStatus(302)->withHeader('Location','/usuarios');
//add apenas o midleware que vai na rota
})->add($auth);

$app->map(['GET','POST'],'/login', function (Request $request, Response $response, array $args) {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       echo "FOI UM POST"; 
       $email = filter_input(INPUT_POST, 'email');
       $password = filter_input(INPUT_POST, 'senha');

       
       $tabela = $this->db->table('usuarios'); 
       $usuarios = $tabela->where([
           'login'=>$email,
           'password'=>$password
           ])->get();

          if($usuarios->count()){
                $_SESSION['usuarios'] = (array)$usuarios->first();
                return $response->withStatus(302)->withHeader('Location','/usuarios');
            }
    }
    // Render index view
    return $this->renderer->render($response, 'login.phtml');
});