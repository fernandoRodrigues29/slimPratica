<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function(){
    return "PAdrão!";
});

//com parametros [ marca como opicional
$app->get('/hello[/[{name}]]', function(Request $request, Response $response){
    $name = $request->getAttribute('name') ?? 'World';
        $response->getBody()->write("Hello, {$name}");
    
            return $response;
});

$app->get('/outra-rota', function(){
    return "outra rota!";
});