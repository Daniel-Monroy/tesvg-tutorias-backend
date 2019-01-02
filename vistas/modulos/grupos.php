<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Administrar Grupos
    
      <small>Panel de Control</small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">grupos</li>
    
    </ol>

  </section>


  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGrupo"> Agregar Grupo</button>

      </div>
      
      <div class="box-body">
      
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead> 

            <tr>
              
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Carrera</th>  
              <th width="10px">Actividades</th>
              <th>Acciones</th>

            </tr>
  
          </thead>

          <tbody>
            
            <?php 

              $item = null;

              $valor = null;

              $grupos = ControladorGrupos::ctrMostrarGrupos($item, $valor);

              foreach ($grupos as $key => $value) {

                echo '   <tr>
  
                          <td>'.($key+1).'</td>
                          
                          <td class="text-uppercase">'.$value["nombre"].'</td>';

                          $item = "id";

                          $valor = $value["id_carrera"];

                          $carrera = ControladorCarreras::ctrMostrarCarreras($item, $valor);

                          echo '
                          <td class="">'.$carrera["descripcion"].'</td>
                         
                          <td class="text-center"><button class="btn btn-primary btn-sm btnActividadesGrupo" idGrupo="'.$value["id"].'"><i class="fa fa-eye"></i> Ver</button></td>

                          <td>
                            <div class="btn-group">
                              
                              <button class="btn btn-warning btnEditarGrupo" idGrupo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarGrupo"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger btnEliminarGrupo" idGrupo="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
= VENTANA MODAL NUEVO GRUPO =
==========================-->
<div id="modalAgregarGrupo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Agregar Grupo</h4>

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
                   
                <input type="text" name="nuevoGrupo" maxlength="3" placeholder="Ingresar Grupo" required class="form-control input-lg nuevoGrupo">   

              </div>
              
            </div> 

            <!-- Entrada para la Carrera-->
            <div class="form-group">

              <div class="input-group hidden selectCarrera">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevaCarreraGrupo" required class="form-control input-lg nuevaCarreraGrupo">
                  
                  <option value="" class="nuevaCarreraValue">Seleccionar Carrera</option>

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

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Guardar Grupo</button>

        </div>

        <?php 

          $crearGrupo = new ControladorGrupos();

          $crearGrupo -> ctrCrearGrupo();

         ?>
      
      </form>
    
    </div>

  </div>

</div>


<!--=========================
= VENTANA MODAL EDITAR GRUPO =
==========================-->
<div id="modalEditarGrupo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Editar Grupo</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- Entrada para el Nombre -->
            <div class="form-group">
              
              <div class="input-group selectCarrera">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="editarGrupo" required class="form-control input-lg editarGrupo"> 
  
                <input type="hidden" id="editarGrupoActual"> 

                <input type="hidden" name="idGrupo" id="idGrupo"> 

              </div>
              
            </div> 

            <!-- Entrada para la Carrera-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>

                <input type="hidden" id="valorCarreraActual">

                <input type="hidden" id="htmlCarreraActual">
                   
                <select name="editarCarrera" class="form-control input-lg editarCarrera">
                  
                  <option value="" id="editarCarrera"></option>

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

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Editar Grupo</button>

        </div>

        <?php 

          $editar = new ControladorGrupos();

          $editar -> ctrEditarGrupo();

         ?>
      
      </form>
    
    </div>

  </div>

</div>


<?php 
  # ========================================
  # = BORRAR GRUPO           =
  # ========================================
  $eliminarGrupo = new ControladorGrupos();

  $eliminarGrupo -> ctrEliminarGrupo();

?>