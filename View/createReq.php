<!-- Headre -->
<?php include("header.php") ?>

<div class="container" style="margin-bottom: 50px" ><?  echo($message);  ?>
	<div class="container-fluid" >
		<div id="wrapper">
			
			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Creaci&oacute;n de Ticket para <?php echo($suportFromTitle) ?></i></div>
					<div id="bottom-head"><h1 id="logintoregister"><?  echo($message);  ?></h1></div>
				</div> 
				<form class="bootstrap-form needs-validation" action="../Controller/createReq-C.php" name="general" method="POST" class="form-group" novalidate>
				<input type="hidden" name="reqType" value= <?php echo ($reqType); ?> >
					
				<div class="container" style="margin-top: 50px">
					<div class="row">
						<div class="col-xl-10 col-md-10 col-xs-12 col-sm-12">					
							<div class="group">      
								<div style="width: 500px;">
									<input type="email" name="customfield_10007" id="customfield_10007" class="form-control inputMaterial" autocomplete="off" required></input>  

									<span class="highlight"></span>
									<span class="bar"></span>
									<label>Mail Requiriente</label>	
									<div class="invalid-feedback">Formato de mail incorrecto!</div>
								</div>
							</div>
							<div class="group">   
								<div style="width: 500px;">
									<!-- MaxLength summary soportado desde jira 223, más da ERROR -->
									<input type="text" name="summary" id="summary" class="form-control inputMaterial" maxlength="150" autocomplete="off" required> 

									<span class="highlight"></span>
									<span class="bar"></span>
									<label>Asunto Ticket</label>
									<div class="invalid-feedback">Ingrese un asunto v&aacute;lido!</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-md-1 d-none d-lg-block">
							<img src="../Appearance/imagenes/issue.png" width="150px" style="max-width: 150px">
						</div>	
					</div>
					<div class="row">
						<div class="col-xl-12 col-md-12 col-xs-12 col-sm-12">																			
							<div class="group">   
								<div> 							
									<textarea rows="7" cols="5" name="description" id="description" class="form-control inputMaterial" autocomplete="off" required></textarea>

									<span class="highlight"></span>
									<span class="bar"></span>
									<label>Descripci&oacute;n</label>
									<div class="invalid-feedback">Ingrese una descripci&oacute; v&aacute;lido!</div>
								</div>
							</div>

							<div class="group">     	
								<div>
									<button name="button" class="btn btn-outline-primary" type="submit" >Enviar Solicitud</button>							
								</div>						
							</div>
						</div>					
					</div>							
			  	</form>
			  
			</div>
			<div id="footer-box"></div>	

		</div>
	</div>     
</div>

<!-- Footer -->
<?php include("footer.php") ?>








    