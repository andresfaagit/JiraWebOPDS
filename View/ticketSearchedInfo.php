<!-- Header -->
<?php include("header.php") ?>

<div class="container" style="margin-bottom: 50px" >
	<div class="container-fluid" >
		<div id="wrapper">
			
			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Resultado de la consulta <?php  echo $jsonTicket->{'key'} ?></i></div>
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
				<div class="container">
				  <div class="col" >
					   <?php if (($message == "Datos obtenidos correctamente") || ($message == "Adjunto agregado correctamente")){ ?>
						  
						   <table class="t-products">
							  <colgroup>
								  <col span="4">
								  <col span="1" style="border-left: 2px solid #295C80;" >
							  </colgroup>													  
							  <tbody>
								  <tr style="height: 80px; background: #FFFFFF" align="left">
									  <td colspan="2">
										  <div style="font-size: 36px; margin-left: 20px;"><?php echo($cutSummaryTicket)  ?></div>
										  <div style="font-size: 26px; margin-left: 25px; font-style: italic"><?php echo($cutWord) ?></div>

										  <div style="margin-left: 40px; margin-bottom: 5px;"><a id="Descripcion" class="LinkTexto_Blanco">Leer descripci&oacute;n</a></div>
									  </td>
								  </tr>
							  </tbody>
						  </table>

						  <table class="t-products"  >
							  <colgroup>
								  <col span="4">
								  <col span="1" style="border-left: 2px solid #295C80;" >
							  </colgroup>
							  <thead>
								  <tr>
									  <td colspan="2"> <?php if($arrayOfComments["size"] == 0){ ?> No hay comentarios del ticket <?php }
												 else{ ?> Comentarios del ticket <?php echo("  #" . $arrayOfComments["size"]) ?> <?php } ?>	

									  </td>
								  </tr>
							  </thead>
							  <tbody>
								 <?php for($pos=0; $pos<$arrayOfComments["size"]; $pos++){ ?>
									  <tr>
										  <td width="30%">
											  <div style="margin-left: 20px;"> 
													<!--# <?php //echo ($pos+1) ?> -->
													  <?php if($arrayOfAuthors[$pos]["author"] != "Receptor")
												 			{
																?><img style="margin-right: 5px; margin-bottom: 5px;" src="../Appearance/imagenes/soporte.png"/><? echo ("Soporte TI OPDS"); 
															}
															else
															{
																?><img style="margin-right: 5px; margin-bottom: 3px;" src="../Appearance/imagenes/chat.png"/><? echo ("Usuario"); 
															}
													  ?>
						  					  </div>
										  </td>
										  <td width="70%"><?php echo ($arrayOfComments[$pos]); ?></td>
									  </tr>

								  <?php } ?>	

							  </tbody>

						  </table>

<!-- -------------------------------------------------------- Attachments -->

                          <table class="t-products">
							  <colgroup>
								  <col span="4">
								  <col span="1" style="border-left: 2px solid #295C80;" >
							  </colgroup>													  
						  </table>

						  <table class="t-products"  >
							  <colgroup>
								  <col span="4">
								  <col span="1" style="border-left: 2px solid #295C80;" >
							  </colgroup>
							  <thead>
								  <tr>
									  <td colspan="2"> <?php if($arrayOfAttachments["size"] == 0){ ?> El ticket no posee archivos adjuntos <?php }
												 else{ ?> Adjuntos del ticket <?php echo("  #" . $arrayOfAttachments["size"]) ?> <?php } ?>	

									  </td>
								  </tr>
							  </thead>
							  <tbody>
								 <?php for($pos=0; $pos<$arrayOfAttachments["size"]; $pos++){ ?>
									  <tr>
										  <td width="30%">
											  <div style="margin-left: 20px;"> 
													  <!--# <?php //echo ($pos+1) ?> -->
													  <img style="margin-right: 5px; margin-bottom: 5px;" src="../Appearance/imagenes/adjunto.png"/>

													  <!--# Remove all blank spaces for GET method -->
													  <?php $splitAttachName[$pos]["attachmentName"] = str_replace(' ', '', ($arrayOfAttachments[$pos]["attachmentName"])); ?>
													  <?php echo ("<a href=../Controller/downloadAttachment.php?attachId=".$arrayOfAttachments[$pos]["idFile"]."&attachmentName=".$splitAttachName[$pos]["attachmentName"]." /> ".$arrayOfAttachments[$pos]["attachmentName"]." </a>") ?>
						  					  </div>
										  </td>
										  <td width="70%">      
										  </td>
									  </tr>

								  <?php } ?>	

							  </tbody>

						  </table>
<!-- -------------------------------------------------------- -->

                          <table class="t-products">
							  <thead>							  
								  <tr>
									  <td>	
										  <div class="row">
											  <div class="col-xl-7 col-md-5 col-xs-0 col-sm-0 d-none d-lg-block"></div>
											  <div class="col-xl-5 col-md-7 col-xs-12 col-sm-12">
													<ul class="navbar-nav mr-auto" >
														<li class="nav-item active" id="BuscarTicket" style="height: 60px; margin-right: 20px;">
															<a id="miComentario" class="LinkTexto_Blanco" alt="Agregar" style="width: 150px; ">
																<img src="../Appearance/imagenes/Comentario.png" alt="Agregar"/> Agregar comentario
															</a>
															<div style="color: white; font-size: 12px; word-wrap: break-word; width: 250px; margin-left: 35px; margin-top: -5px">Cargue un comentario en el ticket generado</div>			
														</li>
														<li class="nav-item active" id="BuscarTicket" style="height: 60px; margin-right: 20px;">
															<a id="miAdjunto" class="LinkTexto_Blanco" alt="Agregar" style="width: 150px; ">
																<img src="../Appearance/imagenes/upload32.png" alt="Agregar"/>  Agregar adjunto
															</a>
															<div style="color: white; font-size: 12px; word-wrap: break-word; width: 250px; margin-left: 35px; margin-top: -5px">incorpore un archivo adjunto al ticket generado</div>			
														</li>											
													</ul>
											  </div>
										  </div>
									  </td> <!-- Viaja $jsonTicket por $_SESSION['jsonTicket'] linea de arriba -->
								  </tr>
							  </thead>						  
						  </table>

						  <?php 
							   $_SESSION['jsonTicket']= $jsonTicket;
						  }else{ ?>
						       <a href="../View/searchTicket.php"> <?php echo($message); ?> </a> 
						  <?php } ?>     
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
	$(document).ready(function(){
	  $("#miComentario").click(function(){
		$("#divContenido").load("../Controller/constructComment-C.php");
		document.getElementById("titulo").innerHTML = "Agregar comentario al ticket";
		$("#miModal").modal();
	  });
		
	  $("#miAdjunto").click(function(){
		$("#divContenido").load("../Controller/constructAttachment-C.php");
	    document.getElementById("titulo").innerHTML = "Agregar adjunto al ticket";
		$("#miModal").modal();
	  });

	  $("#Descripcion").click(function(){
		$("#divContenido").load("../View/ticketDetailInfo.php");
		document.getElementById("titulo").innerHTML = "Descripci&oacute;n";
		$("#miModal").modal();
	  });
		
	});
</script>
