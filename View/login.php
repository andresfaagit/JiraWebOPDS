<!-- Header -->	
<?php include("header.php") ?>

<div class="container" style="margin-bottom: 50px" >
	<div class="container-fluid">
		<div id="wrapper">
			
			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Ingrese su usuario de acceso a sistema</i></div>
					<div id="bottom-head"><h1 id="logintoregister"><?  echo($message);  ?></h1></div>
				</div> 
				<div class="container" style="margin-top: 50px">
					<div class="row">
						<div class="col-xl-6 col-md-6 col-xs-12 col-sm-12">
							<form action="../Controller/loginOPDS-C.php" name="general" method="POST">
								<div class="group" style="width: 330px;">      
									<input type="text" name="userLogin" id="userLogin" class="inputMaterial" required="true" autofocus> 

									<span class="highlight"></span>
									<span class="bar"></span>
									<label>Usuario</label>
								</div>
								<div class="group" style="width: 330px;">      
									<input type="password" name="userPassword" id="userPassword" class="inputMaterial" required="true"> 

									<span class="highlight"></span>
									<span class="bar"></span>
									<label>Password</label>
								</div>
								<div class="group">      
									<button id="buttonlogintoregister" name="button" type="submit">Ingresar</button>
								</div>
								<div class="group">      
									<a id="buttonAyuda" class="LinkTexto_Gis" style="font-size: 24px;">&#191;Qu&eacute; puedo hacer en este sistema?</a>
								</div>
						  </form>
						</div>
						<div class="col-xl-6 col-md-6 col-xs-12 col-sm-12">
							<img src="../Appearance/imagenes/opds.png" width="100%" style="max-width: 600px">
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
				<div id="cont-lock"><i class="material-icons lock">Mesa de Ayuda Digital</i></div>
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
	  $("#buttonAyuda").click(function(){
		$("#divContenido").load("../Ayuda/Ayuda.php");		  
		$("#miModal").modal();
	  });	
		
				
	});
	
	function ocultar(){
		document.getElementById('Usuario').style.display = 'none';
		document.getElementById('BuscarTicket').style.display = 'none';
		document.getElementById('BuscarTicketMail').style.display = 'none';
		document.getElementById('CrearTicket').style.display = 'none';
	}
	
	window.onload=ocultar;
</script>
