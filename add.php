<?php
require "database.php";
//Si la variable global $SERVER contiene el methodo POST, guarda en el array $contact el valor de "name" del la variable global $_POST

$error = null;
/**Si $_POST["name"] o $_POST["phone_number"]  estan vacios, $error  pasa a contener una cadena de texto con el aviso
 * si $_POST["phone_number"] tiene un length < 9. $error pasa a contener una cadena de texto con el aviso
 * sino, se guarda "name" y "phone_number",
 * Se hace una peticion para insertar los valores en la base de datos bindeando los valores $_POST["name"] y $_POST["phone_number]
 * para evitar injecciones SQL
*/
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["name"]) && empty($_POST["phone_number"])){
      $error = "Please fill all fields";
    } else if (strlen($_POST["phone_number"]) < 9){
      $error = "Phone number must be at least 9 character";
    } else {
      $name = $_POST["name"];
      $phoneNumber = $_POST["phone_number"];

      $statement = $conn->prepare("INSERT INTO contacts (name, phone_number) VALUES (:name, :phone_number)");
      $statement->bindParam(":name", $_POST["name"]);
      $statement->bindParam(":phone_number", $_POST["phone_number"]);
      $statement->execute();
    
      //Redirige a index.php
      header("location: index.php");

    }
}
?>

<?php require "./partials/header.php"?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add New Contact</div>
        <div class="card-body">
          <!-- Si $error es distinto de null, significa que su valor es un error, entonces lo muestrs -->
          <?php if($error): ?>
            <p class="text-danger">
              <?=$error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="./add.php">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>

              <div class="col-md-6">
                <input id="phone_number" type="tel" class="form-control" name="phone_number" autocomplete="phone_number" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "./partials/footer.php" ?>
