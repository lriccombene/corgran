
<?php
    session_start();
    require_once 'header.php';
    //$_SESSION['Buscar']=FALSE;
    
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>


<?php
    //require_once 'header.php';
    require_once 'clases/colegiado.php';
?>
<?php
	$obj_colegiado = new app\clases\colegiado; // 

?>


<form role="form" id="form_colegiado" method="GET" action="/corgran/clases/colegiado.php"  >
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-9">
		        <div class="form-group">
		            <label>Rol</label>
							<select name="DDLRol" id="DDLRol" class="form-control">
								<option selected="selected" value="1">Consejo Directivo Povincial</option>
								<option value="2">Comisi&#243;n Revisora de Cuenta</option>
								<option value="2">Tribunal de Etica y Disiplina</option>
								<option value="2">Colegiados</option>
							
							</select>
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>Nro. Colegiado</label>
		            <input name="txtColegiado" type="text" value="" id="txtColegiado" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	<!--DELEGACION - LOCALIDAD - MES ANIO-->
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			<label>Delegación</label>
	           <select name="DDLDelegacion" id="DDLDelegacion" class="form-control">
						<option selected="selected" value="01">Atlantica</option>
						<option value="02">Valle Medio</option>
						<option value="03">Andina</option>
						<option value="04">Alto Valle Oeste</option>
						<option value="05">Alto Valle Este Y Linea Sur</option>
					</select>
			</div>
			<div class="col-md-3">
			 <div class="form-group">
			        <label>Localidad</label>
			        <select name="DDLLocalidad" id="DDLLocalidad" class="form-control">
							<option selected="selected" value="01">Viedma</option>
							<option value="02">Gral Conesa</option>
							<option value="03">Guardia Mitre</option>
							<option value="04">San Antonio Oeste</option>
							<option value="05">Sierra Grande</option>
							<option value="06">Valcheta</option>
						</select>
			    </div>
			</div>
			<div class="col-md-3">
			<div class="form-group">
	              <label>Mes</label>
	              <select name="DDLMes" id="DDLMes" class="form-control">
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
	      </div>
			</div>
			<div class="col-md-3">
			 <div class="form-group">
	              <label>Año</label>
	              <select name="DDLAnio" id="DDLAnio" class="form-control">
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
	              </select>
	          </div>
			</div>
		</div>
	</div>
	
	<!--APELLIDO - NOMBRE-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Apellido</label>
		            <input name="txtApellido" type="text" value="" id="txtApellido" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Nombre</label>
		            <input name="txtNombre" type="text" value="" id="txtNombre" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	<!--DNI - CUIT - MP - FECHA NACIMIENTO-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>DNI</label>
		            <input name="txtDNI" type="text" value="" id="txtDNI" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>CUIT / CUIL</label>
		            <input name="txtCUIT" type="text" value="" id="txtCUIT" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>MP</label>
		            <input name="txtMP" type="text" value="" id="txtMP" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>Fecha de Naciemiento</label>
		            <input name="txtFecNac" type="date" value="" id="txtFecNac" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	<!--NRO. RESOLUCION - FECHA RESOLUCION - NRO. RESOLUCION BAJA - FECHA RESOLUCION BAJAFECHA-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>Nro. Resolución</label>
		            <input name="txtNroResolucion" type="text" value="" id="txtNroResolucion" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>Fecha Resolución</label>
		            <input name="txtFechaResolucion" type="date" value="" id="txtFechaResolucion" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>Resolución Baja</label>
		            <input name="txtResolucionBaja" type="number" value="0" id="txtResolucionBaja" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="form-group">
		            <label>Fec. Resolución Baja</label>
		            <input name="txtFechaResolucionBaja" type="date" value="" id="txtFechaResolucionBaja" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	<!--MP - VENC. MP-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Fecha Matrícula</label>
		            <input name="txtFechaMP" type="date" value="" id="txtFechaMP" class="form-control" min="1" max="12" />
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Venc. Matrícula</label>
		            <input name="txtVencMP" type="date" value="" id="txtVencMP" class="form-control" min="10" max="99" />
		        </div>
		    </div>
		</div>
	</div>
	<!--TITULO - EXPEDIDO POR - FECHA EGRESO-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-4">
		        <div class="form-group">
		            <label>Título</label>
		            <input name="txtTitulo" type="text" value="" id="txtTitulo" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-4">
		        <div class="form-group">
		            <label>Expedido Por</label>
		            <input name="txtExpedidoPor" type="text" value="" id="txtExpedidoPor" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-4">
		        <div class="form-group">
		            <label>Fecha de Egreso</label>
		            <input name="txtFechaEgreso" type="date" value="" id="txtFechaEgreso" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	
	<!--DOMICILIO PERSONAL - TELEFONOS-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Domicilio Personal</label>
		            <input name="txtDirPersonal" type="text" value="" id="txtDirPersonal" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Teléfonos</label>
		            <input name="txtTelPers" type="text" value="" id="txtTelPers" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	<!--INSTITUCION/EMPRESA/COMERCIO - DOMICILIO LABORAL-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Institución/Empresa/Comercio</label>
		            <input name="txtInst" type="text" value="" id="txtInst" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>Domicilio Laboral</label>
		            <input name="txtDomicilioLaboral" type="text" value="" id="txtDomicilioLaboral" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	<!--DOMICILIO CONSULTORIO - LOCALIDAD - TELEFONOS-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-4">
		        <div class="form-group">
		            <label>Domicilio Consultorio</label>
		            <input name="txtDirConsultorio" type="text" id="txtDirConsultorio" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-4">
		        <div class="form-group">
		            <label>Localidad</label>
		            <input name="txtLocalidadConsultorio" type="text" id="txtLocalidadConsultorio" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-4">
		        <div class="form-group">
		            <label>Teléfonos</label>
		            <input name="txtTelConsultorio" type="text" value="" id="txtTelConsultorio" class="form-control" />
		        </div>
		    </div>
		</div>
	</div>
	            <!--MAIL - MAIL ALTERNATIVO-->
	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>e-Mail</label>
		            <input name="txtMail" type="email" value="" id="txtMail" class="form-control" />
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label>e-Mail Alternativo</label>
		            <input name="txtMailAlternativo" type="email" id="txtMailAlternativo" class="form-control" />
		        </div>
		    </div>
		</div>
	 </div>
	<br />
	<br />
	<div class="row">
	    <div class="col-md-12" style="text-align: right;">
	    	<button type="submit" class="btn btn-primary" name="btnAceptar" id="btnAceptar" value=1 >Aceptar</button>
	    	<button type="submit" class="btn btn-primary" name="btnCancelar" id="btnCancelar">Cancelar</button>
	    </div>
	</div>
	
	            
</form>

</body>
</html>
