<?php
	
	if (isset($_SESSION['sesion_id'])){
?>

	<div class="modal fade" id="Ingreso_Voucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title fl">Ingreso de Voucher</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<form id="guardar_voucher" method="post">
	       		<input type="hidden" name="mod_idForm" id="mod_idForm">
	       		<div class="table table-responsive">
			    <table class="table table-responsive table-striped table-bordered">
			    <thead>
			        <tr>
			            <td>N° Voucher</td>
			            <td>Fecha Deposito</td>
			            <td>Monto</td>
			            <td></td>
			        </tr>
			    </thead>
			    <tbody id="TextBoxContainer">
			    	<td><input type="text" id="voucher" name="voucher" class="form-control" placeholder="Ingrese N° Voucher"></td>
			      	<td><input type="text" id="fecha" name="fecha" class="form-control inputdate" placeholder="YYYY-mm-dd"></td>
			      	<td><input type="text" id="price" name="type-price" class="type-price form-control" placeholder="Ingrese el monto" value="000"></td>
			    </tbody>
			    <tfoot>
			      <tr>
			        <th colspan="5">
			        <button id="btnAdd" type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Agregar Vouchers"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add&nbsp;</button></th>
			      </tr>
			    </tfoot>
			    </table>
			    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button id="btn_submit" type="submit" class="btn btn-primary">Aceptar</button>
	        
	        </form>

	      </div>
	    </div>
	  </div>
	</div>













<?php
   	} 
?>