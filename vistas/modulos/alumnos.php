<?php 
  
  $servidor = Ruta::ctrRutaServidor();

  $url = Ruta::ctrRuta();

 ?>

<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Alumnos
    
      <small>Panel de Control</small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">Alumnos</li>
    
    </ol>

  </section>


  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAlumno"> <i class="fa fa-user-plus"></i> Agregar Alumno </button>

      </div>
      
      <div class="box-body">
      
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead> 

            <tr>
              
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th style="width: 25px" class="text-center">Actividades</th>
              <th>N. de Control</th>
              <th>Carrera</th>
              <th>Tutor</th>
              <th>Grupo</th>
              <th>Email</th>
              <th>Imagen</th>
              <th>Activo</th>
              <th>Acciones</th>

            </tr>
  
          </thead>

          <tbody>
            

            <?php 

               
            # ======================================
            # = DE ACUERDO AL TIPO DE PERFIL       =
            # ======================================
            $perfil = $_SESSION["perfil"];

            if ($perfil == 1 || $perfil == 2) {
              
              $item = "id_carrera";

              $valor = $_SESSION["carrera"];

            } else {

              $item = "id_tutor";

              $valor = $_SESSION["id"];

            }

            $alumnos = ControladorAlumnos::ctrMostrarAlumnosbyPerfil($item, $valor);
            

              foreach ($alumnos as $key => $value) {

                echo '

                      <tr>
        
                        <td>'.($key+1).'</td>
                        
                        <td>'.$value["nombre"].'</td>

                        <td>'.$value["apellidos"].'</td>

                        <td class="text-center"><button class="btn btn-primary btn-sm btnActividades" idAlumno="'.$value["id"].'"><i class="fa fa-eye"></i> Ver</button></td>
                        
                        <td>'.$value["numeroControl"].'</td>';

                        $item = "id";

                        $valor = $value["id_carrera"];

                        $carrera = ControladorCarreras::ctrMostrarCarreras($item, $valor);

                        echo '

                        <td>'.$carrera["descripcion"].'</td>';

                        $item = "id";

                        $valor = $value["id_tutor"];

                        $tutor = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        echo '

                        <td>'.$tutor["nombre"]." ".$tutor["apellidos"].'</td>';

                        $item = "id";

                        $valor = $value["id_grupo"];

                        $grupo = ControladorGrupos::ctrMostrarGrupos($item, $valor);

                        echo'

                        <td>'.$grupo["nombre"].'</td>

                        <td>'.$value["email"].'</td>';

                        if ($value["foto"] != "") {
                          echo ' 
                          
                            <td><img src="'.$url.$value["foto"].'" class="img-thumbnail" width="40px" alt=""></td>
                          ';
                        } else {

                          echo '
                            
                           <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" alt=""></td>
                         
                          ';

                        } 

                        $estado = $value["activo"];

                        if ($estado == 1 ) {
                        
                          echo '

                           <td><button class="btn btn-success btn-sm btnActivarAlumno" estadoAlumno="0" idAlumno="'.$value["id"].'">Activo</button></td>
                             
                          ';

                        } else {

                           echo '

                           <td><button class="btn btn-danger btn-sm btnActivarAlumno" estadoAlumno="1" idAlumno="'.$value["id"].'">Inactivo</button></td>
                             
                          '; 

                        } echo '
                              
                        <td>
                          
                          <div class="btn-group">
                            
                            <button class="btn btn-warning btnEditarAlumno" data-toggle="modal" idAlumno="'.$value["id"].'" data-target="#modalEditarAlumno"><i class="fa fa-pencil"></i></button>
                            
                            <button class="btn btn-danger btnEliminarUsuario" usuario="'.$value["numeroControl"].'" idUsuario = "'.$value["id"].'" fotoUsuario="'.$value["foto"].'"><i class="fa fa-times"></i></button>

                          </div>

                        </td>

                      </tr>
                  
                  ';
              
                }

             ?>

          </tbody>

        </table>
      
      </div>
     

    </div>
    
  </section>
  
</div>
<!-- /.content-wrapper -->


