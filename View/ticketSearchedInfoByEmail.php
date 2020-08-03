<!-- Header -->
<?php include("header.php") ?>
  
<div class="container" style="margin-bottom: 50px" >
	<div class="container-fluid" >
		<div id="wrapper">
			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Resultado de la consulta <?php  echo $email ?></i></div>
					<div id="bottom-head"><h1 id="logintoregister">

						<? 
						if ($messageAttachmentExceeded == "Adjunto demasiado grande"){ 
							echo($messageAttachmentExceeded);
						}else{
							//echo($message); //CASO 1 "ADJUNTO AGREGADO CORRECTAMENTE"; 
							                  //CASO 2 "NUMERO DE TICKET INCORRECTO"
						} 
                        ?>
                        	
                        </h1></div>
				</div> 				
				<div class="container" style="min-height: 550px;">
					  <div class="col " >
						   <?php if ($message == "Datos obtenidos correctamente"){ ?>						  
							  <table class="t-products">
								  <colgroup>
									  <col span="6">
									  <col span="1" style="border-left: 2px solid #295C80;" >
								  </colgroup>
								  <tbody>
									  <tr style="height: 80px; background: #FFFFFF" align="left">
										  <td colspan="6">
										  	<div style="font-size: 36px; margin-left: 20px;">Posee <?php echo ($totalTickets); ?> Tickets</div>
										  </td>
									  </tr>
								  </tbody>
						  	  </table>
						  
							  <nav>
								<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
								  <a class="nav-item nav-link active" id="nav-todos-tab" data-toggle="tab" href="#nav-todos" role="tab" aria-controls="nav-todos" aria-selected="true">Todos</a>
								  <a class="nav-item nav-link" id="nav-pendientes-tab" data-toggle="tab" href="#nav-pendientes" role="tab" aria-controls="nav-pendientes" aria-selected="false">Pendientes</a>
								  <a class="nav-item nav-link" id="nav-encurso-tab" data-toggle="tab" href="#nav-encurso" role="tab" aria-controls="nav-encurso" aria-selected="false">En Curso</a>
								  <a class="nav-item nav-link" id="nav-hechos-tab" data-toggle="tab" href="#nav-hechos" role="tab" aria-controls="nav-hechos" aria-selected="false">Hechos</a>
								  <a class="nav-item nav-link" id="nav-referidos-tab" data-toggle="tab" href="#nav-referidos" role="tab" aria-controls="nav-referidos" aria-selected="false">Referidos</a>									
								</div>
							  </nav>
						  
							  <div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-todos" role="tabpanel" aria-labelledby="nav-todos-tab">
									<table class="table table-striped table-bordered mydatatable" style="width: 100%">
									  <thead>
										  <tr style="height: 10px">
											  <th width="20%">Ticket</th>
											  <th width="20%">Estado actual</th> <!-- ACA IRIA POSIBLEMENTE EL ICONO DE CAMBIAR ESTADO Y TODO EL CASE-->
											  <th width="20%">Asignado</th>
											  <th width="20%">Creación</th>
											  <th width="30%"></th>
											  <th></th>
										  </tr>
									  </thead>

									  <tbody>
										 <?php for($pos=0; $pos<$totalTicketsTodos; $pos++){ ?>
											  <tr>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesTodos[$pos]["key"]); ?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesTodos[$pos]["fields"]["status"]["name"]); ?>       
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php if($issuesTodos[$pos]["fields"]["assignee"]["name"] ==""){
																		echo ("Aún sin asignar"); 
																	}else{
																		echo ($issuesTodos[$pos]["fields"]["assignee"]["name"]); 
																	}?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo (substr($issuesTodos[$pos]["fields"]["created"], 0, -18)); ?>
													  </div>
												  </td>
												  <td width="30%" class ="details-control">
													  <div style="margin-left: 20px;" class="LinkTexto_Gis">
														 <!-- Array en $pos con su respectiva descripcion  -->
														 <?php $descriptionArray["description"][$pos] = $issuesTodos[$pos]["fields"]["description"]; ?>
														 <?php $descriptionArray["summary"][$pos] = $issuesTodos[$pos]["fields"]["summary"]; ?>
														 <?php $_SESSION["descriptionArray"] =  $descriptionArray ?>
														 Descripci&oacute;n	
													  </div>
												  </td>	
												  <td>
													  <div style="margin-right: 20px;">
														 <?php ($ticketKey = $issuesTodos[$pos]["key"]) ?> 
														 <?php echo ("<a class='LinkTexto_Gis' href=../Controller/searchIssue-C.php?ticketKey=".$ticketKey."> Detalle </a>") ?>
													  </div>
												  </td>	
											  </tr>
										  <?php } ?>
									  </tbody>
								  </table>
								</div>
								<div class="tab-pane fade" id="nav-pendientes" role="tabpanel" aria-labelledby="nav-pendientes-tab">
									<table class="table table-striped table-bordered mydatatable" style="width: 100%">
									  <thead>
										  <tr style="height: 10px">
											  <th width="20%">Ticket</th>
											  <th width="20%">Estado actual</th> <!-- ACA IRIA POSIBLEMENTE EL ICONO DE CAMBIAR ESTADO Y TODO EL CASE-->
											  <th width="20%">Asignado</th>
											  <th width="20%">Creación</th>
											  <th width="30%"></th>
											  <th></th>
										  </tr>
									  </thead>

									  <tbody>
										 <?php for($pos=0; $pos<$totalTicketsPendiente; $pos++){ ?>
											  <tr>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesPendiente[$pos]["key"]); ?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesPendiente[$pos]["fields"]["status"]["name"]); ?>       
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php if($issuesPendiente[$pos]["fields"]["assignee"]["name"] ==""){
																		echo ("Aún sin asignar"); 
																	}else{
																		echo ($issuesPendiente[$pos]["fields"]["assignee"]["name"]); 
																	}?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo (substr($issuesPendiente[$pos]["fields"]["created"], 0, -18)); ?>
													  </div>
												  </td>
												  <td width="30%" class ="details-control">
													  <div style="margin-left: 20px;" class="LinkTexto_Gis">
														 <!-- Array en $pos con su respectiva descripcion  -->
														 <?php $descriptionArray["description"][$pos] = $issuesPendiente[$pos]["fields"]["description"]; ?>
														 <?php $descriptionArray["summary"][$pos] = $issuesPendiente[$pos]["fields"]["summary"]; ?>
														 <?php $_SESSION["descriptionArray"] =  $descriptionArray ?>
														 Descripci&oacute;n	
													  </div>
												  </td>	
												  <td>
													  <div style="margin-left: 20px;">
														 <?php ($ticketKey = $issuesPendiente[$pos]["key"]) ?> 
														 <?php echo ("<a class='LinkTexto_Gis' href=../Controller/searchIssue-C.php?ticketKey=".$ticketKey."> Detalle </a>") ?>
													  </div>
												  </td>	
											  </tr>
										  <?php } ?>
										  </tbody>
								  </table>
									
								</div>
								<div class="tab-pane fade" id="nav-encurso" role="tabpanel" aria-labelledby="nav-encurso-tab">
									<table class="table table-striped table-bordered mydatatable" style="width: 100%">
									  <thead>
										  <tr style="height: 10px">
											  <th width="20%">Ticket</th>
											  <th width="20%">Estado actual</th> <!-- ACA IRIA POSIBLEMENTE EL ICONO DE CAMBIAR ESTADO Y TODO EL CASE-->
											  <th width="20%">Asignado</th>
											  <th width="20%">Creación</th>
											  <th width="30%"></th>
											  <th></th>
										  </tr>
									  </thead>

									  <tbody>
										 <?php for($pos=0; $pos<$totalTicketsEnCurso; $pos++){ ?>
											  <tr>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesEnCurso[$pos]["key"]); ?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesEnCurso[$pos]["fields"]["status"]["name"]); ?>       
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php if($issuesEnCurso[$pos]["fields"]["assignee"]["name"] ==""){
																		echo ("Aún sin asignar"); 
																	}else{
																		echo ($issuesEnCurso[$pos]["fields"]["assignee"]["name"]); 
																	}?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo (substr($issuesEnCurso[$pos]["fields"]["created"], 0, -18)); ?>
													  </div>
												  </td>
												  <td width="30%" class ="details-control">
													  <div style="margin-left: 20px;" class="LinkTexto_Gis">
														 <!-- Array en $pos con su respectiva descripcion  -->
														 <?php $descriptionArray["description"][$pos] = $issuesEnCurso[$pos]["fields"]["description"]; ?>
														 <?php $descriptionArray["summary"][$pos] = $issuesEnCurso[$pos]["fields"]["summary"]; ?>
														 <?php $_SESSION["descriptionArray"] =  $descriptionArray ?>
														 Descripci&oacute;n	
													  </div>
												  </td>	
												  <td>
													  <div style="margin-left: 20px;">
														 <?php ($ticketKey = $issuesEnCurso[$pos]["key"]) ?> 
														 <?php echo ("<a class='LinkTexto_Gis' href=../Controller/searchIssue-C.php?ticketKey=".$ticketKey."> Detalle </a>") ?>
													  </div>
												  </td>	
											  </tr>
										  <?php } ?>
										  </tbody>
								  </table>

								</div>
								<div class="tab-pane fade" id="nav-hechos" role="tabpanel" aria-labelledby="nav-hechos-tab">
									<table class="table table-striped table-bordered mydatatable" style="width: 100%">
									  <thead>
										  <tr style="height: 10px">
											  <th width="20%">Ticket</th>
											  <th width="20%">Estado actual</th> <!-- ACA IRIA POSIBLEMENTE EL ICONO DE CAMBIAR ESTADO Y TODO EL CASE-->
											  <th width="20%">Asignado</th>
											  <th width="20%">Creación</th>
											  <th width="30%"></th>
											  <th></th>
										  </tr>
									  </thead>

									  <tbody>
										 <?php for($pos=0; $pos<$totalTicketsHecho; $pos++){ ?>
											  <tr>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesHecho[$pos]["key"]); ?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo ($issuesHecho[$pos]["fields"]["status"]["name"]); ?>       
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php if($issuesHecho[$pos]["fields"]["assignee"]["name"] ==""){
																		echo ("Aún sin asignar"); 
																	}else{
																		echo ($issuesHecho[$pos]["fields"]["assignee"]["name"]); 
																	}?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
															  <?php echo (substr($issuesHecho[$pos]["fields"]["created"], 0, -18)); ?>
													  </div>
												  </td>
												  <td width="30%" class ="details-control">
													  <div style="margin-left: 20px;" class="LinkTexto_Gis">
														 <!-- Array en $pos con su respectiva descripcion  -->
														 <?php $descriptionArray["description"][$pos] = $issuesHecho[$pos]["fields"]["description"]; ?>
														 <?php $descriptionArray["summary"][$pos] = $issuesHecho[$pos]["fields"]["summary"]; ?>
														 <?php $_SESSION["descriptionArray"] =  $descriptionArray ?>
														 Descripci&oacute;n	
													  </div>
												  </td>	
												  <td>
													  <div style="margin-left: 20px;">
														 <?php ($ticketKey = $issuesHecho[$pos]["key"]) ?> 
														 <?php echo ("<a class='LinkTexto_Gis' href=../Controller/searchIssue-C.php?ticketKey=".$ticketKey."> Detalle </a>") ?>
													  </div>
												  </td>	
											  </tr>
										  <?php } ?>
										  </tbody>
								  </table>
									
								</div>
								<div class="tab-pane fade" id="nav-referidos" role="tabpanel" aria-labelledby="nav-referidos-tab">
									<table class="table table-striped table-bordered mydatatable" style="width: 100%">
									  <thead>
										  <tr style="height: 10px">
											  <th hidden></th>
											  <th hidden></th>
											  <th width="20%">Ticket</th>
											  <th width="20%">Estado actual</th> <!-- ACA IRIA POSIBLEMENTE EL ICONO DE CAMBIAR ESTADO Y TODO EL CASE-->
											  <th width="20%">Asignado</th>
											  <th width="20%">Creación</th>
											  <th width="30%"></th>
											  <th></th>
										  </tr>
									  </thead>

									  <tbody>
										 <?php for($pos=0; $pos<$totalTicketsReferido; $pos++){ ?>
											  <tr>
												  <td hidden><?php $pos; ?></td>
												  <td hidden>../View/ticketDetailInfo.php?position=.<?php $pos; ?></td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
														  <?php echo ($issuesReferido[$pos]["key"]); ?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
													  	<?php echo ($issuesReferido[$pos]["fields"]["status"]["name"]); ?>       
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
														  <?php if($issuesReferido[$pos]["fields"]["assignee"]["name"] ==""){
																	echo ("Aún sin asignar"); 
																}else{
																	echo ($issuesReferido[$pos]["fields"]["assignee"]["name"]); 
																}?>
													  </div>
												  </td>
												  <td width="20%">
													  <div style="margin-left: 20px;"> 
														  <?php echo (substr($issuesReferido[$pos]["fields"]["created"], 0, -18)); ?>
													  </div>
												  </td>
												  <td width="30%" class ="details-control">
													  <div style="margin-left: 20px;" class="LinkTexto_Gis">
														 <!-- Array en $pos con su respectiva descripcion  -->
														 <?php $descriptionArray["description"][$pos] = $issuesReferido[$pos]["fields"]["description"]; ?>
														 <?php $descriptionArray["summary"][$pos] = $issuesReferido[$pos]["fields"]["summary"]; ?>
														 <?php $_SESSION["descriptionArray"] =  $descriptionArray ?>
														 Descripci&oacute;n	
													  </div>
												  </td>	
												  <td>
													  <div style="margin-left: 20px;">
														 <?php ($ticketKey = $issuesReferido[$pos]["key"]) ?> 
														 <?php echo ("<a class='LinkTexto_Gis' href=../Controller/searchIssue-C.php?ticketKey=".$ticketKey."> Detalle </a>") ?>
													  </div>
												  </td>	
											  </tr>
										  <?php } ?>
										  </tbody>
								  </table>									
							  </div>
						  						  														
							<?php 
							}else{
							   echo($message);
							} ?>
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
				<div id="cont-lock"><i class="material-icons lock"><a id="titulo"></a></i></div>
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
	$('.mydatatable').DataTable({
		searching: false,
		ordering: false,
		info:     false,
		paging:   true,
		dom: '<"top"i>rt<"bottom"flp><"clear">',
		aLengthMenu: [[5, 10, 50, -1], [5, 10, 50, "Todos"]],
		
		
		createdRow: function ( row, data, index) {
			if ( data[1] = 'HECHO' ){
				$('td', row).eq(1).addClass('text-sucess');
			}				
		}
	});
	
	$(document).ready(function() {
		var table = $('.mydatatable').DataTable();
		
		$('.mydatatable tbody').on( 'click', 'tr td.details-control', function () {						
			var icel = table.cell(this).index().row;
			var ruta = "../View/ticketDetailInfo.php?position=" + icel;
			
			var data = table.cell(icel).data();
			//alert(data);
			
			$("#divContenido").load(ruta);
			document.getElementById("titulo").innerHTML = "Descripci&oacute;n";
			$("#miModal").modal();
		} );
		
	} );
</script>




