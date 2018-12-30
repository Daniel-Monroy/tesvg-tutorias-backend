<?php 

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

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

            <p class="text-muted text-center"><?php echo $alumno["carrera"];?></p>


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

                <a class="pull-right">12-12-2018 10:00:00</a>

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
             ?>
            
            <div class="active tab-pane" id="actividadesRealizadas">

              <?php foreach ($actividadesRealizadas as $key => $value): 


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
                    
                      <a target="_black" href="<?php echo $url.$actividad["ruta_archivo"];?> ">
                         <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</button>
                      </a>
                  
                  </span>
                    
                  <span class="description">Realizada - <?php echo $actividad["fecha"];?></span>

                </div>

                <p><?php echo $actividad["actividades"];?></p>

                <ul class="list-inline">
                  
                  <li>
                  
                    <a href="" class="link-black text-sm">
                      
                      <i class="fa fa-thumbs-o-up"></i>
                      Revisada
                    </a>
                  
                  </li>

                </ul>

                <form class="form-horizontal">
                 
                  <div class="form-group margin-bottom-none">
                 
                    <div class="col-sm-9">
                 
                      <input class="form-control input-sm" placeholder="Escribe un mensaje">
                 
                    </div>
                 
                    <div class="col-sm-3">
                 
                      <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Responder</button>
                 
                    </div>
                 
                  </div>
               
                </form>

              </div>

              <?php endforeach ?>

            </div>

            <div class="tab-pane" id="actividadesPendientes">
              
              <div class="post">
                
                <div class="user-block">
                  
                  <img class="img-circle img-bordered-sm" src="vistas/img/usuarios/default/anonymous.png" alt="">

                  <span class="username">
                    
                      <a href="#">Linea de la Vida.</a>
                    
                      <button class="btn btn-primary pull-right"><i class="fa fa-download"></i> Recordar</button>
                  
                  </span>
                    
                  <span class="description">Cargada - 24-11-2018 11:00:00</span>

                </div>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non minima vero quo voluptatem unde, officiis harum neque veritatis quas commodi necessitatibus architecto tempora, dolor facere repudiandae voluptatibus obcaecati distinctio laboriosam.</p>

                <form class="form-horizontal">
                 
                  <div class="form-group margin-bottom-none">
                 
                    <div class="col-sm-9">
                 
                      <input class="form-control input-sm" placeholder="Escribe un mensaje">
                 
                    </div>
                 
                    <div class="col-sm-3">
                 
                      <button type="submit" class="btn btn-danger pull-right btn-block btn-sm"> Enviar Mensaje</button>
                 
                    </div>
                 
                  </div>
               
                </form>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>
 
</div>

