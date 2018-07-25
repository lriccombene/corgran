
<?php
    session_start();
    require_once 'header.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>
							Fec Cta
						</th>
						<th>
							Estado
						</th>
						<th>
							Tipo Cta
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Default
						</td>
					</tr>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<div>-*-----------Cuotas PAgar----------------------</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form role="form">
 					<div class="form-group">
		            <label>Fecha Cuota</label>
		            <input name="txtFecNac" type="date" value="" id="txtFecNac" class="form-control" />
		        </div>
			 <div class="form-group">
			        <label>Estado</label>
			        <select name="DDLEstado" id="DDLEstado" class="form-control">
							<option selected="selected" value="01">Pagada</option>
							<option value="02">A pagar</option>
							<option value="03">Pago Parcial</option>
							<option value="04">Vencida 30 dias</option>
							<option value="05">Vencida 60 dias</option>
							<option value="06">Vencida 90 dias</option>
							<option value="07">Vencida 120 dias</option>
							<option value="08">Mas de 120 dias</option>
						</select>
			    </div>
				<div class="form-group">
			        <label>Tipo Cuota</label>
			        <select name="DDLTipo_cta" id="DDLTipo_cta" class="form-control">
							<option selected="selected" value="01">Colegiación</option>
							<option value="02">Mensual</option>
							<option value="03">Otra</option>

						</select>
			    </div>
				<div class="form-group">
		            <label>Valor Cuota</label>
		            <input name="Valor_cta" type="text" value="" id="Valor_cta" class="form-control" />
		        </div>
    				<div class="form-group">
		            <label>Importe Pagado</label>
		            <input name="importe_pagado" type="text" value="" id="importe_pagado" class="form-control" />
		        </div>
    				<div class="form-group">
		            <label>Interes</label>
		            <input name="interes" type="text" value="" id="interes" class="form-control" />
		        </div>
    				<div class="form-group">
		          <label>Pago Adelantado</label>
			        <select name="pago_adelantado" id="pago_adelantado" class="form-control">
							<option selected="selected" value="01">Real</option>
							<option value="02">Adelantado</option>
							<option value="03">Condonado</option>

						</select>
		        </div>
				<button type="submit" class="btn btn-primary">
					Submit
				</button>
			</form>
		</div>
	</div>
</div>


</body>
</html>