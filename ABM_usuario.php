
<?php
    session_start();
    require_once 'header.php';
    require_once 'clases/usuario.php';
    use app\clases\usuario;
    $obj_usuario = new usuario; // 

    //$_SESSION['Buscar']=FALSE;
    
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script >

realizaProcesoActualizar

function realizaProcesoActualizar(actualizarUsu){
      $.ajax({
    type: 'POST',
    url: 'clases/usuario.php',
    data: {'actualizarUsu': actualizarUsu},
    success: function(msg) {
			//alert(msg);
			var json = msg;
 			//Lo parseamos para convertirlo en objeto
			var types = JSON.parse(json);
			 //Y lo recorremos
			 id_usario="";
			 nombre="";
			 tipo_usu="";
			 contra="";
			for(x=0; x<types.length; x++) {
				id_usario=types[x].id_usuario;
				nombre=types[x].nombre;
				tipo_usu=types[x].tipo_usu;
				contra=types[x].clave;
				
    			//alert(types[x].id_usuario +"---"+types[x].nombre);
    			}			
			window.location.href = 'index.php?id_usuario='+id_usario+'&nombre='+nombre+'&tipo_usu='+tipo_usu+'&clave='+contra+"'";
    }
  });
  
        
        
}


function realizaProcesoEliminar(valorCaja1){
      $.ajax({
    type: 'POST',
    url: 'clases/usuario.php',
    data: {'valorCaja1': valorCaja1},
    success: function(msg) {
      alert(msg);
      window.location.href = 'index.php';
    }
  });
  
        
        
}
</script>


<div>Alta Usuario Nuevo</div>

<div>----------------------------------------------------------------</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="form_usuario" method="POST" action="/corgran/clases/usuario.php">
				<div class="form-group">
					 
					<label for="exampleInputEmail1">
					    Nombre Usuario
					</label>
					<?php
						if(isset($_GET['id_usuario']) && isset($_GET['nombre']) && isset($_GET['tipo_usu'])){
							//var_dump($_GET['nombre']);	
							$valor=$_GET['nombre'];
							echo "<input id='nombre' type='Text' class='form-control' name='nombre' value={$valor} />";						
						}else{
							echo "<input id='nombre' type='text' class='form-control' name='nombre' />";						
						}
					?>
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Clave
					</label>
					<?php
						if(isset($_GET['id_usuario']) && isset($_GET['nombre'])&& isset($_GET['tipo_usu'])){
							$valor=$_GET['clave'];
							echo "<input id='contra' type='Text' class='form-control' name='contra' value={$valor} />";	
							//echo "<input id='contra' type='password' class='form-control' name='contra' value={$valor} />";
						}else {
							echo "<input id='contra' type='Text' class='form-control' name='contra' />";
						}
					?>
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Id_usario
					</label>
					<?php
						if(isset($_GET['id_usuario']) && isset($_GET['nombre'])&& isset($_GET['tipo_usu'])){
							$valor=$_GET['id_usuario'];
							echo "<input id='id_usu' type='Text' class='form-control' name='id_usu' value={$valor} />";	
							//echo "<input id='contra' type='password' class='form-control' name='contra' value={$valor} />";
						}else {
							echo "<input id='id_usu' type='Text' class='form-control' name='id_usu' />";
						}
					?>
				</div>
				<div class="form-group">
    			    <label for="exampleInputPassword1">
    						Tipo usuario
    				</label>
                    <div class="btn-group">
                          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Seleccionar
                          </button>
                          <div class="dropdown-menu">
                              <a name="a" class="dropdown-item" href="#">Colegiado</a>
                              <a name="a"class="dropdown-item" href="#">Administrador</a>
                              <a name="a"class="dropdown-item" href="#">Tesorero</a>
                          </div>
                    </div>
                </div>
					<button type="submit" class="btn btn-primary" name="nuevoUsuBoton" id="guardarUsu">Guardar</button>
					<button type="submit" class="btn btn-primary" name="actualizarUsuBoton" id="actualizarUsuBoton">Actualizar</button>
          </form>
		</div>
	</div>
</div>

<div>------------------------------------------------------------------------------</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="form_usuario" method="POST" action="/corgran/clases/usuario.php">
                            <div class="form-group">
					 
				<label for="exampleInputEmail1">
                                    Nombre de Usuario
                               	</label>
                               	<input type="text" class="form-control" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" />
                            </div>
                    
		<button type="submit" class="btn btn-primary" id="buscar">Buscar</button>
         </form>
		</div>
	</div>
</div>



<div>--------------------------------------------------------------------------</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>
							id
						</th>
						<th>
							Nombre
						</th>
						<th>
							Clave
						</th>
						<th>
							Tipo Usuario
						</th>
						<th>
							Accion
						</th>
					</tr>
				</thead>
				<tbody>
                                    <?php 
                                    
                                        $lista=[];
                                        if( $_SESSION['Buscar']==null){
														                                        	
                                        		$lista=$obj_usuario::paginado_usuario();
                                            //$lista=$obj_usuario::lista_usuarios();

                                       }elseif($_SESSION['Buscar']==TRUE){
                                            $lista=$obj_usuario::Buscar_usuario();
											$lista=$_SESSION['resultado'];
											//var_dump($_SESSION['nombre']);
                                        }
                                        
                                        foreach ($lista as $value) {
                                            
                                          echo"<tr >
                                                    <td>
                                                            {$value->id_usuario}
                                                    </td>
                                                    <td>
                                                            {$value->nombre}
                                                    </td>
                                                    <td>
                                                            {$value->clave}
                                                    </td>
                                                    <td>
                                                            {$value->tipo_usu}
                                                    </td>
                                                    <td>

																		<input type='button' href='javascript:;' onclick='realizaProcesoEliminar($value->id_usuario);return false;' value='Eliminar'/>
																		<input type='button' href='javascript:;' onclick='realizaProcesoActualizar($value->id_usuario);return false;' value='Seleccionar'/>
                                                    </td>
                                                    
                                                </tr>";
                                      }
                                      ?>
				</tbody>
			</table>
		</div>
	</div>
</div>





</body>
</html>
