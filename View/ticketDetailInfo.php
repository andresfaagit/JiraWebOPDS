<div class="container" style="min-width: 650px; min-height: 300px">
	<div class="row">
		<div class="col-xl-12 col-md-12 col-xs-9 col-sm-9">	
			  <?php 
				 if(isset($_GET['position'])){
					$pos = $_GET['position']; 
					?> 
					   <p class="text-success fuente-txt mt-4" style="font-size: 30px">  <strong> <?php  echo($_SESSION["descriptionArray"]["summary"][$pos]); ?></strong></p>
					   <textarea type="text" name="newComment" id="newComment"  class="inputMaterial" rows="7" cols="5" required="true">ggg <?php  echo($_SESSION["descriptionArray"]["description"][$pos]); ?></textarea> 
					<?php   
				 }else{
					?> <p class="text-success fuente-txt mt-4" style="font-size: 30px">  <strong> <?php echo $_SESSION["descriptionTicketTemp"] ?></strong></p> <?php 
				 }
			  ?>
		</div>
	</div>
</div>