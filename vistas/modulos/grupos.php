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
              <th>Acciones</th>

            </tr>
  
          </thead>

          <tbody>
            
            <?php 

              // $item = null;

              // $valor = null;

              // $actividades = ControladorActividades::ctrMostrarActividades($item, $valor);

              // $contador = 1;

              // foreach ($actividades as $key => $value) {

              //   echo '   <tr>
  
              //             <td>'.($key+1).'</td>
              //             <td class="text-uppercase">'.$value["categoria"].'</td>
              //             <td class="">'.$value["ruta"].'</td>
              //             <td>
              //               <div class="btn-group">
                              
              //                 <button class="btn btn-warning btnEditarActividad" idActividad="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarActividad"><i class="fa fa-pencil"></i></button>
              //                 <button class="btn btn-danger btnEliminarActividad" idActividad="'.$value["id"].'"><i class="fa fa-times"></i></button>

              //               </div>

              //             </td>

              //           </tr>
              //   ';
                
              // }

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
                   
                <input type="text" name="nuevoGrupo" id="nuevoGrupo" placeholder="Ingresar Grupo" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para la Carrera-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevaCarrera" class="form-control input-lg">
                  
                  <option value="">Seleccionar Carrera</option>

                  <option value="ISC">I.S.C.</option>

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

          // $crearGrupo = new ControladorGrupos();

          // $crearGrupo -> ctrCrearGrupo();


         ?>
      
      </form>
    
    </div>

  </div>

</div>

<!--=========================
= VENTANA MODAL EDITAR GRUPO =
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

          <h4 class="modal-title"><span> <i class="fa fa-th"></i> </span> Editar Grupo</h4>

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
                   
                <input type="text" name="editarGrupo" id="editarGrupo" placeholder="Ingresar Grupo" required class="form-control input-lg">   

              </div>
              
            </div> 

            <!-- Entrada para la Carrera-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="editarCarrera" class="form-control input-lg">
                  
                  <option value="" id="editarCarrera">Seleccionar Carrera</option>

                  <option value="ISC">I.S.C.</option>

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

          // $editar = new ControladorGrupos();

          // $editar -> ctrEditarGrupo();


         ?>
      
      </form>
    
    </div>

  </div>

</div>


<?php 
  # ========================================
  # = BORRAR GRUPO           =
  # ========================================
  // $eliminarGrupo = new ControladorGrupos();

  // $eliminarGrupo -> ctrEliminarGrupos();

?>