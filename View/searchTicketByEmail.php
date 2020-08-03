<!-- Header -->
<?php include("header.php") ?>

<div class="container" style="margin-bottom: 50px" ><?  echo($message);  ?>
	<div class="container-fluid" >
		<div id="wrapper">
			
			<div class="box">
				<div id="header">
					<div id="cont-lock"><i class="material-icons lock">Consultar todos los ticket generados</i></div>
					<div id="bottom-head"><h1 id="logintoregister"><?  echo($message);  ?></h1></div>
				</div> 
				<form action="../Controller/searchIssueByEmail-C.php" method="POST">
				<div class="container" style="margin-top: 50px; height: 200px">
					<div class="group">      
						<div>
							<input type="text" name="email" id="email" class="inputMaterial" required="true" > 

							<span class="highlight"></span>
							<span class="bar"></span>
							<label>Ingrese el Email</label>						
						</div>
					</div>
					<div class="group">      
						<div>
							<button name="submit" type="submit">Consultar</button>									
						</div>						
					</div>
				</div>				
			  	</form>
			  <div id="footer-box"></div>	
			</div>
			

		</div>
	</div>     
</div> 
<!-- Footer -->
<?php include("footer.php") ?>
