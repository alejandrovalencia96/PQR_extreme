<?php
header("Content-type: application/json");
require '../config.php';
session_start();

$username = mysqli_real_escape_string($connDominio, $_POST['username']);
$password = mysqli_real_escape_string($connDominio, $_POST['password']);

$query = "SELECT * FROM users WHERE username = '$username'";
$sql = mysqli_query($connDominio, $query);
$user_count = mysqli_num_rows($sql);

if($user_count > 0){
  $row = mysqli_fetch_array($sql);
  $passwordBD = $row['password'];


  if(password_verify($password, $passwordBD)) {

    $_SESSION['whoami'] = $row['id'];
    $_SESSION['whoare'] = $row['name'].' '.$row['lastname'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $json = array('ok' => true, 'message' => 'Logueo exitoso.');
    echo json_encode($json);
    return;
  }else{
   $json = array('ok' => false, 'message' => 'Usuario o contraseña no coinciden, intenta con otro.');
    echo json_encode($json);
    return;

  }

}else{
  $json = array('ok' => false, 'message' => 'No existe el usuario.');
  echo json_encode($json);
  return;
}

?>
