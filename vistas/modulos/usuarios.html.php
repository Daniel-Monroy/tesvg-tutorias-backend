<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      
      Usuarios
    
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

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Usuario </button>

      </div>
      
      <div class="box-body">
      
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead> 

            <tr>
              
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Ultimo Login</th>
              <th>Acciones</th>

            </tr>
  
          </thead>

          <tbody>
            
            <tr>
              
              <td>1</td>
              <td>Usuario Administrador</td>
              <td>admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" alt=""></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-sm">Activo</button></td>
              <td>2018-11-31 10:00:00</td>
              <td>
                
                <div class="btn-group">
                  
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>

              </td>

            </tr>

          </tbody>

        </table>
      
      </div>
     

    </div>
    
  </section>
  
</div>
<!-- /.content-wrapper -->


<!--=============================
= VENTANA MODAL NUEVO USUARIO   =
===============================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        <!--======================================
        =  Cabeza del Modal            =
        =======================================-->
        <div class="modal-header" style="background: #3e8dbc; color: #fff;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><span> <i class="fa fa-user-plus"></i> </span> Agregar usuario</h4>

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

            <!-- Entrada para el Usuario -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-key"></i></span>
                   
                <input type="text" name="nuevoUsuario" placeholder="Ingresar Usuario" required class="form-control input-lg">   

              </div>

             </div> 

            <!-- Entrada para Contraseña-->
            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-lock"></i> </span>
                   
                <input type="password" name="nuevoPassword" placeholder="Ingresar Contraseña" required class="form-control input-lg">   

              </div>

            </div>


            <!-- Entrada para Seleccion de Perfil-->

            <div class="form-group">

              <div class="input-group">
                
                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                   
                <select name="nuevoPerfil" class="form-control input-lg" id="">
                  
                  <option value="">Seleccionar Perfil</option>

                  <option value="administrador">Administrador</option>

                  <option value="especial">Especial</option>


                  <option value="vendedor">Vendedor</option>

                </select> 

              </div>

            </div>

             <!-- Entrada para la foto-->
            <div class="form-group">

              <div class="panel text-uppercase">Subir Foto</div>

              <input type="file" id="nuevaFoto" name="nuevaFoto">
              
              <p class="help-block">Peso máximo de la foto 2MB</p>
                
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px" alt=""> 

            </div>

          </div>

        </div>


        <!--======================================
        =  PIE DEL MODAL            =
        =======================================-->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-left">Guardar Usuario</button>

        </div>
      
      </form>
    
    </div>

  </div>

</div>
