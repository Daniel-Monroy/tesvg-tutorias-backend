<?php 

  session_start();

  $rutaServidor = Ruta::ctrRutaServidor();

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tutorias TESVG</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="<?php echo $rutaServidor?>vistas/img/plantilla/icono-blanco.png">

  <!--===========================================>>>>>
  = PLUGINS CSS =
  ===============================================>>-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins.. -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $rutaServidor?>vistas/bower_components/select2/dist/css/select2.min.css">
  

  <!--===========================================>>>>>
  = PLUGINS JAVA SCRIPT =
  ===============================================>>-->
  <!-- jQuery 3 -->
  <script src="<?php echo $rutaServidor?>vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo $rutaServidor?>vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="<?php echo $rutaServidor?>vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo $rutaServidor?>vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="<?php echo $rutaServidor?>vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  
  <script src="<?php echo $rutaServidor?>vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  
  <script src="<?php echo $rutaServidor?>vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  
  <script src="<?php echo $rutaServidor?>vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  
  <!-- SweetAlert 2 -->
  <script src="<?php echo $rutaServidor?>vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- Select2 -->
  <script src="<?php echo $rutaServidor?>vistas/bower_components/select2/dist/js/select2.full.min.js"></script>

</head>



<!--==========================
=  CONTENIDO DE LA PÁGINA    =
===========================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

  <?php

    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" ) {

      echo '<div class="wrapper">';

      /*================================
      = CABEZOTE            =
      ================================*/
      include "modulos/cabezote.php";

      /*================================
      = MENU            =
      ================================*/
      include "modulos/menu.php";

      /*================================
      = CONTENIDO            =
      ================================*/

      if (isset($_GET["ruta"])) {
        
        if ($_GET["ruta"] == "inicio" || 
            $_GET["ruta"] == "usuarios" || 
            $_GET["ruta"] == "actividades" ||
            $_GET["ruta"] == "sub-actividades" ||
            $_GET["ruta"] == "alumnos" ||
            $_GET["ruta"] == "salir") {

           include "modulos/".$_GET["ruta"].".php";
        
        } else {

          include "modulos/404.php";

        }

      } else {

        include "modulos/inicio.php";

      }

      /*================================
      = FOOTER            =
      ================================*/
      include "modulos/footer.php";

      echo '</div>';

    } else {

      include "modulos/login.php";

    }

   ?>

<input type="hidden" id="rutaOcultaServidor" value="<?php echo $rutaServidor?>">

<script src="<?php echo $rutaServidor?>vistas/js/plantilla.js"></script>
<script src="<?php echo $rutaServidor?>vistas/js/usuarios.js"></script>
<script src="<?php echo $rutaServidor?>vistas/js/actividades.js"></script>
<script src="<?php echo $rutaServidor?>vistas/js/sub-actividades.js"></script>

</body>

</html>
