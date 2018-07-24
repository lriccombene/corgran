
<?php
    session_start();
    require_once 'header.php';
    $_SESSION['Buscar']=TRUE;
    
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script>
	function realizaProcesoPagar(valorCaja1){
      $.ajax({
    type: 'POST',
    url: 'clases/usuario.php',
    data: {'valorCaja1': valorCaja1},
    success: function(msg) {
      //alert(msg);
      window.location.href = 'index.php?id_usu='+valorCaja1;
    }
  });
</script>
<?php

	 require_once 'clases/datos_personales.php';
    use app\clases\datos_personales;
    $obj_dts_perso = new datos_personales; // 
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="form_usuario" method="GET" action="/corgran/clases/datos_personales.php">
                            <div class="form-group">
					 
				<label for="exampleInputEmail1">
                                    Buscar Colegiado por Apellido
                               	</label>
                               	<input type="text" class="form-control" name="apellido" id="apellido" value="" placeholder="" maxlength="30" autocomplete="off" />
                            </div>
                    
					<button type="submit" class="btn btn-primary" name="buscar_colegiado" id="buscar_colegiado">Buscar</button>
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
							ID
						</th>
						<th>
							Apellido Nombre
						</th>
						<th>
							Delegación
						</th>
						<th>
							Matrícula
						</th>
						<th>
							Deuda
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
														                                        	
                                        		$lista=$obj_dts_perso::paginado_dts_perso();
                                            //$lista=$obj_usuario::lista_usuarios();

                                       }elseif($_SESSION['Buscar']==TRUE){
                                            $lista=$obj_dts_perso-> buscar_dts_perso_ape();
														  $lista=$_SESSION['resultado'];
														
                                        }
                                        
                                        foreach ($lista as $value) {
                                            
                                          echo"<tr >
                                                    <td>
                                                            {$value->id_usuario}
                                                    </td>
                                                    <td>
                                                            {$value->Apellido}
                                                    </td>
                                                    <td>
                                                            {$value->delegacion}
                                                    </td>
                                                    <td>
                                                            {$value->matricula}
                                                    </td>
                                                    <td>
                                                            {$value->deuda}
                                                    </td>
                                                    <td>

																		<input type='button' href='javascript:;' onclick='realizaProcesoPagar($value->id_usuario);return false;' value='Ver Pagos'/>
																		
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
