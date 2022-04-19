
<?php
  include 'server/conn.php';
  $sql="SELECT `posters`.`id` AS `poster_id`, `posters`.`url_img`,  `posters`.`votes`,  `users`.`name`
  FROM `posters` JOIN `users` ON `users`.`id` = `posters`.`user_id` WHERE `posters`.`enabled`=1 ORDER BY `votes` ASC";
  $posters = mysqli_query($conn,$sql);

  $ip_address = 0;
  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }else{  
      $ip_address = $_SERVER['REMOTE_ADDR'];  
  }

  $posters_id = array();
  $sql="SELECT `poster_id` FROM `users_votes_ip` WHERE `user_ip`= '$ip_address';";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($posters_id, $row["poster_id"]);
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>JURASSIC TITLE</h1>
  <a href="upload_form.html" class="btn btn-danger">Subir Poster</a>
</div>

<div class="container mt-5">
  <div class="row">
    <?php while($row = mysqli_fetch_array($posters)) { 
      $poster_id = $row['poster_id'];
      ?>
    <div class="col-md-3">
      <div class="card">
        <img class="card-img-top" src="<?php echo $row['url_img'];?>" alt="<?php echo $row['name'];?>" style="width:100%">
        <div class="card-body">
          <div class="card-text"> 
            <span> <?php echo $row['name']; ?> </span> 
              <strong id="quantityText<?php echo $poster_id;?>">
                <?php echo $row['votes'];?> 
              </strong> Votos
            <input type="hidden" id="quantity<?php echo $poster_id;?>" value="<?php echo $row['votes'];?>">
            <?php if (!in_array($poster_id, $posters_id)) { ?>
              <button class="btn btn-primary" id="vote_btn<?php echo $poster_id;?>" onclick="vote(<?php echo $poster_id;?>)">Votar</button> 
            <?php } ?>
            </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">

 function vote(poster_id){

    $.getJSON('https://ipgeolocation.abstractapi.com/v1/?api_key=1be9a6884abd4c3ea143b59ca317c6b2', function(data) {
      //console.log(JSON.stringify(data, null, 2));
      localStorage.setItem('ip_address', data.ip_address)
    });

    //var ip_address = localStorage.getItem('ip_address');
    var ip_address = "<?php echo $ip_address;?>";
    var data = { "poster_id":poster_id,"ip_address":ip_address}
    var vote_btn = "#vote_btn"+poster_id;
    var quantity = "#quantity"+poster_id;
    var quantityText = "#quantityText"+poster_id;
    var quantityVal = parseInt($(quantity).val());
    $(quantityText).text(quantityVal+1);

     $.ajax({
          url: "server/vote.php",
          type: "POST",
          data:data,
          beforeSend: function() {
            //alert(data.ip_address);
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