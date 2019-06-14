<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
/*
$middleware = function($request, $response, $next){
    $response->getBody()->write('ANTES');
    $response = $next($request, $response);
    $response->getBody()->write('DEPOIS');

    return $response;
};

$app->add($middleware);
*/
$auth = function($request, $response, $next){
    if(isset($_SESSION['usuarios']) and is_array($_SESSION['usuarios'])){
        $response = $next($request, $response);
    }else{
        $response = $response->withStatus(401)->write('PginaProtegida');
    }

    return $response;
};
//add no projeto todo
//$app->add($auth);