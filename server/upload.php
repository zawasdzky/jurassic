<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conn.php';

if ( isset($_POST['name']) )     { $name =  filter_var($_POST['name'],FILTER_SANITIZE_STRING);}else{echo "error input name"; die();}
if ( isset($_POST['email']) )    { $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);}else{echo "error input email"; die();}
if ( isset($_POST['document']) ) { $document = filter_var($_POST['document'],FILTER_SANITIZE_NUMBER_FLOAT);}else{echo "error input document"; die();}
if ( isset($_POST['city']) )     { $city = filter_var($_POST['city'],FILTER_SANITIZE_STRING,);}else{echo "error input city"; die();}
if ( isset($_POST['phone']) )    { $phone = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_FLOAT);}else{echo "error input phone"; die();}
if ( isset($_POST['honey']) && !empty($_POST['honey'])) { echo "security block"; die();}

$target_dir = "uploads/";

$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = $document . '.' . end($temp);
$nameFile = htmlspecialchars(basename( $_FILES["fileToUpload"]["name"]));
$target_file = $target_dir . $newfilename;
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if file already exists
  if (file_exists($target_file)) {
    $message = "Error: el usuario ya registró un poster anteriormente, el archivo ya existe";
    $uploadOk = false;
  }

  // Check file size 2MB
  if ($_FILES["fileToUpload"]["size"] > 2000000) {
    $message ="Error: El archivo exece 2MB.";
    $uploadOk = false;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $message ="Error sólo se permiten archivos jpg.";
    $uploadOk = false;
  }

  if ($uploadOk) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $message = "El poster: <strong>" . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "</strong> ha sido cargado exitosamente. <br>
      En cuanto sea aprobado será publicado.";
      $userInsert = "INSERT INTO `users` (`name`, `email`, `document`, `city`, `phone`) VALUES ('$name', '$email', '$document', '$city', '$phone')";
      $conn->query($userInsert);
      $last_id = mysqli_insert_id($conn);
      $imageNameInsert = "INSERT INTO `posters` (`user_id`, `url_img`,`votes`,`enabled`) VALUES ('$last_id', '$newfilename', 0, 0)";
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
<body class=" bg-black text-white">

<div class="container-fluid p-3 bg-black text-white text-center ">
  <img src="https://phantom-marca.unidadeditorial.es/2a815b0a6f676d55d7403f7285db1b4e/resize/828/f/webp/assets/multimedia/imagenes/2022/02/11/16445345407827.jpg" class="img-fluid" alt="..." width="20%">
</div>
  
<div class="container mt-5 text-center">
  <h2 class="m-5"><?php echo $message; ?></h2>
  <a href="../index.php" class="btn btn-warning btn-lg">Ver publicaciones</a>
</div>

</body>
</html>
