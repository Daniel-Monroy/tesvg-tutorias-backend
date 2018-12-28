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
               
                <li><a href="#acciones<?php echo ($key+1);?>" data-toggle="tab">Acciónes</a></li>
               
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

                <div class="tab-pane" id="acciones<?php echo ($key+1);?>">
                
                  <div class="row">
                    
                      <div class="col-xs-12 col-sm-2">

                         <button class="btn btn-warning btnEditarSubActividad" data-toggle="modal" data-target="#modalEditarSubActividad" idSubActividad="<?php echo $value["id"]?>"><i class="fa fa-edit"></i> Editar Sub-Actividad</button>

                      </div>

                      <div class="col-xs-12 col-sm-2">

                         <button class="btn btn-danger"><i class="fa fa-times"></i> Eliminar Sub-Actividad</button>

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
= VENTANA MODAL NUEVA SUB-ACTIVIDAD
===============================-->
<div id="modalAgregarSubActividad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-user-plus"></i> </span> Agregar Sub-Actividad</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- Entrada para Seleccion de Categoría Actividad-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <select name="nuevaActividad" style="width: 100%" required class="form-control input-lg select2" id="nuevaActividad">
                  
                  <option value="">Seleccionar Categoria</option>

                  <?php 

                    $item = null;

                    $valor = null;

                    $actividad = ControladorActividades::ctrMostrarActividades($item, $valor);

                    foreach ($actividad as $key => $value) {
                        
                       echo '  
                        
                        <option value="'.$value["id"].'">'.$value["categoria"].'</option>
                        
                       '; 

                    }

                   ?>

                </select> 

              </div>

            </div>
            

            <!-- Entrada para el Nombre -->
            <div class="form-group">
            
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-tag"></i></span>
                   
                <input type="text" name="nuevaSubActividad" id="nuevaSubActividad" placeholder="Ingresar Nombre" required class="form-control input-lg">   

              </div>

            </div> 
              
             <!-- Entrada para la Ruta -->
            <div class="form-group">
            
              <div class="input-group">
                  
                  <span class="input-group-addon"> <i class="fa fa-code"></i></span>
                     
                  <input type="text" name="nuevaRuta" placeholder="Ingresar Ruta" required class="form-control input-lg">   

              </div>

            </div> 
                
            <!-- Entrada para el Objetivo -->   
            <div class="form-group">
            
              <label>Objetivo</label>
            
              <textarea class="form-control" rows="4" name="nuevoObjetivo" placeholder="Escribe el Objetivo..."></textarea>
            
            </div>  


            <!-- Entrada para el Texto Ayuda -->   
            <div class="form-group">
            
              <label>Texto de Ayuda</label>
            
              <textarea class="form-control" rows="4" name="nuevoTextoAyuda" placeholder="Escribe un texto de ayuda para que el alumno comprenda la actividad"></textarea>
            
            </div>  

            <!-- Entrada para la Imagen-->
            <div class="form-group">

              <div class="panel text-uppercase">Subir Imagen</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">
              
              <p class="help-block">Peso máximo de la foto 2MB</p>
                
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizarImagen" width="100px" alt=""> 

            </div>


            <!-- Entrada para las Actividades -->   
            <div class="form-group">
            
              <label>Actividades</label>
            
              <textarea class="form-control" rows="4" name="nuevasActividades" placeholder="Escribe las actividades a renglon seguido, marcando cada una de ellas con un 1.- ..."></textarea>
            
            </div> 

            <!-- Entrada para el archivo-->
            <div class="form-group">

              <div class="panel text-uppercase">Subir Archivo</div>

              <input type="file" class="nuevoArchivo" name="nuevoArchivo">
              
              <p class="help-block">Peso máximo del archivo 2MB, Formato PDF o DOCX</p>
                
            </div> 


          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Guardar Sub-Actividad</button>
        </div>

        <?php 

          $crearSubActividad = new ControladorSubActividades();

          $crearSubActividad -> ctrCrearSubActividades();

         ?> 
      </form>
    
    </div>

  </div>

</div>


<!--=============================
= VENTANA MODAL EDITAR SUB-ACTIVIDAD
===============================-->
<div id="modalEditarSubActividad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-user-plus"></i> </span> Editar Sub-Actividad</h4>

        </div>


        <!--======================================
        =  Cuerpo del Modal            =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- Entrada para Seleccion de Categoría Actividad-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                   
                <select name="editarActividad" style="width: 100%" required class="form-control input-lg">
                  
                  <option value="" id="editarActividad">Seleccionar Categoria</option>

                  <?php 

                    $item = null;

                    $valor = null;

                    $actividad = ControladorActividades::ctrMostrarActividades($item, $valor);

                    foreach ($actividad as $key => $value) {
                        
                       echo '  
                        
                        <option value="'.$value["id"].'">'.$value["categoria"].'</option>
                        
                       '; 

                    }

                   ?>

                </select> 

              </div>

            </div>
            

            <!-- Entrada para el Nombre -->
            <div class="form-group">
            
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-tag"></i></span>
                   
                <input type="text" name="editarSubActividad" id="editarSubActividad" required class="form-control input-lg">   

              </div>

            </div> 
              
             <!-- Entrada para la Ruta -->
            <div class="form-group">
            
              <div class="input-group">
                  
                  <span class="input-group-addon"> <i class="fa fa-code"></i></span>
                     
                  <input type="text" name="editarRuta" id="editarRuta" required class="form-control input-lg">   

              </div>

            </div> 
                
            <!-- Entrada para el Objetivo -->   
            <div class="form-group">
            
              <label>Objetivo</label>
            
              <textarea class="form-control" rows="4" name="editarObjetivo" id="editarObjetivo"></textarea>
            
            </div>  


            <!-- Entrada para el Texto Ayuda -->   
            <div class="form-group">
            
              <label>Texto de Ayuda</label>
            
              <textarea class="form-control" rows="4" name="editarTextoAyuda" id="editarTextoAyuda"></textarea>
            
            </div>  

            <!-- Entrada para la Imagen-->
            <div class="form-group">

              <div class="panel text-uppercase">Subir Imagen</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">
              
              <p class="help-block">Peso máximo de la foto 2MB</p>
                
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previzualizarImagen previsualizarImagen" width="100px"> 

            </div>


            <!-- Entrada para las Actividades -->   
            <div class="form-group">
            
              <label>Actividades</label>
            
              <textarea class="form-control" rows="4" name="editarActividades" id="editarActividades"></textarea>
            
            </div> 

            <!-- Entrada para el archivo-->
            <div class="form-group">

              <div class="panel text-uppercase">Subir Archivo</div>

              <input type="file" class="nuevoArchivo" name="nuevoArchivo">
              
              <p class="help-block">Peso máximo del archivo 2MB, Formato PDF o DOCX</p>

              <input type="text" class="editarArchivo form-control" readonly name="editarArchivo">
                
            </div> 


          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Editar Sub-Actividad</button>
        </div>

        <?php 

          // $crearSubActividad = new ControladorSubActividades();

          // $crearSubActividad -> ctrCrearSubActividades();

         ?> 
      </form>
    
    </div>

  </div>

</div>

<?php 
  // # ========================================
  // # = BORRAR CATEGORÍA           =
  // # ========================================
  // $eliminarActividad = new ControladorActividades();

  // $eliminarActividad -> ctrEliminarActividad();

?>