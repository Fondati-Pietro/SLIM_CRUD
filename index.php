<?php
use Slim\Factory\AppFactory;


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/includes/Db.php';


$app = AppFactory::create();


// curl http://localhost:8080/alunni
$app->get('/alunni', "AlunniController:index");


// curl http://localhost:8080/alunni/2
$app->get('/alunni/{id:\d+}', "AlunniController:view");


// curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome": "ciccio", "cognome": "bello"}'
$app->post('/alunni', "AlunniController:create");


// curl -X PUT http://localhost:8080/alunni/2 -H "Content-Type: application/json" -d '{"nome": "ciccio", "cognome": "bello"}'
$app->put('/alunni/{id}', "AlunniController:update");


// curl -X DELETE http://localhost:8080/alunni/2
$app->delete('/alunni/{id}', "AlunniController:destroy");

// curl http://localhost:8080/alunni/search/bel
$app->get('/alunni/search/{key}', "AlunniController:search");

// curl http://localhost:8080/alunni/orderBy/nome
$app->get('/alunni/orderBy/{key}', "AlunniController:orderBy");

// curl http://localhost:8080/alunni/orderBy/nome  --con controllo
$app->get('/alunni/sort/{key}', "AlunniController:sort");



$app->run();
