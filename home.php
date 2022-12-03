<?php
require "database.php";

session_start();

if(!isset($_SESSION["user"])){
  header("Location: login.php");
  return;
}
//hace una conexion a la base de datos con un metodo query que recibe la sentencia SQL SELECT, para guardar en $contacts, todos los contactos
//que hay en la base de datos. para luego mostrarlos en el home.php
$contacts = $conn->query("SELECT * FROM contacts WHERE user_id = {$_SESSION['user']['id']}");

?>

<?php require "./partials/header.php" ?>
<div class="container pt-4 p-3">
  <div class="row">
  <!-- Si $contacts esta vacio, muestra una <p></p> con valor "No contacts saved yet" -->
    <?php if($contacts->rowCount() == 0): ?> 
    <div class="col-md-4 mx-auto">
      <div class="card card-body text-center">
        <p>No conteacts saved yet</p>
        <a href="./add.php">Add One!</a>
      </div>
    </div>
  <?php endif ?>

  <!-- Por cada contacto muestra en el template html $contact["name"], $contact["phone_number"], el boton Edit Contact y Delete Contact asociados al $contact["id"] del contacto -->
  <?php
  foreach ($contacts as $contact): ?>
    <div class="col-md-4 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h3 class="card-title text-capitalize"><?= $contact["name"] ?></h3>
          <p class="m-2"><?= $contact["phone_number"] ?></p>
          <a href="./edit.php?id=<?= $contact["id"]?>" class="btn btn-secondary mb-2">Edit Contact</a>
          <a href="./delete.php?id=<?= $contact["id"] ?>" class="btn btn-danger mb-2">Delete Contact</a>
        </div>
      </div>
    </div>
  <?php endforeach ?>
  
  </div>
</div>
<?php require "./partials/footer.php"?>
