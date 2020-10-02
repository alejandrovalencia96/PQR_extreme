<?php
header("Content-type: application/json");
require '../config.php';
session_start();

$idPQR = mysqli_real_escape_string($connDominio, $_POST['idPQR']);
$estadoModal = mysqli_real_escape_string($connDominio, $_POST['estadoModal']);

$query = "UPDATE pqr SET estado = '$estadoModal' WHERE id = '$idPQR'";
$sql = mysqli_query($connDominio, $query);

if($sql){
  $json = array('ok' => true, 'message' => 'Se actualizó correctamente!', 'estado' => $estadoModal);
  echo json_encode($json);
  return;
}else{
  $json = array('ok' => false, 'message' => 'No se pudo actualizar, intente nuevamente.');
  echo json_encode($json);
  return;
}


?>
