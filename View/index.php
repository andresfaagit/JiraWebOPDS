<!-- WEB Version 1.1 - 27/5 -->
<!-- Header -->
<?php include("header.php") ?>

<div class="container" style="margin-bottom: 50px" >
	<div class="container-fluid" >
		<div id="wrapper">

			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Seleccione el tipo de reclamo</i></div>
					<div id="bottom-head"></div>
				</div> 

				<div class="container" style="width: 95%">	
					<? if($_SESSION['havePermission']){ ?>
					<!-- ADA, SYNVELY y DPOUT no tienen permisos a soporte y Aplicaciones-->	

						<div class="row mt-12 mx-12">
							<div class="TextoGrupo">
								<img src="../Appearance/imagenes/vi.png" width="31" height="22" /><span>Incidentes de soporte</span>
							</div>								
						</div>
						<div class="row">
							<div class="col-md-6 col-mt-3 col-mx-3">
								<form action="../Controller/constructIssue-C.php" name="general" method="POST" class="form-group">              
									<input type="hidden" name="sector" value="OPDS"/> 
									<input type="hidden" name="issueType" required="true" value="ISSUESOPORTE">
									<input type="hidden" name="suportTo"  value="Puesto_De_Trabajo"> 
									<input type="hidden" name="suportFromTitle"  value=" Incidentes de soporte (Puesto De Trabajo)"> 

									<button style="font-size: 36px;width: 100%;" id="uno" type="submit" name="button" value="Puesto de Trabajo" class="boton">
										Puesto de Trabajo
										<br>
										<a id="AyuSopPuesto" data-toggle="modal" data-target="#AyudaModal">Ayuda</a>
									</button>	
								</form>													
							</div>
							<div class="col-md-6 col-mt-3 col-mx-3">
								<form action="../Controller/constructIssue-C.php" name="general" method="POST" class="form-group">              
									<input type="hidden" name="sector"  value="OPDS"/> 
									<input type="hidden" name="issueType" required="true" value="ISSUESOPORTE">
									<input type="hidden" name="suportTo"  value="Impresora">
									<input type="hidden" name="suportFromTitle"  value=" Incidentes de soporte (Impresora)"> 

									<button style="font-size: 36px;width: 100%" id="uno" type="submit" name="button" value="Impresoras" class="boton">
										Impresoras
										<br>
										<a id="AyuSopImpresoras" data-toggle="modal" data-target="#AyudaModal">Ayuda</a>
									</button>										
								</form>							
							</div>			
						</div>

						<div class="row mt-12 mx-12">
							<div class="TextoGrupo">
								<img src="../Appearance/imagenes/vi.png" width="31" height="22" /><span>Aplicaciones OPDS</span>
							</div>			
						</div>
						<div class="row">
							<div class="col-md-6 col-mt-3 col-mx-3">
								<form action="../Controller/constructIssue-C.php" name="general" method="POST" class="form-group">              
									<input type="hidden" name="sector" value="OPDS"/> 
									<input type="hidden" name="issueType" required="true" value="ISSUEOPDS">
									<input type="hidden" name="suportFromTitle"  value=" Aplicaciones OPDS (Incidente)">

									<button style="font-size: 36px;width: 100%" id="dos" type="submit" name="button" value="Incidentes" class="boton">
										Incidentes
										<br>
										<a id="AyuOpdsIncidentes" data-toggle="modal" data-target="#AyudaModal">Ayuda</a>
									</button>																			
								</form>							
							</div>
							<div class="col-md-6 col-mt-3 col-mx-3">
								<form action="../Controller/constructReq-C.php" name="general" method="POST" class="form-group">              
									<input type="hidden" name="reqType" required="true" value="REQSOPDS">
									<input type="hidden" name="suportFromTitle"  value=" Aplicaciones OPDS (Requerimiento)">

									<button style="font-size: 36px;width: 100%" id="dos" type="submit" name="button" value="Requerimientos" class="boton">
										Requerimientos
										<br>
										<a id="AyuOpdsRequerimientos" data-toggle="modal" data-target="#AyudaModal">Ayuda</a>
									</button>																												
								</form>							
							</div>			
						</div>
					<? } ?>
					<!-- -->		

					<div class="row mt-12 mx-12">
						<div class="TextoGrupo">
							<img src="../Appearance/imagenes/vi.png" width="31" height="22" /><span>Proyecto P3P1</span>
						</div>			
					</div>
					<div class="row">
						<div class="col-md-6 col-mt-3 col-mx-3">
							 <form action="../Controller/constructIssue-C.php" name="general" method="POST" class="form-group">              
								<input type="hidden" name="sector"  value="OPDS"/> 
								<input type="hidden" name="issueType" required="true" value="ISSUEP3P1">
								<input type="hidden" name="suportFromTitle"  value=" Proyecto P3P1 (Incidente)">

								<button style="font-size: 36px;width: 100%" id="tres" type="submit" name="button" value="Incidentes" class="boton">
									Incidentes
									<br>
									<a id="AyuP3P1Incidentes" data-toggle="modal" data-target="#AyudaModal">Ayuda</a>
								</button>																											 
							 </form>							
						</div>
						<div class="col-md-6 col-mt-3 col-mx-3">
							 <form action="../Controller/constructReq-C.php" name="general" method="POST" class="form-group">              
								<input type="hidden" name="reqType" required="true" value="REQSP3P1">
								<input type="hidden" name="suportFromTitle"  value=" Proyecto P3P1 (Requerimiento)">

								<button style="font-size: 36px;width: 100%" id="tres" type="submit" name="button" value="Requerimientos" class="boton">
									Requerimientos
									<br>
									<a id="AyuP3P1Requerimientos" data-toggle="modal" data-target="#AyudaModal">Ayuda</a>
								</button>					 
							 </form>							
						</div>			
					</div>     				

				</div>

				<div id="footer-box"></div>	
			</div>
		</div>
	</div>   						
