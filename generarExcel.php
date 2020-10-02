<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=PQR.xls");
header("Pragma: no-cache");
header("Expires: 0");
require 'config.php';
session_start();


if($_SESSION['role'] == 'ADMIN_ROLE'){
  $query = "SELECT us1.name AS 'nombre_usuario', us1.lastname AS 'apellido_usuario', us2.name AS 'nombre_admin', us2.lastname AS 'apellido_admin', pqr.* FROM pqr INNER JOIN users us1 ON pqr.usuario = us1.id INNER JOIN users us2 ON pqr.creado_por = us2.id ORDER BY pqr.id DESC";
}else{
  $query = "SELECT us1.name AS 'nombre_usuario', us1.lastname AS 'apellido_usuario', us2.name AS 'nombre_admin', us2.lastname AS 'apellido_admin', pqr.* FROM pqr INNER JOIN users us1 ON pqr.usuario = us1.id INNER JOIN users us2 ON pqr.creado_por = us2.id WHERE us1.id = '$_SESSION[whoami]' ORDER BY pqr.id DESC";
}

  $sql = mysqli_query($connDominio, $query);
  ?>
  <table style="width:100%" border='1'>
    <tr>
      <th>Nombres</th>
      <th>Tipo</th>
      <th>Asunto</th>
      <th>Estado</th>
      <th>Fecha Creacion</th>
      <th>Fecha Limite</th>
      <th>Creado por</th>
    </tr>

  <?php
  while($row = mysqli_fetch_array($sql)){
  $id = $row['id'];
  $nombres_usuario = $row['nombre_usuario'].' '.$row['apellido_usuario'];
  $nombres_admin = $row['nombre_admin'].' '.$row['apellido_admin'];
  $tipo = $row['tipo'];
  $asunto = $row['asunto'];
  $estado = $row['estado'];
  $fecha_creacion = $row['fecha_creacion'];
  $fecha_limite = $row['fecha_limite'];
  ?>
  <tr>
    <th><?php echo $nombres_usuario; ?></th>
    <th><?php echo $tipo; ?></th>
    <th><?php echo $asunto; ?></th>
    <th><?php echo $estado; ?></th>
    <th><?php echo $fecha_creacion; ?></th>
    <th><?php echo $fecha_limite; ?></th>
    <th><?php echo $nombres_admin; ?></th>

  </tr>

  <?php } ?>
</table>
