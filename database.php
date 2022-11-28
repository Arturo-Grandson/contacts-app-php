<?php
//Conexion a la base de datos
//definimos los parametros de conexion: $host(donde se aloja la base de datos), $database(El nombre de la base de datos a la que queremos acceder)
//$user(usuario de la base dedatos), $password(password del usuario para acceder a la base de datos)
$host = "127.0.0.1";
$database = "contacts_app";
$user = "root";
$password = "";

//Se accede a la base de datos con un try catch para que en caso de que ocurra un error, capturarlo.

try {
  $conn = new PDO("mysql:host=$host; dbname=$database", $user, $password);
  // foreach($conn->query("SHOW DATABASES") as $row){
  //   print_r($row);
  // }
  // die();
} catch(PDOException $e) {
  die("PDO Connection Error: " . $e->getMessage());
}
