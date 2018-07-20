
<?php
    session_start();
    require_once 'header.php';
    require_once 'clases/usuario.php';
    use app\clases\usuario;
    $obj_usuario = new usuario; // 
    $_SESSION['Buscar']=FALSE;
    
?>


<script type="text/javascript">
  function miFuncion() {

	 var textoBusqueda = $("input#buscarUsu").val();
	 if (textoBusqueda != "") {
        $.post("clases/usuario.php", {valorBusqueda: textoBusqueda}); 
        //alert('Has hecho click en "miboton"');        
     }

  }
</script>




<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form>
                            <div class="form-group">
					 
				<label for="exampleInputEmail1">
                                    Usuario
                               	</label>
                               	<input type="text" class="form-control" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" />
                            </div>
                    
<input type="button" name="miboton" id="miboton" value="Buscar" onclick="miFuncion()" />
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
					</tr>
				</thead>
				<tbody>
                                    <?php 
                                    var_dump($_SESSION['Buscar']);
                                        $lista=[];
                                        if($_SESSION['Buscar']==FALSE){
                                            $lista=$obj_usuario::lista_usuarios();
                                        }elseif($_SESSION['Buscar']==TRUE){
                                            $lista=$obj_usuario::Buscar_usuario();
                                        }
                                        
                                        foreach ($lista as $value) {
                                            
                                          echo"<tr>
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
                                                </tr>";
                                      }
                                      ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div>----------------------------------------------------------------</div>

<div>Alta Usuario Nuevo</div>

<div>----------------------------------------------------------------</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="form_usuario" method="POST" action="usuario.php">
				<div class="form-group">
					 
					<label for="exampleInputEmail1">
					    Nombre
					</label>
					<input id="nombre" type="text" class="form-control" name="nombre" />
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Clave
					</label>
					<input id="clave" type="password" class="form-control" name="clave" />
					
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
		<button type="submit" class="btn btn-primary" id="guardarUsu">Guardar</button>
                </form>
		</div>
	</div>
</div>
</body>
</html>