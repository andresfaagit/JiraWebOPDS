<div class="container" style="min-width: 650px; min-height: 300px">	
	<div class="row mt-12 mx-12">

		<div class="col-xl-9 col-md-9 col-xs-12 col-sm-12">
			<form action="../Controller/addAttachment-C.php" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="ticketKey" value=<?  echo($ticketKey) ?> > 
				<div class="group" >      
					  <div style="margin-left: -20px">
						<input type="file" name="file" id="file" style="width: 450px">
					  </div>		
				</div>
				<div class="group" >      
					<div class="row" style="text-align: right">	
						<div>
							<button name="submit" type="submit" style="width: 250px;">Agregar adjunto</button>						 
						</div>
					</div>
				</div>			
		  </form>
		</div>
		<div class="col-xl-3 col-md-3 d-none d-lg-block">
			<img src="../Appearance/imagenes/upload.png" width="150px" style="max-width: 150px">
		</div>	

	</div>
</div>



