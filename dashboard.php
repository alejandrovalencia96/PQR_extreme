<?php
session_start();
if(!isset($_SESSION['whoami'])){
  header('Location: index.php');
}
require 'config.php';

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Extreme technologies</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.14/jquery.datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.14/jquery.datetimepicker.full.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
<body>



<div class="container mb-5">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="assets/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link"><i class="far fa-user"></i> <?php echo ucwords($_SESSION['whoare']); ?></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="generarExcel.php">Generar Excel <i class="far fa-file-excel"></i></a>
      </li>

      <?php  if($_SESSION['role'] == 'ADMIN_ROLE'){ ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#modalAgregarPQR">Añadir PQR<i class="fas fa-plus"></i></a>
      </li>
    <?php } ?>

      <li class="nav-item">
        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
      </li>

    </ul>

  </div>
</nav>


<header>

<div class="row">
<div class="col-md-12">
<div class="headerContent">
Preguntas, Quejas & Respuestas
</div>
</div>
</div>
</header>

<div class="message"></div>

<?php
if($_SESSION['role'] == 'ADMIN_ROLE'){
?>
<ul class="list-group ulPQR">
  <?php
  $query = "SELECT us1.name AS 'nombre_usuario', us1.lastname AS 'apellido_usuario', us2.name AS 'nombre_admin', us2.lastname AS 'apellido_admin', pqr.* FROM pqr INNER JOIN users us1 ON pqr.usuario = us1.id INNER JOIN users us2 ON pqr.creado_por = us2.id ORDER BY pqr.id DESC";
  $sql = mysqli_query($connDominio, $query);
  $countPQR = mysqli_num_rows($sql);

  if($countPQR > 0){

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

    <li class="list-group-item" id="itemlist<?php echo $id; ?>">
        <div class="row">
        <div class="col-md-1 itemsCenter">
        <?php
        if($tipo == 'peticion'){
          echo '<i class="fas fa-hand-holding fa-2x" style="color:#00a3b4;"></i>';
        }else if($tipo == 'queja'){
          echo '<i class="fas fa-exclamation-triangle fa-2x" style="color:orange;"></i>';
        }else{
          echo '<i class="fas fa-retweet fa-2x" style="color:red;"></i>';
        }
        ?>
        </div>
        <div class="col-md-8">
        <h3 <?php if($tipo == 'peticion') { echo 'class="peticion"'; }
         else if($tipo == 'queja') { echo 'class="queja"'; }
         else { echo 'class="reclamo"'; }
         ?>><?php echo $tipo; ?>
        <span class="spanEstado">(<?php echo $estado; ?>)</span>
        </h3>

        <p class="asunto"><?php echo $asunto; ?></p>
        <p class="text-muted">
          <span>Para <?php echo $nombres_usuario; ?>.</span><br>
          <span>Por <?php echo ucfirst($nombres_admin); ?>.</span>
          <i class="far fa-calendar-alt"></i> <span><?php echo $fecha_creacion; ?></span>
          <i class="fas fa-grip-lines-vertical"></i> <span><?php echo $fecha_limite; ?></span>
          <?php if($fecha_limite < date("Y-m-d")){
          echo '<br><span style="color:red; text-transform:uppercase;">'.$tipo.' vencida!!!</span>';
          }?>
        </p>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-info btn-sm btnEditar float-right" <?php if($estado == 'cerrado'){ echo 'disabled'; } ?> id="<?php echo $id; ?>" data="<?php echo $estado; ?>"><i class="far fa-edit"></i></button>
        </div>
      </div>

      </li>
    <?php }

  }else{
    echo '<li class="notpqr list-group-item">No hay PQR disponibles.</li>';
  }
  ?>

