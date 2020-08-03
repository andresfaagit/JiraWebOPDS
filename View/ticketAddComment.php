<div class="row">
	<div class="col-xl-9 col-md-10 col-xs-12 col-sm-12">
		<form action="../Controller/addComment-C.php" method="POST">
			<input type="hidden" name="ticketKey" value=<?  echo($ticketKey) ?> > 
			<div class="group" >      
				<textarea type="text" name="newComment" id="newComment"  class="inputMaterial" rows="7" cols="5" required="true"></textarea>

				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Comentario</label>
			</div>
			<div class="group" >      
				<div class="row" style="text-align: right">	
					<div class="col-md-6">
						<button id="buttonlogintoregister" name="submit" type="submit" style="width: 250px;">Agregar</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 250px;">Cerrar</button>
					</div>										
				</div>
			</div>			
	  </form>
	</div>
	<div class="col-xl-2 col-md-1 d-none d-lg-block">
		<img src="../Appearance/imagenes/issue.png" width="150px" style="max-width: 150px">
	</div>	
</div>


