<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Administrar Actividades
    
      <small>Panel de Control</small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>


  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarActividad"> Agregar Actividad</button>

      </div>
      
      <div class="box-body">
      
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead> 

            <tr>
              
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Ruta</th>
              <th>Acciones</th>

            </tr>
  
          </thead>

          <tbody>
            
            <?php 

              $item = null;

              $valor = null;

              $actividades = ControladorActividades::ctrMostrarActividades($item, $valor);

              $contador = 1;

              foreach ($actividades as $key => $value) {

                echo '   <tr>
  
                          <td>'.($key+1).'</td>
                          <td class="text-uppercase">'.$value["categoria"].'</td>
                          <td class="">'.$value["ruta"].'</td>
                          <td>
                            <div class="btn-group">
                              
                              <button class="btn btn-warning btnEditarActividad" idActividad="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarActividad"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger btnEliminarActividad" idActividad="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
= VENTANA MODAL NUEVA CATEGORÍA   =
===============================-->
<div id="modalAgregarActividad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Agregar Actividad</h4>

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
                   
                <input type="text" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para la Ruta -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="nuevaActividadRuta" id="nuevaActividadRuta" placeholder="Ingresar Ruta" required class="form-control input-lg">   

              </div>
              
            </div> 

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Guardar Actividad</button>

        </div>

        <?php 

          $crearActividad = new ControladorActividades();

          $crearActividad -> ctrCrearActividad();


         ?>
      
      </form>
    
    </div>

  </div>

</div>

<!--=============================
= VENTANA MODAL EDITAR ACTIVIDAD=
===============================-->
<div id="modalEditarActividad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Editar Actividad</h4>

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
                   
                <input type="text" name="editarActividad" id="editarActividad" placeholder="Editar Actividad" required class="form-control input-lg">   

                <input type="hidden" name="idActividad" id="idActividad">   

              </div>
              
            </div> 

            <!-- Entrada para la Ruta -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <input type="text" name="editarActividadRuta" id="editarActividadRuta" readonly placeholder="Editar Ruta" required class="form-control input-lg">   

              </div>
              
            </div> 

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Editar Actividad</button>

        </div>

        <?php 

          $editarActividad = new ControladorActividades();

          $editarActividad -> ctrEditarActividad();

         ?>
      
      </form>
    
    </div>

  </div>

</div>

<?php 
  # ========================================
  # = BORRAR CATEGORÍA           =
  # ========================================
  $eliminarActividad = new ControladorActividades();

  $eliminarActividad -> ctrEliminarActividad();

?>