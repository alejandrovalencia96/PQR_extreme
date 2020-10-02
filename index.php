<?php
session_start();
if(isset($_SESSION['whoami'])){
  header('Location: dashboard.php');
}

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
<body>

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="assets/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#myModal">Ingresar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#myModalRegistro">Registrate</a>
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


<h4 class="textPruba">Prueba de Selección</h4>


</div>


<!-- Modal login-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center">Extreme technologies</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form id="login">
        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
              </div>
            </div>

            <div class="message"></div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-info btn-block">Ingresar</button>
        </div>

      </form>


      </div>
    </div>
  </div>


  <!-- The Modal -->
    <div class="modal fade" id="myModalRegistro">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title text-center">Extreme technologies</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <form id="registro">
          <!-- Modal body -->
          <div class="modal-body">

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombres" name="nameRegistro" id="nameRegistro">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Apellidos" name="lastnameRegistro" id="lastnameRegistro">
              </div>
            </div>

              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" name="usernameRegistro" id="usernameRegistro">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" name="passwordRegistro" id="passwordRegistro">
                </div>
              </div>

              <div class="messageModalRegistro"></div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-info btn-block">Registrarse</button>
          </div>

        </form>


        </div>
      </div>
    </div>



    <script src="assets/js/index.js"></script>
  </body>
</html>
