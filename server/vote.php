<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'conn.php';

$poster_id = $_POST['poster_id'];
$user_ip = $_POST['ip_address'];

$sql = "UPDATE `posters` SET  `votes` = `votes`+1 WHERE `id` ='$poster_id';";
$sql2 = "INSERT INTO `users_votes_ip` (`poster_id`,`user_ip`)VALUES( '$poster_id','$user_ip');";

if ( $conn->query($sql) === TRUE && $conn->query($sql2) === TRUE  ) {
  echo 1;
} else {
    echo 0;
  //echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
