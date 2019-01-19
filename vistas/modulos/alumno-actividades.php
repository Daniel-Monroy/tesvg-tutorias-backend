<?php 

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();

# ==================
# = ACTIVIDADES    =
# ==================
if (!isset($_GET["idAlumnoActividades"])) {

  echo '  
     <script> window.location = "alumnos"; </script>
  ';

  return;
}

?>


<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Alumno
    
      <small>Actividades Realizadas</small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">actividades-alumno</li>
    
    </ol>

  </section>

  <section class="content">
  
    <div class="row">
      
      <div class="col-md-3">


      <?php 

        $item = "id";

        $valor = $_GET["idAlumnoActividades"];

        $alumno = ControladorAlumnos::ctrMostrarAlumnos($item, $valor);
       

        echo'        

        <div class="box box-primary">

          <div class="box-body box-profile">';

            if ($alumno["foto"] != null) {
            
                echo '<img src="'.$url.$alumno["foto"].'" class="profile-user-img img-responsive img-circle">';
        
            } else {

                echo '<img src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" class="profile-user-img img-responsive img-circle">';
            }
            
            echo'
           
            <h3 class="profile-username text-center">'.$alumno["nombre"]." ".$alumno["apellidos"].'</h3>

            <input type="hidden" id="idAlumno" value="'.$alumno["id"].'">';?>

            
            <?php 

              $itemCarrera = "id";

              $valorCarrera = $alumno["id_carrera"];

              $respuestaCarrera = ControladorCarreras::ctrMostrarCarreras($itemCarrera, $valorCarrera);

              echo'<p class="text-muted text-center">'.$respuestaCarrera ["descripcion"].'</p>';


              # ============================
              # = TODAS LAS ACTIVIDADES    =
              # ============================
              $itemSubActividad = "id_tutor";

              $valorSubActiviad = $_SESSION["id"];
              
              $subActividades = ControladorSubActividades::ctrMostrarTodasSubActividades($itemSubActividad, $valorSubActiviad);
             
             # ============================
             # = ACTIVIDADES REALIZADAS   =
             # ============================
              $item = "id_alumno";

              $valor = $alumno["id"];

              $ordenar = "id";

              $modo = "DESC";

              $base = 0;

              $tope = count($subActividades);

              //ENVIANDO SOLO POR ALUMNO Y CATEGORIA
              $actividadesRealizadas = ControladorSubActividades::ctrMostrarSubActividadesRealizadas($item, $valor, $ordenar, $modo, $base, $tope);

              $actividadesPendientes = count($subActividades) - count($actividadesRealizadas);
              
              
              echo'    

              <ul class="list-group list-group-unbordered">
                
                <li class="list-group-item">
                  
                  <b>Actividades Realizadas</b>

                  <a class="pull-right">'.count($actividadesRealizadas).'</a>

                </li>

                <li class="list-group-item">
                  
                  <b>Actividades Pendientes</b>

                  <a class="pull-right">'.$actividadesPendientes.'</a>

                </li>

                <li class="list-group-item">
                  
                  <b>Ultimo Login</b>

                  <a class="pull-right">'.$alumno["ultimo_login"].'</a>

                </li>

              </ul>
              
          </div>

        </div> ';?>


        <!-- Acerca de Él -->
        <div class="box box-primary">
  
          <div class="box-header with-border">
            
            <h3 class="box-title">Acerca de Él</h3>  

          </div>  

          <div class="box-body">
            
            <strong><i class="fa fa-book margin-r-5"></i>Educación</strong>
              
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis asperiores nihil dolore, maiores officiis a, esse nesciunt impedit praesentium ratione voluptatem fugit laborum aliquam, tempore facilis perspiciatis eius ut obcaecati. </p>    

            <hr>

            <strong><i class="fa fa-book margin-r-5"></i>Sobre Él (Ella)</strong>
              
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis asperiores nihil dolore, maiores officiis a, esse nesciunt impedit praesentium ratione voluptatem fugit laborum aliquam, tempore facilis perspiciatis eius ut obcaecati. </p>    

          </div>      
    
  
        </div>
        <!-- Acerca de Él -->

      </div>


      <div class="col-md-9">
        
        <div class="nav-tabs-custom">
          
          <ul class="nav nav-tabs">
             
            <li class="active">
              
              <a href="#actividadesRealizadas" data-toggle="tab">Actividades Realizadas</a>
              
            </li>  

            <li>
              
              <a href="#actividadesPendientes" data-toggle="tab">Actividades Pendientes</a>
              
            </li>  

          </ul>

          <div class="tab-content">

            <?php 

              # ============================
              # = TODAS LAS ACTIVIDADES    =
              # ============================
              $itemSubActividad = "id_tutor";

              $valorSubActiviad = $_SESSION["id"];
              
              $subActividades = ControladorSubActividades::ctrMostrarTodasSubActividades($itemSubActividad, $valorSubActiviad);
             

             # ============================
             # = ACTIVIDADES REALIZADAS   =
             # ============================
              $item = "id_alumno";

              $valor = $alumno["id"];

              $ordenar = "id";

              $modo = "DESC";

              $base = 0;

              $tope = count($subActividades);

              //ENVIANDO SOLO POR ALUMNO Y CATEGORIA
              $actividadesRealizadas = ControladorSubActividades::ctrMostrarSubActividadesRealizadas($item, $valor, $ordenar, $modo, $base, $tope);
              
             ?>
            
            <div class="active tab-pane" id="actividadesRealizadas">

              <?php 

              if (count($actividadesRealizadas) == 0) {
                
                echo'
                  <h1 class="text-center text-muted">Sin Actividades Realizadas</h1>
                  <h3 class="text-muted text-center"> <strong>TUTORIAS</strong> <small> TESVG </small></h3>
                ';

              } else {

            foreach ($actividadesRealizadas as $key => $value){

             # ==================================
             # =OBTENIENDO DATOS DE LA ACTIVIDAD=
             # ==================================
             $itemActividad = "id";

             $valorActividad = $value["id_actividad"];

             $actividad = ControladorSubActividades::ctrMostrarSubActividades($itemActividad, $valorActividad);  
             
              echo '
             
              <div class="post">
                
                <div class="user-block">
                  
                  <img class="img-circle img-bordered-sm" src="'.$servidor.$actividad["imagen"].'">

                  <span class="username">
                    
                      <a href="#"><span>'.$actividad["nombre"].'</span></a>
               
                      <a target="_black" href="'.$url.$value["ruta"].'">
               
                         <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</button>
               
                      </a>
                  
                  </span>
                    
                  <span class="description">Realizada - '.$actividad["fecha"].'</span>

                </div>

                <p>'.$actividad["actividades"].'</p>

                <ul class="list-inline">
                  
                  <li>';

                  $itemComentario = "id_subactividad";

                  $valorComentario = $actividad["id"];
                  
                  $comentario = ControladorAlumnos::ctrMostrarComentariosSubActividades($itemComentario, $valorComentario);
                  
                  $clase = "";

                  if ($comentario["estadoActividad"] == 0) {

                     $clase = "btn-warning";
                     
                     $icono = '<i class="fa fa-thumbs-o-down"></i> Sin Revisar';
                                        
                  } else {
                    
                    $clase = "btn-success";
                    
                    $icono = '<i class="fa fa-thumbs-o-up"></i> Revisada';
                  
                  }
                      
                    echo '
                    
                    <a class="link-black text-sm">
                   
                      <button type="button" style="color:#fff" class="btn btn-default btn-xs '.$clase.' actividadRevisada" id="'.$comentario["id"].'" estadoActividad="'.$comentario["estadoActividad"].'">

                        '.$icono.'
                    
                      </button>
                    
                    </a>
              
                  </li>

                </ul>

                <form class="form-horizontal" method="POST">
                 
                  <div class="form-group margin-bottom-none">
                 
                    <div class="col-sm-9">
  
                      <input style="font-size: 15px" name="mensaje" class="form-control input-sm" placeholder="Escribe un mensaje" value="'.$comentario["mensaje"].'">

                      <input type="hidden" name="idComentario" value="'.$comentario["id"].'">

                      <input type="hidden" name="idAlumno" value="'.$alumno["id"].'">
                 
                    </div>
                 
                    <div class="col-sm-3">';

                        if ($comentario["mensaje"] == "") {
                         
                          echo '  
                            
                              <button type="submit" class="btn btn-danger pull-right btn-block btn-sm editarMensaje">

                                 <i class="fa fa-send" aria-hidden="true"></i> ENVIAR 

                              </button>

                          '; }

                        else {

                            echo '  
                            
                              <button type="submit" class="btn btn-success pull-right btn-block btn-sm editarMensaje">

                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDITAR 

                                </button>

                            ';

                        }

                      ?>

                    </div>
                 
                  </div>

                  <?php 

                    $comentario = new ControladorAlumnos();

                    $comentario -> ctrActualizarComentarioSubActividad();

                  ?>
               
                </form>

              </div>

              <?php }

              } 

            ?>

            </div>


            <div class="tab-pane" id="actividadesPendientes">

                <?php 

                  # ============================
                  # = TODAS LAS ACTIVIDADES    =
                  # ============================
                  $itemSubActividad = "id_tutor";

                  $valorSubActiviad = $_SESSION["id"];
                  
                  $subActividades = ControladorSubActividades::ctrMostrarTodasSubActividades($itemSubActividad, $valorSubActiviad);
                 

                 # ============================
                 # = ACTIVIDADES REALIZADAS   =
                 # ============================
                  $item = "id_alumno";

                  $valor = $alumno["id"];

                  $ordenar = "id";

                  $modo = "DESC";

                  $base = 0;

                  $tope = count($subActividades);

                  //ENVIANDO SOLO POR ALUMNO Y CATEGORIA
                  $actividadesRealizadas = ControladorSubActividades::ctrMostrarSubActividadesRealizadas($item, $valor, $ordenar, $modo, $base, $tope);
                

                  if (count($actividadesRealizadas) == count($subActividades)) {
                  
                    echo '  

                       <h1 class="text-center text-muted">Sin Actividades Pendientes</h1>
                       <h3 class="text-muted text-center"> <strong>TUTORIAS</strong> <small> TESVG </small></h3>

                    ';
                  
                  } else {

                    $realizadas = array();

                    $sinRealizar = array();

                    # ============================
                    # = ACTIVIDADES REALIZADAS   =
                    # ============================
                    foreach ($subActividades as $key => $value) {

                      array_push($sinRealizar, $value["id"]);

                      foreach ($actividadesRealizadas as $key => $value1){

                        if ($value["id"] == $value1["id_actividad"]) {

                          array_push($realizadas, $value["id"]);
                          
                         }

                       }
                      
                    }

                    $pendientes = array_diff($sinRealizar, $realizadas);
                    

                    # ===============================
                    # TOMA EL PRIMER INDICE DEL ARRAY
                    # ===============================
                    if (!function_exists('array_key_first')) {
                        
                        function array_key_first($pendientes)
                        {
                            if (count($pendientes)) {
                                reset($pendientes);
                                return key($pendientes);
                            }

                            return null;
                        }
                    }

                    $firstKey = array_key_first($pendientes);


                    # ===============================
                    # TOMA EL ULTIMO INDICE DEL ARRAY
                    # ===============================
                    if (!function_exists('array_key_last')) {
      
                        function array_key_last($array) {
                            $key = NULL;

                            if(is_array($array)) {

                                end($array);
                                
                                $key = key( $array );
                            }

                            return $key;
                        }
                    }
                    
                    $lastKey = array_key_last($pendientes);
                    
                    $actividadesPendientes = array();
                    
                    $item = "id";
                
                    for ($i=$firstKey; $i <=$lastKey; $i++) { 
                      
                      $valor = $pendientes[$i];

                      $subActividades = ControladorSubActividades::ctrMostrarSubActividadesPendientes($item, $valor);
                      
                      foreach ($subActividades as $key => $value) {
                        
                         array_push($actividadesPendientes, $value);
                      
                      }
                    
                    }

                    foreach ($actividadesPendientes as $key => $value) {

                      echo'
                      
                      <div class="post">
                      
                      <div class="user-block">
                        
                        <img class="img-circle img-bordered-sm" src="'.$servidor.$value["imagen"].'" alt="">

                        <span class="username">
                          
                            <a href="#">'.$value["nombre"].'</a>
                            
                            <a target="_black" href="'.$servidor.$value["ruta_archivo"].'">

                            <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</button>
                            
                            </a>

                        </span>
                          
                        <span class="description">Cargada - '.$value["fecha"].'</span>

                      </div>

                      <h3>Objetivo</h3>

                      <p>'.$value["objetivo"].'</p>

                      <form class="form-horizontal">
                       
                        <div class="form-group margin-bottom-none">
                       
                          <div class="col-sm-9">
                       
                            <input readonly class="form-control input-sm" placeholder="Escribe un mensaje">
                       
                          </div>
                       
                          <div class="col-sm-3">
                       
                            <button type="submit"  class="btn btn-danger pull-right btn-block btn-sm hidden"> Enviar Recordatorio</button>
                       
                          </div>
                       
                        </div>
                     
                      </form>

                    </div>';

                  }

                 } ?>
              

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>
 
</div>

