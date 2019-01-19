<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Inicio
    
      <small>Panel del Tutor  </small>
    
    </h1>
    
    <ol class="breadcrumb">
     
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio

      </a></li>
      
      <li class="active">-</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

     <div class="row">
        
        <!-- ACTIVIDADES CREADAS -->
        <div class="col-lg-3 col-xs-6">
    
          <div class="small-box bg-aqua">
        
            <div class="inner">
        
              <h3>150</h3>

              <p>Actividades</p>
        
            </div>
        
            <div class="icon">
        
              <i class="ion ion-bag"></i>
        
            </div>
        
            <a href="actividades" class="small-box-footer">Ver Todas <i class="fa fa-arrow-circle-right"></i></a>
        
          </div>
        
        </div>
        

        <!-- SUB-ACTIVIDADES CREADAS -->
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-green">
          
            <div class="inner">
          
              <h3>100<sup style="font-size: 20px"></sup></h3>

              <p>Sub-Actividades</p>
          
            </div>
          
            <div class="icon">
          
              <i class="ion ion-stats-bars"></i>
          
            </div>
          
            <a href="sub-actividades" class="small-box-footer">Ver Todas <i class="fa fa-arrow-circle-right"></i></a>
          
          </div>
        
        </div>
        
        <!-- ALUMNOS -->
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
          
            <div class="inner">
          
              <h3>44</h3>

              <p>Tutorados</p>
          
            </div>
          
            <div class="icon">
          
              <i class="ion ion-person-add"></i>
          
            </div>
          
            <a href="alumnos" class="small-box-footer">Ver todos <i class="fa fa-arrow-circle-right"></i></a>
          
          </div>
        
        </div>

        <!-- LOGIN -->
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-red">
          
            <div class="inner">
          
              <h3>-</h3>
              
              <p>Salir</p>
          
            </div>
          
            <div class="icon">
          
              <i class="fa fa-sign-out" aria-hidden="true"></i>

            </div>
          
            <a href="salir" class="small-box-footer">Cerrar Sessión <i class="fa fa-arrow-circle-right"></i></a>
          
          </div>
        
        </div>

     </div>

     <div class="row">
        
        <?php  
        
        echo'
        <div class="col-md-3">
          
          <!-- Profile Image -->
          <div class="box box-primary">
           
            <div class="box-body box-profile">
           
              <img class="profile-user-img img-responsive img-circle" src="'.$rutaServidor.$_SESSION["foto"].'" alt="User profile picture">

              <h3 class="profile-username text-center">'.$_SESSION["nombre"]." ".$_SESSION["apellidos"].'</h3>

              <p class="text-muted text-center">'.$_SESSION["profesion"].'</p>

            </div>

          </div>
    
          <!-- About Me Box -->
          
          <div class="box box-primary">
          
            <div class="box-header with-border">
          
              <h3 class="box-title">Acerca de...</h3>
          
            </div>
          
            <div class="box-body">
          
              <strong><i class="fa fa-book margin-r-5"></i>Mi Educación</strong>

              <p class="text-muted">
                Lorem ipsum 
              </p>
            
            </div>

          </div>
        
        </div>';

        ?>
        
        <div class="col-md-9">
       
          <div class="nav-tabs-custom">
           
            <ul class="nav nav-tabs">
             
              <li class="active"><a href="#settings" data-toggle="tab">Configuración</a></li>
           
            </ul>
           

            <div class="tab-content">
           

              <div class="active tab-pane" id="settings">
              
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                  
                  <?php echo'

                  <!-- Entrada para el Nombre -->
                  <div class="form-group">
                          
                    <label class="col-sm-2 control-label">Nombre</label>
                
                    <div class="col-sm-10">  
                    
                        <div class="input-group">
                          
                          <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
          
                          <input type="text" name="editarNombre" readonly placeholder="Nombre" value="'.$_SESSION["nombre"].'" required class="form-control">   

                          <input type="hidden" name="idTutor" value="'.$_SESSION["id"].'"> 

                          <input type="hidden" name="perfil" value="'.$_SESSION["perfil"].'">     

                       </div>   

                    </div>
              
                  </div>


                 <!-- Entrada para los Apellidos -->
                  <div class="form-group">
              
                    <label for="inputEmail" class="col-sm-2 control-label">Apellidos</label>

                    <div class="col-sm-10">
                    
                      <div class="input-group">
                
                        <span class="input-group-addon"> <i class="fa fa-user"></i> </span>

                       <input type="text" name="editarApellidos" readonly placeholder="Apellidos" value="'.$_SESSION["apellidos"].'" required class="form-control">   

                      </div>

                    </div>

                  </div>

                  
                  <!-- Entrada para la CARRERA -->
                  <div class="form-group">
              
                    <label for="inputEmail" class="col-sm-2 control-label">Carrera</label>

                    <div class="col-sm-10">
                    
                      <div class="input-group">
                
                       <span class="input-group-addon"> <i class="fa fa-users"></i> </span>';

                       $item = "id";

                       $valor = $_SESSION["carrera"];
                      
                       $carrera = ControladorCarreras::ctrMostrarCarreras($item, $valor);
                      
                       echo'

                       <input type="hidden" name="editarCarrera" value="'.$_SESSION["carrera"].'">
                       
                       <input type="text" readonly placeholder="Carrera" value="'.$carrera["descripcion"].'" required class="form-control">   

                      </div>

                    </div>

                  </div>



                  <!-- Entrada para el usuario -->
                  <div class="form-group">
              
                    <label for="inputEmail" class="col-sm-2 control-label">Usuario</label>

                    <div class="col-sm-10">
                    
                       <div class="input-group">
                
                        <span class="input-group-addon"> <i class="fa fa-key"></i></span>
                           
                        <input type="text" readonly name="editarUsuario" value="'.$_SESSION["usuario"].'" placeholder="Usuario" required class="form-control">   

                      </div>

                    </div>

                  </div>

                 
                  <!-- Entrada para la Profesión -->
                  <div class="form-group">
              
                    <label for="inputEmail" class="col-sm-2 control-label">Profesión</label>

                    <div class="col-sm-10">
                    
                       <div class="input-group">
                
                        <span class="input-group-addon"> <i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                           
                        <input type="text" name="editarProfesion" placeholder="Profesión" value="'.$_SESSION["profesion"].'" required class="form-control">   


                      </div>

                    </div>

                  </div>
                  
                  <!-- Entrada para Contraseña-->
                  <div class="form-group">
              
                    <label for="inputEmail" class="col-sm-2 control-label">Contraseña</label>

                    <div class="col-sm-10">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
                           
                        <input type="password" name="editarPassword" placeholder="Ingresar Contraseña" class="form-control">   
                    
                        <input type="hidden" name="passwordActual" value="'.$_SESSION["password"].'"> 

                        <input type="hidden" name="usuarioActual" value="1">     

    
                      </div>

                    </div>

                  </div>


                  <!-- Entrada para Contraseña-->
                  <div class="form-group">
              
                    <label for="inputEmail" class="col-sm-2 control-label">Foto</label>

                    <div class="col-sm-10">

                      <input type="file" class="nuevaFoto" name="editarFoto">
                      
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                        
                      <img src="'.$rutaServidor.$_SESSION["foto"].'" class="img-thumbnail previsualizarImagen" width="100px" alt=""> 

                      <input type="hidden" name="fotoActual" value="'.$_SESSION["foto"].'">
  
                    </div>

                  </div>
           
           

                  <div class="form-group">
                
                    <div class="col-sm-offset-2 col-sm-10">
                
                      <button type="submit" class="btn btn-danger">Editar</button>
                
                    </div>
                
                  </div>';

                    $editarUsuario = new ControladorUsuarios();

                    $editarUsuario -> ctrEditarUsuario();

                  ?>
                
                </form>
             
              </div>
              
            </div>
            
          </div>
          
        </div>
      
       </div>
      

    </section>

</div>