<!--=============================
= VENTANA MODAL NUEVO ALUMNO   =
===============================-->
<div id="modalAgregarAlumno" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-user-plus"></i> </span> Agregar Alumno</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- Entrada para el Nombre -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="nuevoNombre" placeholder="Ingresar Nombre" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para los Apellidos -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="nuevoApellidos" placeholder="Ingresar Apellidos" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para Número de Control -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" maxlength="10" name="nuevoNumeroControl" id="nuevoNumeroControl" placeholder="Ingresar Número de Control" required class="form-control input-lg">   

              </div>
              
            </div> 

            
            <!-- Entrada para la Carrera-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>

                <select name="nuevaCarrera" id="nuevaCarreraAlumno" class="form-control input-lg">
                  
                  <option value="0">Seleccionar Carrera</option>

                  <?php 

                    $item = null;

                    $valor = null;

                    $carrera = ControladorCarreras::ctrMostrarCarreras($item, $valor);
        
                    foreach ($carrera as $key => $value) {
                         echo '  
                            <option value="'.$value["id"].'">'.$value["descripcion"].'</option>
                          ';
                    }

                   ?>

                </select> 

              </div>

            </div>


            <!-- Entrada para el TUTOR-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevoTutor" class="form-control input-lg">
                  
                  <option value="">Seleccionar Tutor</option>

                  <?php 

                    $item1 = "perfil";

                    $valor1 = "3";

                    $item2 = "id_carrera";

                    $valor2 = $_SESSION["carrera"];

                    $tutores = ControladorUsuarios::ctrMostrarTutores($item1, $valor1, $item2, $valor2);

                    foreach ($tutores as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["nombre"]." ".$value["apellidos"].'</option>';
                    
                    }


                   ?>

                </select> 

              </div>

            </div>

            <!-- Entrada para Grupo-->
            <div class="form-group">

              <div class="input-group grupoAlumno hidden">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevoGrupo" id="nuevoGrupoAlumno" class="form-control input-lg">
                  
                  <option value="">Seleccionar Grupo</option>

                </select> 

              </div>

            </div>

            <!-- Entrada para Email -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="nuevoEmail" id="nuevoEmail" placeholder="Ingresar email" required class="form-control input-lg">   

              </div>
              
            </div> 


            <!-- Entrada para Contraseña-->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="nuevoPassword" placeholder="Ingresar password" required class="form-control input-lg">   

              </div>
              
            </div> 

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Guardar Alumno</button>

        </div>


        <?php 

          $crearAlumno = new ControladorAlumnos();

          $crearAlumno -> ctrCrearAlumno();

         ?>
      
      </form>
    
    </div>

  </div>

</div>

<!--=============================
= VENTANA MODAL EDITAR ALLUMNO   =
===============================-->
<div id="modalEditarAlumno" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-user-plus"></i> </span> Editar Alumno</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- Entrada para el Nombre -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="editarNombre" id="editarNombre" required class="form-control input-lg">   

              </div>
              
            </div> 

            
            <!-- Entrada para el ESTADO ACTIVO/INACTIVO -->
            <input type="hidden" id="activo" name="activo">

            <input type="hidden" id="fotoActual" name="fotoActual">

            <input type="hidden" id="idAlumnoEditar" name="id">

            <!-- Entrada para los Apellidos -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="editarApellidos" id="editarApellidos" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para Número de Control -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" readonly name="editarNumeroControl" id="editarNumeroControl" required class="form-control input-lg">   
              </div>
              
            </div> 


            <!-- Entrada para el TUTOR-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="editarTutor" class="form-control input-lg">
                  
                  <option id="editarTutorAlumno" value="">Seleccionar Tutor</option>

                  <?php 

                    $item1 = "perfil";

                    $valor1 = "3";

                    $item2 = "id_carrera";

                    $valor2 = $_SESSION["carrera"];

                    $tutores = ControladorUsuarios::ctrMostrarTutores($item1, $valor1, $item2, $valor2);

                    foreach ($tutores as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["nombre"]." ".$value["apellidos"].'</option>';
                    
                    }


                   ?>

                </select> 

              </div>

            </div>


            
            <!-- Entrada para la Carrera-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="editarCarrera" id="editarCarreraAlumno" class="form-control input-lg">
                  
                  <option id="editarCarreraVal"></option>

                  <?php 

                    $item = null;

                    $valor = null;

                    $carrera = ControladorCarreras::ctrMostrarCarreras($item, $valor);
        
                    foreach ($carrera as $key => $value) {
                         echo '  
                            <option value="'.$value["id"].'">'.$value["descripcion"].'</option>
                          ';
                    }

                   ?>
                </select> 

              </div>

            </div>

            <!-- Entrada para Grupo-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="editarGrupo" id="editarGrupo" class="form-control input-lg">
  
                  <option id="editarGrupoVal"></option>

                </select> 

              </div>

            </div>

            <!-- Entrada para Email -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                   
                <input type="text" name="editarEmail" id="editarEmail" required class="form-control input-lg nuevoEmail">   

              </div>
              
            </div> 

            <input type="hidden" name="passwordActual" id="passwordActual">

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Editar Alumno</button>

        </div>


        <?php 

          $editarAlumno = new ControladorAlumnos();

          $editarAlumno -> ctrEditarAlumno();

         ?>
      
      </form>
    
    </div>

  </div>

</div>


<?php 

  // $borrarUsuario = new ControladorUsuarios();

  // $borrarUsuario -> ctrBorrarUsuario();

 ?>