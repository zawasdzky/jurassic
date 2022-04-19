
<?php
  include 'server/conn.php';
  $sql = "SELECT `posters`.`id` AS `poster_id`, `posters`.`url_img`, `posters`.`enabled`, `users`.`name` FROM `posters`
  JOIN `users` ON `users`.`id` = `posters`.`user_id` 
  ORDER BY `posters`.`enabled` DESC";
  $result = mysqli_query($conn, $sql);
  if(isset($_POST["enable"])) {
    $poster_id= $_POST['poster_id'];
    $sql = "UPDATE `posters` SET `enabled`= 1 WHERE `id` = '$poster_id';";
    if (mysqli_query($conn, $sql)) {
      echo 200;
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
    die();
    }   

  if(isset($_POST["disable"])) {
    $poster_id= $_POST['poster_id'];
    $sql = "UPDATE `posters` SET `enabled`= 0 WHERE `id` = '$poster_id';";
    if (mysqli_query($conn, $sql)) {
      echo 200;
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
    die();
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class=" bg-black">
<div class="container-fluid p-3 bg-black text-white text-center ">
  <!-- <img src="https://phantom-marca.unidadeditorial.es/2a815b0a6f676d55d7403f7285db1b4e/resize/828/f/webp/assets/multimedia/imagenes/2022/02/11/16445345407827.jpg" class="img-fluid" alt="..." width="20%"> -->
  <div class="col-md-12">
    <a href="index.php" class="btn btn-danger btn-lg">Ir a Publicaciones</a>
  </div>
</div>
  
<div class="container mt-5">
  <div class="row">
    <?php while($row = mysqli_fetch_assoc($result)) { $poster_id = $row['poster_id'] ?>
    <div class="col-md-2">
      <div class="card">
        <img class="card-img-top" src="server/uploads/<?php echo $row['url_img'];?>" alt="<?php echo $row['name'];?>" style="width:100%">
        <div class="card-body">
          <div class="card-text"> 
            <p><strong><?php echo $row['name']; ?></strong> </p> 
            <?php if ($row['enabled']){?>  
            <button class="btn btn-danger" id="desaprobar<?php echo $poster_id;?>" onclick="disable(<?php echo $poster_id;?>)">Desaprobar</button> 
            <?php } ?> 
            <?php if (!$row['enabled']){?> 
            <button class="btn btn-success" id="aprobar<?php echo $poster_id;?>" onclick="enable(<?php echo $poster_id;?>)">Aprobar</button> 
            <?php } ?> 
          </div>
        </div>
      </div>
    </div>
    <?php } mysqli_close($conn); ?>
  </div>
</div>
<script>
    function enable(poster_id){
            $.ajax({
            url: "enable_posters.php",
            type: "POST",
            data:{ "poster_id":poster_id,"enable":"enable"},
            beforeSend: function() {
            //alert(poster_id);
            },
            success: function(response) {
              if (response == 200){
                //swal("¡Listo!", "Poster Activado", "success");
                location.reload();
              }else{
                swal("Error!", response, "danger");
              }
            },
        });
    }

    function disable(poster_id){

            $.ajax({
            url: "enable_posters.php",
            type: "POST",
            data:{ "poster_id":poster_id,"disable":"disable"},
            beforeSend: function() {
            //alert(poster_id);
            },
            success: function(response) {
              if (response == 200){
                //swal("¡Listo!", "Poster Des-Activado", "success");
                location.reload();
              }else{
                swal("Error!", response, "danger");
              }
            },
        });
    }

</script>
</body>
</html>
