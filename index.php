
<?php
  include 'server/conn.php';
  $sql = "SELECT `posters`.`id` AS `poster_id`, `posters`.`url_img`, `users`.`name` FROM `posters`
  JOIN `users` ON `users`.`id` = `posters`.`user_id` 
  WHERE `posters`.`enabled`=1 
  ORDER BY `posters`.`id` DESC";
  $result = mysqli_query($conn, $sql);
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
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

</head>
<body style="background-color: black;">

<div class="row text-white text-center">
  <img src="JW3_KV_Cinemas-Procinal-y-Jurassic-World_rv.jpg" class="img-fluid" alt="...">
  <div class="col-md-12 p-3">
    <a href="upload_form.html" class="btn btn-danger btn-lg">SUBE AQUÍ TU POSTER</a><br><br>
      <a href="https://procinal.com/uploads/DESCARGAS/Terminos%20y%20condiciones%20Jurassic%20World.pdf" target="_blank">Lee aquí los términos y condiciones </a>
  </div>
</div>



<div class="container">
  <div class="row"  data-masonry='{"percentPosition": true }'>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-3">
      <div class="card my-3">
        <img class="card-img-top" src="server/uploads/<?php echo $row['url_img'];?>" alt="<?php echo $row['name'];?>" style="width:100%">
        <div class="card-body">
          <div class="card-text"> 
            <span> <?php echo $row['name']; ?> </span> 
          </div>
        </div>
      </div>
    </div>
    <?php } mysqli_close($conn); ?>
  </div>
</div>

<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.9);">
    <a class="text-white" href="https://uip.com.co/veacine/peliculas/jurassic-world-dominion/" target="_blank">
      <strong>DESCUBRE MÁS SOBRE LA PELÍCULA</strong>    
    </a>
  </div>
  <!-- Copyright -->
</footer>


</body>
</html>