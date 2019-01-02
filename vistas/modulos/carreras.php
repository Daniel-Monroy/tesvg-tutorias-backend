<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Administrar Carreras
    
      <small>Panel de Control</small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">carreras</li>
    
    </ol>

  </section>


  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCarrera"> Agregar Carrera</button>

      </div>
      
      <div class="box-body">
      
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead> 

            <tr>
              
              <th style="width: 10px">#</th>
              <th>Carrera</th>
              <th>Descripción</th>
              <th>Jefe de División</th>
              <th>Coordinador</th>
              <th>Acciones</th>

            </tr>
  
          </thead>

          <tbody>
            
            <?php 

              $item = null;

              $valor = null;

              $grupos = ControladorCarreras::ctrMostrarCarreras($item, $valor);

              foreach ($grupos as $key => $value) {

                echo '   <tr>
  
                          <td>'.($key+1).'</td>
                          <td class="text-uppercase">'.$value["carrera"].'</td>
                          <td class="">'.$value["descripcion"].'</td>';

                          $item = "id";

                          $valor = $value["id_jefe"];

                          $jefeDeDivicion = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                          echo '

                          <td class="">'.$jefeDeDivicion["nombre"]." ".$jefeDeDivicion["apellidos"].'</td>

                          ';

                          $item = "id";

                          $valor = $value["id_coordinador"];

                          $coordinador = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                            echo '

                            <td class="">'.$coordinador["nombre"]." ".$coordinador["apellidos"].'</td>

                          <td>

                            <div class="btn-group">
                              
                              <button class="btn btn-warning btnEditarCarrera" idCarrera="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCarrera"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger btnEliminarCarrera" idCarrera="'.$value["id"].'"><i class="fa fa-times"></i></button>

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


<!--=========================
= VENTANA MODAL NUEVA CARRERA=
==========================-->
<div id="modalAgregarCarrera" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Agregar Carrera</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- Entrada para el Nombre -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="nuevaCarrera" id="nuevaCarrera" placeholder="Ingresa la Carrera ejemplo I.S.C" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para la Descripción -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="nuevaDescripcionCarrera" id="nuevaDescripcionCarrera" placeholder="Ingresar Descripción" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para el Jefe de Divicion-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevoJefe" id="nuevoJefeCarrera" required class="form-control input-lg">
                  
                  <option value="">Seleccionar Jefe de División</option>
                  
                  <?php 

                    $item = "perfil";

                    $valor = "jefeDeDivision";

                    $jefeDeDivicion = ControladorUsuarios::ctrMostrarVariosUsuarios($item, $valor);

                    foreach ($jefeDeDivicion as $key => $value) {
                     
                       echo '<option value="'.$value["id"].'">'.$value["nombre"]." ".$value["apellidos"].'</option>';
                     
                     } 

                   ?>
                    
                </select> 

              </div>

            </div>


            <!-- Entrada para el Coordinador-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevoCoordinadorCarrera" id="nuevoCoordinadorCarrera" required class="form-control input-lg">
                  
                  <option value="">Seleccionar Coordinador</option>
                  
                  <?php 

                    $item = "perfil";

                    $valor = "coordinador";

                    $jefeDeDivicion = ControladorUsuarios::ctrMostrarVariosUsuarios($item, $valor);

                    foreach ($jefeDeDivicion as $key => $value) {
                     
                       echo '<option value="'.$value["id"].'">'.$value["nombre"]." ".$value["apellidos"].'</option>';
                     
                     } 

                   ?>
                    
                </select> 

              </div>

            </div>

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Guardar Carrera</button>

        </div>

        <?php 

            $crearCarrera = new ControladorCarreras();

            $crearCarrera -> ctrCrearCarrera();

         ?>
      
      </form>
    
    </div>

  </div>

</div>


<!--=========================
= VENTANA MODAL EDITAR CARRERA=
==========================-->
<div id="modalEditarCarrera" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Editar Carrera</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- Entrada para el Nombre -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="editarCarrera" id="editarCarrera" placeholder="Editar la Carrera ejemplo I.S.C" required class="form-control input-lg"> 

                <input type="hidden" name="idCarrera" id="idCarrera">
                <input type="hidden" id="carreraActual">  

                <!-- Jefe de Divición -->  
                <input type="hidden" id="editarJefeCarreraValHidden"> 
                <input type="hidden" id="editarJefeCarreraHtmlHidden">

                <!-- Jefe de Cooirdinador -->  
                <input type="hidden" id="editarCoordinadorCarreraValHidden"> 
                <input type="hidden" id="editarCoordinadorCarreraHTMLHidden">         

              </div>
              
            </div> 

            <!-- Entrada para la Descripción -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="editarDescripcionCarrera" id="editarDescripcionCarrera" placeholder="Editar Descripción" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para el Jefe de Divicion-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="editarJefe" required id="editarJefeCarrera" class="form-control input-lg">
                  
                  <option id="editarJefeCarreraVal">Editar Jefe de División</option>
                  
                  <?php 

                    $item = "perfil";

                    $valor = "jefeDeDivision";

                    $jefeDeDivicion = ControladorUsuarios::ctrMostrarVariosUsuarios($item, $valor);

                    foreach ($jefeDeDivicion as $key => $value) {
                     
                       echo '<option value="'.$value["id"].'">'.$value["nombre"]." ".$value["apellidos"].'</option>';
                     
                     } 

                   ?>
                    
                </select> 

              </div>

            </div>


            <!-- Entrada para el Coordinador-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="editarCoordinadorCarrera" id="editarCoordinadorCarrera" required class="form-control input-lg">
                  
                  <option id="editarCoordinadorCarreraVal">Editar Coordinador</option>
                  
                  <?php 

                    $item = "perfil";

                    $valor = "coordinador";

                    $jefeDeDivicion = ControladorUsuarios::ctrMostrarVariosUsuarios($item, $valor);

                    foreach ($jefeDeDivicion as $key => $value) {
                     
                       echo '<option value="'.$value["id"].'">'.$value["nombre"]." ".$value["apellidos"].'</option>';
                     
                     } 

                   ?>
                    
                </select> 

              </div>

            </div>

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Editar Carrera</button>

        </div>

        <?php 

              $editarCarrera = new ControladorCarreras();

              $editarCarrera -> ctrEditarCarrera();

         ?>
      
      </form>
    
    </div>

  </div>

</div>


<?php 
  # ==================
  # = ELIMINAR CARRERA
  # ==================
  $eliminarCarrera = new ControladorCarreras();

  $eliminarCarrera -> ctrEliminarCarrera();

?>