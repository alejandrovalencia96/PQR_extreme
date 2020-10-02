<?php
header("Content-type: application/json");
require '../config.php';
session_start();
$name = mysqli_real_escape_string($connDominio, $_POST['name']);
$lastname = mysqli_real_escape_string($connDominio, $_POST['lastname']);
$username = mysqli_real_escape_string($connDominio, $_POST['username']);
$password = mysqli_real_escape_string($connDominio, $_POST['password']);
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$query = "SELECT * FROM users WHERE username = '$username'";
$sql = mysqli_query($connDominio, $query);
$user_count = mysqli_num_rows($sql);

if($user_count > 0){
  $json = array('ok' => false, 'message' => 'Ya existe ese usuario, intente con otro.');
  echo json_encode($json);
  return;
}

$query2 = "INSERT INTO users (name,lastname,role,username,password) VALUES ('$name','$lastname','USER_ROLE','$username','$passwordHash')";
$sql2 = mysqli_query($connDominio, $query2);
$last_id = mysqli_insert_id($connDominio);

if($sql2){
  $_SESSION['whoami'] = $last_id;
  $_SESSION['whoare'] = $name.' '.$lastname;
  $_SESSION['username'] = $username;
  $_SESSION['role'] = 'USER_ROLE';
  $json = array('ok' => true, 'message' => 'Registro exitoso.');
  echo json_encode($json);
  return;
}else{
  $json = array('ok' => false, 'message' => 'Ocurrio un error, intente mas tarde.');
  echo json_encode($json);
  return;
}


?>
