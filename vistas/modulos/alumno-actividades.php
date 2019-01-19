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
         
         ?>
        
        <!-- Perfil -->
        <div class="box box-primary">

          <div class="box-body box-profile">
            
            <img src="<?php echo $url.$alumno["foto"];?> " class="profile-user-img img-responsive img-circle">

            <h3 class="profile-username text-center"> <?php echo $alumno["nombre"]." ".$alumno["apellidos"];?> </h3>

            
            <?php 

              $itemCarrera = "id";

              $valorCarrera = $alumno["id_carrera"];

              $respuestaCarrera = ControladorCarreras::ctrMostrarCarreras($itemCarrera, $valorCarrera);

             ?>

            <p class="text-muted text-center"><?php echo $respuestaCarrera ["descripcion"];?></p>


            <ul class="list-group list-group-unbordered">
              
              <li class="list-group-item">
                
                <b>Actividades Realizadas</b>

                <a class="pull-right">12</a>

              </li>

              <li class="list-group-item">
                
                <b>Actividades Pendientes</b>

                <a class="pull-right">12</a>

              </li>

              <li class="list-group-item">
                
                <b>Ultimo Login</b>

                <a class="pull-right"><?php echo $alumno["ultimo_login"];?></a>

              </li>

            </ul>
            
          </div>

        </div>
        <!-- Perfil -->

        <!-- Acerca de Él -->
        <div class="box box-primary">
  
          <div class="box-header with-border">
            
            <h3 class="box-title">Acerca de Él</h3>  

          </div>  

          <div class="box-body">
            
            <strong><i class="fa fa-book margin-r-5"></i>Educación</strong>
              
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis asperiores nihil dolore, maiores officiis a, esse nesciunt impedit praesentium ratione voluptatem fugit laborum aliquam, tempore facilis perspiciatis eius ut obcaecati. </p>    

            <hr>

            <strong><i class="fa fa-book margin-r-5"></i>Educación</strong>
              
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

              $itemActividadRealizadas = "id_alumno";

              $valorActividadRealizadas = $alumno["id"];

              $actividadesRealizadas = ControladorAlumnos::ctrMostrarActividadesRealizadas($itemActividadRealizadas, $valorActividadRealizadas); 

              $idActividadesRealizadas = array();

             ?>
            
            <div class="active tab-pane" id="actividadesRealizadas">

              <?php 

              if (count($actividadesRealizadas) == 0) {
              
              echo "<h1> No ha realizado ninguna Actividad </h1>";

              } else {

               foreach ($actividadesRealizadas as $key => $value): 


                array_push($idActividadesRealizadas, $value["id"]);

                # ==================================
                # =OBTENIENDO DATOS DE LA ACTIVIDAD=
                # ==================================
                 $itemActividad = "id";

                 $valorActividad = $value["id_actividad"];

                 $actividad = ControladorSubActividades::ctrMostrarSubActividades($itemActividad, $valorActividad);  

                ?>

              <div class="post">
                
                <div class="user-block">
                  
                  <img class="img-circle img-bordered-sm" src="<?php echo $servidor.$actividad["imagen"];?> ">

                  <span class="username">
                    
                      <a href="#"><span><?php echo $actividad["nombre"];?></span></a>
               
                      <a target="_black" href="<?php echo $url.$value["ruta "];?> ">
               
                         <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</button>
               
                      </a>
                  
                  </span>
                    
                  <span class="description">Realizada - <?php echo $actividad["fecha"];?></span>

                </div>

                <p><?php echo $actividad["actividades"];?></p>

                <ul class="list-inline">
                  
                  <li>

                    <?php

                      $itemComentario = "id_subactividad";

                      $valorComentario = $value["id"];

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
                       
                          <button type="button" style="color:#fff" class="btn btn-default btn-xs '.$clase.' actividadRevisada" id="'.$comentario["id"].'" estadoActividad="'.$comentario["estadoActividad"].'">';

                            echo $icono;
                           
                          echo '  
                          
                          </button>
                        
                        </a>

                      ';

                     ?>
              
                  </li>

                </ul>

                <form class="form-horizontal" method="POST">
                 
                  <div class="form-group margin-bottom-none">
                 
                    <div class="col-sm-9">
  
                      <input style="font-size: 15px" name="mensaje" class="form-control input-sm" placeholder="Escribe un mensaje" value="<?php echo $comentario["mensaje"] ?>">

                      <input type="hidden" name="idComentario" value="<?php echo $comentario["id"]?>">
                 
                    </div>
                 
                    <div class="col-sm-3">


                      <?php 

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

              <?php endforeach; } ?>

            </div>



            <?php 

              $itemActividadesPendientes = "id_grupo"; 

              $valorActividadesPendietes = $alumno["id_grupo"];

              $actividadesPendientes = ControladorSubActividades::ctrMostrarSubActividadesCategoria($itemActividadesPendientes, $valorActividadesPendietes);
            ?>


            <div class="tab-pane" id="actividadesPendientes">
                    
                <?php 

                #Verificando la cantidad de actividades Pendientes
                if (count($actividadesPendientes) == count($actividadesRealizadas) ) {
                   echo "<h1>Sin Actividades Pendientes</h1>";
                } 

               if (count($actividadesRealizadas) != count($actividadesPendientes) && 
                   count($actividadesRealizadas) != 0 && 
                   count($actividadesPendientes) > 0) {

                foreach ($actividadesPendientes as $key => $value) {

                  foreach ($actividadesRealizadas as $key => $value1) { 

                    if ($value1["id_actividad"] != $value["id_actividad"]) { ?>

                    <div class="post">
                      
                      <div class="user-block">
                        
                        <img class="img-circle img-bordered-sm" src="<?php echo $servidor.$value["imagen"];?>" alt="">

                        <span class="username">
                          
                            <a href="#"><?php echo $value["nombre"]; ?></a>
                            
                            <a target="_black" href="<?php echo $servidor.$value["ruta_archivo"];?>">

                            <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</button>
                            
                            </a>

                        </span>
                          
                        <span class="description">Cargada - <?php echo $value["fecha"]; ?></span>

                      </div>

                      <h3>Objetivo</h3>

                      <p><?php echo $value["objetivo"]; ?></p>

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

                    </div>
                
                <?php 
                      }

                    }

                  } 

                } else {

                  if (count($actividadesPendientes) != count($actividadesRealizadas) ) {
                   
                  foreach ($actividadesPendientes as $key => $value) { ?>
                    
                     <div class="post">
                      
                        <div class="user-block">
                          
                          <img class="img-circle img-bordered-sm" src="<?php echo $servidor.$value["imagen"];?>" alt="">

                          <span class="username">
                            
                              <a href="#"><?php echo $value["nombre"]; ?></a>
                              
                              <a target="_black" href="<?php echo $servidor.$value["ruta_archivo"];?>">

                              <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</button>
                              
                              </a>

                          </span>
                            
                          <span class="description">Cargada - <?php echo $value["fecha"]; ?></span>

                        </div>

                        <h3>Objetivo</h3>

                        <p><?php echo $value["objetivo"]; ?></p>

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

                     </div>

                  <?php }

                  } 

                }?> 

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>
 
</div>

