<!-- Header -->
<?php include("header.php") ?>

<div class="container" style="margin-bottom: 50px" >
	<div class="container-fluid">
		<div id="wrapper">
			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Creaci&oacute;n de ticket exitosa</i></div>
					<div id="bottom-head"><h1 id="logintoregister"><?  echo($message);  ?></h1></div>
				</div> 
				<div class="container" style="margin-top: 50px;height: 230px">
					<div class="row">
						<div class="col-xl-12 col-md-12 col-xs-12 col-sm-12">
						  <!-- <p class="text-success fuente-txt mt-2"> Su n&uacute;mero de ticket es: <?php //echo $jsonTicket->{'id'}; ?>  </p> -->           
						  <p class="text-success fuente-txt mt-4" style="font-size: 30px"> Su n&uacute;mero de ticket es: <strong><?php echo $jsonTicket->{'key'}; ?></strong></p>
						  <p class="text-success fuente-txt mt-2"> Recuerde este n&uacute;mero para futuras consultas </p>                      
						  <!-- <p> Informaci&oacute;n Total del ISSUE: <?php //echo $ticketCreated; ?> </p> -->
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
