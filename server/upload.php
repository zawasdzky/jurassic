<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conn.php';

$name     = $_POST['name'];
$email    = $_POST['email'];
$document = $_POST['document'];
$city     = $_POST['city'];
$phone    = $_POST['phone'];

$target_dir = "uploads/";
$nameFile = htmlspecialchars(basename( $_FILES["fileToUpload"]["name"]));
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if file already exists
  if (file_exists($target_file)) {
    $message = "Error: el archivo ya existe";
    $uploadOk = false;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 200000) {
    $message ="Sorry, your file is too large.";
    $uploadOk = false;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $message ="error solo se permiten archivos jpg.";
    $uploadOk = false;
  }

  if ($uploadOk) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $message = "El poster: <strong>" . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "</strong> ha sido cargado exitosamente.";
      $userInsert = "INSERT INTO `users` (`name`, `email`, `document`, `city`, `phone`) VALUES ('$name', '$email', '$document', '$city', '$phone')";
      $conn->query($userInsert);
      $last_id = mysqli_insert_id($conn);
      $imageNameInsert = "INSERT INTO `posters` (`user_id`, `url_img`, `votes`) VALUES ('$last_id', '$nameFile', 0)";
      $conn->query($imageNameInsert);
      mysqli_close($conn);
    } else {
      $message = "Error al subir el archivo.";
      mysqli_close($conn);
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>JURASSIC WORLD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>JURASSIC TITLE</h1>
  <p>Subtitle</p> 
</div>
  
<div class="container mt-5">
  <p><?php echo $message; ?></p>
  <a href="../posters.php" class="btn btn-primary">Ver publicaciones</a>
</div>

</body>
</html>
