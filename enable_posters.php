
<?php
  include 'server/conn.php';
  $sql = "SELECT `posters`.`id` AS `poster_id`, `posters`.`url_img`, `users`.`name` FROM `posters`
  JOIN `users` ON `users`.`id` = `posters`.`user_id` 
  ORDER BY `posters`.`enabled` DESC";
  $result = mysqli_query($conn, $sql);
  if(isset($_POST["enable"])) {
      echo "enable";
    }

  if(isset($_POST["disable"])) {
    echo "disable";
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
<body>


<div class="container mt-5">
  <div class="row">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-3">
      <div class="card">
        <img class="card-img-top" src="<?php echo $row['url_img'];?>" alt="<?php echo $row['name'];?>" style="width:100%">
        <div class="card-body">
          <div class="card-text"> 
            <span> <?php echo $row['name']; ?> </span> 
            <span> Estado: <?php echo $row['enabled']; ?> </span> 
            
            <button class="btn btn-primary" id="vote_btn<?php echo $poster_id;?>" onclick="enable(<?php echo $poster_id;?>)">Aprobar</button> 
            <button class="btn btn-primary" id="vote_btn<?php echo $poster_id;?>" onclick="enable(<?php echo $poster_id;?>)">Aprobar</button> 
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
            url: "enable_posters",
            type: "POST",
            data:{ "poster_id":poster_id},
            beforeSend: function() {
            alert(poster_id);
            },
            success: function(response) {
            swal("¡Listo!", "Tu voto ha sido enviado", "success");
            $( vote_btn ).remove();
            },
        });
    }
</script>
</body>
</html>