</ul>
<?php }else {  ?>

  <ul class="list-group ulPQR">
    <?php
    $query = "SELECT us1.name AS 'nombre_usuario', us1.lastname AS 'apellido_usuario', us2.name AS 'nombre_admin', us2.lastname AS 'apellido_admin', pqr.* FROM pqr INNER JOIN users us1 ON pqr.usuario = us1.id INNER JOIN users us2 ON pqr.creado_por = us2.id WHERE us1.id = '$_SESSION[whoami]' ORDER BY pqr.id DESC";
    $sql = mysqli_query($connDominio, $query);
    $countPQR = mysqli_num_rows($sql);

    if($countPQR > 0){

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

      <li class="list-group-item" id="itemlist<?php echo $id; ?>">
          <div class="row">
          <div class="col-md-1 itemsCenter">
          <?php
          if($tipo == 'peticion'){
            echo '<i class="fas fa-hand-holding fa-2x" style="color:#00a3b4;"></i>';
          }else if($tipo == 'queja'){
            echo '<i class="fas fa-exclamation-triangle fa-2x" style="color:orange;"></i>';
          }else{
            echo '<i class="fas fa-retweet fa-2x" style="color:red;"></i>';
          }
          ?>
          </div>
          <div class="col-md-10">
          <h3 <?php if($tipo == 'peticion') { echo 'class="peticion"'; }
           else if($tipo == 'queja') { echo 'class="queja"'; }
           else { echo 'class="reclamo"'; }
           ?>><?php echo $tipo; ?>
          <span class="spanEstado">(<?php echo $estado; ?>)</span>
          </h3>

          <p class="asunto"><?php echo $asunto; ?></p>
          <p class="text-muted">
            <span>Por <?php echo ucfirst($nombres_admin); ?>.</span>
            <i class="far fa-calendar-alt"></i> <span><?php echo $fecha_creacion; ?></span>
            <i class="fas fa-grip-lines-vertical"></i> <span><?php echo $fecha_limite; ?></span>
            <?php if($fecha_limite < date("Y-m-d")){
            echo '<br><span style="color:red; text-transform:uppercase;">'.$tipo.' vencida!!!</span>';
            }?>
          </p>
          </div>
        </div>

        </li>
      <?php }

    }else{
      echo '<li class="notpqr list-group-item">No hay PQR disponibles.</li>';
    }
    ?>

<?php } ?>

</div>


<!-- Modal AgregarPQR-->
  <div class="modal fade" id="modalAgregarPQR">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center"><i class="fas fa-info-circle"></i> PQR</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form id="añadirPQR">
        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group">
              <label>Tipo de PQR</label><br>
              <select class="form-control" name="tipo" id="tipo" required>
                <option value="">--Seleccione--</option>
                <option value="peticion">Petición</option>
                <option value="queja">Queja</option>
                <option value="reclamo">Reclamo</option>
              </select>
            </div>

            <div class="form-group">
              <label>Asunto</label><br>
              <textarea class="form-control" name="asunto" id="asunto" placeholder="Escribe un mensaje.."></textarea>
            </div>

            <div class="form-group">
              <label>Usuario</label><br>
              <select id="liveSearchUsuario" name="usuario" class="select2 form-control usuario" style="max-width:100%;" title="Escoge el usuario"></select >
            </div>

            <div class="form-group">
              <label>Estado </label><br>
              <select class="form-control" name="estado" id="estado" required>
                <option value="">--Seleccione--</option>
                <option value="nuevo">Nuevo</option>
                <option value="ejecucion">En ejecución</option>
                <option value="cerrado">Cerrado</option>
              </select>
            </div>

            <div class="form-group">
              <label>Fecha de creación</label>
              <input type="text" class="form-control" name="fecha_creacion" id="fecha_creacion" value="<?php echo date("Y-m-d"); ?>" placeholder="YYYY-MM-DD" required autocomplete="off">
            </div>

            <div class="form-group">
              <label>Fecha Limite</label>
              <input type="text" class="form-control" name="fecha_limite" id="fecha_limite" placeholder="YYYY-MM-DD" required autocomplete="off">
            </div>

            <div class="messageModal"></div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Agregar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>

      </form>


      </div>
    </div>
  </div>


  <!-- Modal EDITAR PQR-->
    <div class="modal fade" id="modalEditarPQR">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title text-center"><i class="fas fa-info-circle"></i> Editar PQR</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <form id="editarPQR">
          <!-- Modal body -->
          <div class="modal-body">

            <div class="form-group">
              <label>Estado </label><br>
              <select class="form-control" name="estadoModal" id="estadoModal" required></select>
              <input type="hidden" id="idPQR" name="idPQR">
            </div>
            <div class="messageModalEdit"></div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info">Editar</button>
          </div>

        </form>


        </div>
      </div>
    </div>

<script>
var phpAdminVar = "<?php echo ucfirst($_SESSION['whoare']); ?>";
</script>
<script src="assets/js/dashboard.js"></script>
</body>
</html>
