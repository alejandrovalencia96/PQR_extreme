<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config.php';
header("Content-Type: text/html;charset=utf-8");

if(isset($_GET['q'])){
  $query = "SELECT * FROM users WHERE name LIKE '%".$_GET['q']."%' AND role = 'USER_ROLE' LIMIT 10";
}else{
  $query = "SELECT * FROM users WHERE role = 'USER_ROLE' LIMIT 10";
}

$sql = mysqli_query($connDominio, $query);
$json = [];
while($row = mysqli_fetch_array($sql)){
     $json[] = ['id'=>$row['id'], 'text'=>$row['name'].' '.$row['lastname']];
}
echo json_encode($json);
?>
