<?php
include('dbconnect.php');
if(!empty($_GET['id']) && isset($_GET['id'])){
  $id=$_GET['id'];
  $sql = sprintf("DELETE FROM `friends` WHERE `friend_id` = %d",$id);
  mysqli_query($db,$sql) or die(mysqli_error($db));
  header("location: index.php");
  exit();
}
?>
