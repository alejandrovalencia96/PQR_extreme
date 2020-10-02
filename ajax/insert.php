<?php
header("Content-type: application/json");
require '../config.php';
session_start();

$tipo = mysqli_real_escape_string($connDominio, $_POST['tipo']);
$asunto = mysqli_real_escape_string($connDominio, $_POST['asunto']);
$usuario = mysqli_real_escape_string($connDominio, $_POST['usuario']);
$estado = mysqli_real_escape_string($connDominio, $_POST['estado']);
$creado_por = $_SESSION['whoami'];
$fecha_creacion = mysqli_real_escape_string($connDominio, $_POST['fecha_creacion']);
$fecha_limite = mysqli_real_escape_string($connDominio, $_POST['fecha_limite']);


$query = "INSERT INTO pqr (tipo,asunto,usuario,estado,creado_por,fecha_creacion,fecha_limite) VALUES ('$tipo','$asunto','$usuario','$estado','$creado_por','$fecha_creacion','$fecha_limite')";
$sql = mysqli_query($connDominio, $query);
$last_id = mysqli_insert_id($connDominio);

if($sql){
  $json = array('ok' => true, 'message' => 'Se guardo correctamente!', 'id' => $last_id);
  echo json_encode($json);
  return;
}else{
  $json = array('ok' => false, 'message' => 'No se pudo guardar, intente nuevamente.');
  echo json_encode($json);
  return;
}

?>
