<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Administrar Actividades
    
      <small>Panel de Control</small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">Sub-Actividades</li>
    
    </ol>

  </section>


  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        
        <div class="row">
        
        <div class="col-md-6">
      
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubActividad"> Agregar Sub-Actividad</button>
      
        </div>      

        <div class="col-md-6">
         
          <div class="form-group">
         
            <label>Filtrar Actividad</label>
            
            <select class="select2 form-control" style="width:100%;">

              <?php 

                $item = null;

                $valor = null;

                $actividad = ControladorActividades::ctrMostrarActividades($item, $valor);

                foreach ($actividad as $key => $value) {
                  echo '
                  <option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                }

               ?>
          
            </select>
          
          </div>
      
        </div>      

      </div>
      
       
      <div class="box-body">

          <div class="col-xs-12">

            <?php 
          
              $item = null;

              $valor = null;

              $subactividades = ControladorSubActividades::ctrMostrarSubActividades($item, $valor);
          
            ?>

            <?php foreach ($subactividades as $key => $value): ?>
            
            <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs pull-right">
            
                <li class="active"><a href="#objetivo<?php echo ($key+1);?>" data-toggle="tab">Objetivo</a></li>
            
                <li><a href="#img-texto<?php echo ($key+1);?>" data-toggle="tab">Imagen y Texto</a></li>
            
                <li><a href="#actividades<?php echo ($key+1);?>" data-toggle="tab">Actividades</a></li>
               
               
                <li><a href="#rutas<?php echo ($key+1);?>" data-toggle="tab">Ruta y Archivo</a></li>
               
               
                <li class="pull-left header"><i class="fa fa-th"></i>
                
                  <?php echo $value["nombre"]; ?>


                  <?php 

                    $itemActividad = "id"; 

                    $valorActividad = $value["id_actividad"];

                    $actividad = ControladorActividades::ctrMostrarActividades($itemActividad, $valorActividad);

                  ?>

                  <span class="text-muted" style="font-size: 10px;"> 

                    <?php echo $actividad["categoria"];?>

                  </span>
                
                </li>
             
              </ul>

             
              <div class="tab-content">
                
                <div class="tab-pane active" id="objetivo<?php echo ($key+1);?>">
               
                  <b>Objetivo</b>

                  <br>

                  <blockquote class="text-justify">
                  
                    <?php echo $value["objetivo"]; ?>

                   </blockquote>
                  
                </div>
               
                <div class="tab-pane" id="img-texto<?php echo ($key+1);?>">
              
                    <div class="row">
        
                        <div class="col-xs-12 col-sm-2">
                          
                          <img src="http://localhost/tutorias2/vistas/img/actividades/linea-vida/1.jpg" class="img-thumbnail" width="100%">

                        </div>

                        <div class="col-xs-12 col-sm-10" style="margin-top: 0px">

                          <h3>Linea de la Vida</h3>
                          
                          <blockquote class="text-justify">
        
                             <?php echo $value["textoAyuda"]; ?> 
                            
                          </blockquote>

                       </div>

                    </div>

                </div>
                
                <div class="tab-pane" id="actividades<?php echo ($key+1);?>">

                   <h3>Actividades</h3>

                   <blockquote class="text-justify">
                
                       <?php echo $value["actividades"]; ?>  
              
                   </blockquote>

                </div>

                <div class="tab-pane" id="rutas<?php echo ($key+1);?>">

                   <h3>Ruta y Archivo</h3>
                  
                    <div class="row">
                      
                     <div class="col-xs-12 col-sm-2">

                         <div class="form-group">
                          
                           <a href="">
                            
                            <button class="btn btn-primary">Descargar</button>

                           </a>
                          
                          <p class="help-block"><?php echo $value["nombre"];?></p>
              
                        </div>

                      </div> 

                      <div class="col-xs-12 col-sm-2">
                    
                        <div class="input-group">
                         
                          <span class="input-group-addon">Ruta</span>
                         
                          <input type="text" class="form-control" readonly value="<?php echo $value["ruta"];?>">
                       
                        </div>

                      </div>

                    </div>

                </div>
               
              </div>
              
            </div>

            <?php endforeach; ?>
           
          </div>
         
      </div>

    </div>
    
  </section>
  
</div>


<!--=============================
= VENTANA MODAL NUEVA CATEGORÍA   =
===============================-->
<div id="modalAgregarSubActividad" class="modal fade" role="dialog">
  
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