</div> 

<!-- Footer -->
<?php include("footer.php") ?>
	
<!-- The Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="miModal">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="box">
			<div id="header">
				<!--<div class="modal-close">✖</div>-->
				<div id="cont-lock"><i class="material-icons lock">Ayuda</i></div>
				<div id="bottom-head"></h1></div>
			</div> 		
			<div class="modal-content">        		  
				<!-- Modal body -->
				<div id="divContenido" class="modal-body"></div>        
			</div>
			<div id="footer-box"></div>	
		</div>	  	
	</div>
</div>

	
<script>
	$(document).ready(function(){
	  $("#AyuSopPuesto").click(function(){
		$("#divContenido").load("../Ayuda/AyuSopPuesto.php");		  
		$("#miModal").modal();
	  });	
	  $("#AyuSopImpresoras").click(function(){
		$("#divContenido").load("../Ayuda/AyuSopImpresoras.php");		  
		$("#miModal").modal();
	  });	

	  $("#AyuOpdsIncidentes").click(function(){
		$("#divContenido").load("../Ayuda/AyuOpdsIncidentes.php");		  
		$("#miModal").modal();
	  });	
	  $("#AyuOpdsRequerimientos").click(function(){
		$("#divContenido").load("../Ayuda/AyuOpdsRequerimientos.php");		  
		$("#miModal").modal();
	  });	

	  $("#AyuP3P1Incidentes").click(function(){
		$("#divContenido").load("../Ayuda/AyuP3P1Incidentes.php");		  
		$("#miModal").modal();
	  });	
	  $("#AyuP3P1Requerimientos").click(function(){
		$("#divContenido").load("../Ayuda/AyuP3P1Requerimientos.php");		  
		$("#miModal").modal();
	  });			
				
	});
	
	function ocultar(){
		document.getElementById('CrearTicket').style.display = 'none';
	}
	
	window.onload=ocultar;
	
</script>

