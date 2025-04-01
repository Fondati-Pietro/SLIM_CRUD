<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class AlunniController
{
 private $mysqli_connection;


 public function __construct()
 {
   $this->mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
 }


 public function index(Request $request, Response $response, $args)
 {
   $result = $this->mysqli_connection->query("SELECT * FROM alunni");
   $results = $result->fetch_all(MYSQLI_ASSOC);


   $response->getBody()->write(json_encode($results));
   return $response->withHeader("Content-type", "application/json")->withStatus(200);
 }


 public function view(Request $request, Response $response, $args)
 {
   $id = $args["id"];
   $stmt = $this->mysqli_connection->prepare("SELECT * FROM alunni WHERE id = $id");
   $stmt->execute();
   $result = $stmt->get_result();
   $results = $result->fetch_all(MYSQLI_ASSOC);


   $response->getBody()->write(json_encode($results));
   return $response->withHeader("Content-type", "application/json")->withStatus(200);
 }


 public function create(Request $request, Response $response, $args){
   $body = json_decode($request->getBody()->getContents(),true);
   $nome = $body["nome"];
   $cognome = $body["cognome"];
   $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
   $result = $mysqli_connection->query("INSERT INTO alunni (nome,cognome) VALUES ('$nome','$cognome');");
   //$results = $result->fetch_all(MYSQLI_ASSOC);


   $response->getBody()->write(json_encode($result));
   return $response;
 }


 public function update(Request $request, Response $response, $args)
 {
   $body = json_decode($request->getBody()->getContents(),true);
   $id = $args["id"]; 
   $nome = $body["nome"];
   $cognome = $body["cognome"];
   $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
   $result = $mysqli_connection->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = '$id'");


   $response->getBody()->write(json_encode($result));
   return $response;
 }


 public function destroy(Request $request, Response $response, $args)
 {
   $body = json_decode($request->getBody()->getContents(),true);
   $id = $args["id"];
   $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
   $result = $mysqli_connection->query("DELETE FROM alunni WHERE id = '$id'");
   //$results = $result->fetch_all(MYSQLI_ASSOC);


   $response->getBody()->write(json_encode($result));
   return $response;
 }
}
