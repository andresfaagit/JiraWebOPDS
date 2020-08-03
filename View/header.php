<!DOCTYPE html>
<html>
<head>
    <title>OPDS</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">	
	<link rel="stylesheet" href="../css/EstiloLogin.css">
    <link rel="stylesheet" href="../Appearance/Style-css/style-index.css">
    <link rel="stylesheet" href="../Appearance/Style-css/boton.css">
    <link rel="stylesheet" href="../Appearance/Style-css/style-jiraApiRest.css">
		
    <link rel="stylesheet" href="../Appearance/Style-css/style-table-searchIssue.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/navbar-fixed-top/">

    <link rel="stylesheet" href="../Appearance/Bootstrap-4/css/bootstrap.css" />    	
	<link rel="stylesheet" href="../Appearance/Bootstrap-4/DataTable/dataTables.bootstrap4.css" />    	
	
    <script src="../Appearance/Bootstrap-4/js/bootstrap.js"> </script>
    <script src="../Appearance/Bootstrap-4/js/jquery-3.3.1.min.js"> </script>
    <script src="../Appearance/Bootstrap-4/js/popper.min.js"> </script>
    <script src="../Appearance/Bootstrap-4/js/bootstrap.bundle.js" > </script>    
	<script src="../Appearance/Bootstrap-4/js/validator.js"></script>	
	<script src="../Appearance/Bootstrap-4/DataTable/jquery.dataTables.min.js"></script>	
	<script src="../Appearance/Bootstrap-4/DataTable/dataTables.bootstrap4.min.js"></script>		
	
	<script src="../Appearance/JavaScript/js-jiraApiRest.js"> </script> 	
<style>		
	.fuente {
	  font-family: 'Montserrat', sans-serif;
	  font-size:30px;
	}
	.fuente-txt {
	  font-family: 'Montserrat', sans-serif;
	  font-size:19px;
	}
	.fuente-titulo-txt {
	  font-family: 'Montserrat', sans-serif;
	  font-size:17px;
	  color:#4d4d4d;
	}
	.fuente-titulo {
	  font-size:18px;
	  font-family: 'Montserrat', sans-serif;
	  color:#4d4d4d;
	}
	.TextoGrupo {
	  font-family: Calibri; 
	  color: #666666; 
	  font-size: 24px; 
	  margin-bottom: 10px;
	  margin-top: 10px;
	}  
</style>

</head>

<body topmargin="0px"> 
	
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#9aca3c; margin-top: 0px;height: 85px;">
  <div>
		<img style="margin-left: 10px; margin-right: 50px;" src="../Appearance/imagenes/logo_invert.png" height="70" />
  </div>	
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
		<li class="nav-item active" id="BuscarTicket" style="height: 60px; margin-right: 20px;">
			<a class="LinkTexto_Blanco" title="Buscar" href="../View/searchTicket.php" rel="nofollow" style="width: 150px; ">
				<img src="../Appearance/imagenes/busqueda.png" alt="Buscar"/>Buscar Ticket
			</a>
			<div style="color: white; font-size: 12px; word-wrap: break-word; width: 210px; margin-left: 35px; margin-top: -5px">Realice una b&uacute;squeda ingresando un Nro de ticket generado previamente</div>			
		</li>
		<li class="nav-item active" id="BuscarTicketMail" style="height: 60px; margin-right: 20px;">
			<a class="LinkTexto_Blanco" title="BuscarMail" href="../View/searchTicketByEmail.php" rel="nofollow" style="width: 150px">
				<img src="../Appearance/imagenes/busquedaMail.png" alt="Buscar" style="margin-right: 5px;"/>Buscar Ticket por Mail
			</a>
			<div style="color: white; font-size: 12px; word-wrap: break-word; width: 210px; margin-left: 40px; margin-top: -5px">Realice una b&uacute;squeda de los ticket generados por un mail</div>			
		</li>
		<li class="nav-item active" id ="CrearTicket" style="height: 60px; margin-right: 20px;">    
			<a  class="LinkTexto_Blanco" title="Buscar" href="../View/index.php" rel="nofollow" style="width: 150px; ">
				<img src="../Appearance/imagenes/volver.png" alt="Buscar"/>Crear Ticket
			</a>        			
			<div style="color: white; font-size: 12px; word-wrap: break-word; width: 210px;; margin-left: 35px; margin-top: -5px">Genere un ticket de un incidente o requerimiento</div>					
		</li>		
    </ul>
    <form class="form-inline my-2 my-lg-0">
		<div id="Usuario" class="col-md-12 col-sm-12 col-xs-12" style="padding-right: 10px; text-align: right">
		<div class="hint--top-left hint--rounded" style="color: white"><?  echo($_SESSION['nameLogued']); echo($_SESSION['surnameLogued']) ?></div>
		<div class="hint--top-left hint--rounded" aria-label="Cerrar Sesión">     
			<a class="LinkTexto_Blanco hint--top-left hint--rounded" title="Cerrar" aria-label="Cerrar Sesión" href="../Controller/closeSession-C.php" rel="nofollow" style="font-size: 18px">Cerrar Sesi&oacute;n
			<img src="../Appearance/imagenes/Cerrar-Sesion.png" alt="Cerrar"/>
			</a>        
		</div>                                
    </form>
  </div>
</nav>
<div id="Banner">
	<div class="container">
		<div class="row" style="padding-top: 50px">
			<div class="Titulo_Texto" ><span>Mesa de Ayuda Digital</span></div>
		</div>
		<div class="row">
			<div id="Titulo"><span>Sistema de ticket de OPDS</span></div>			
		</div>						
	</div>
</div>  
</div>
	
	
  <!-- Header -->
	<!--
  <div class="header">			 	  
    <nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top" style="background:#9aca3c; margin-top: 0px;height: 85px;">		
		
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
      </button>

      <div>
			<img style="margin-left: 10px; margin-right: 50px;" src="../Appearance/imagenes/logo_invert.png" height="75" />
      </div>
		
      <div class="collapse navbar-collapse" id="navbarsExample05">
		<ul class="navbar-nav mr-auto">        
			<form class="form-inline mt-2 my-md-0">
				<li class="nav-item active" id="BuscarTicket" style="height: 60px; margin-right: 20px;">
					<a class="LinkTexto_Blanco" title="Buscar" href="../View/searchTicket.php" rel="nofollow" style="width: 150px; ">
						<img src="../Appearance/imagenes/busqueda.png" alt="Buscar"/>Buscar Ticket
						<div style="color: white; font-size: 11px; word-wrap: break-word; width: 250px; margin-left: 35px">Realice una busqueda ingresando un Nro de ticket generado previamente</div>
						
					</a>
				</li>
				<li class="nav-item active" id ="CrearTicket" style="height: 60px; margin-right: 20px;">    
					<a  class="LinkTexto_Blanco" title="Buscar" href="../View/index.php" rel="nofollow" style="width: 150px; ">
						<img src="../Appearance/imagenes/volver.png" alt="Buscar"/>Crear Ticket
					</a>        			
					<div style="color: white; font-size: 11px; word-wrap: break-word; width: 250px;; margin-left: 35px">Genere un ticket de un insidente o requerimiento</div>					
				</li>
			</form>	
		</ul >  
		  
		<ul class="nav navbar-nav navbar-right">
			<div class ="navbar-brand">		  
				<div id="Usuario" class="col-md-12 col-sm-12 col-xs-12" style="padding-right: 10px; text-align: right">
				<div  class="hint--top-left hint--rounded"><?  echo($_SESSION['nameLogued']); echo($_SESSION['surnameLogued']) ?></div>
				<div class="hint--top-left hint--rounded" aria-label="Cerrar Sesión">     
					<a class="LinkTexto_Blanco hint--top-left hint--rounded" title="Cerrar" aria-label="Cerrar Sesión" href="../Controller/closeSession-C.php" rel="nofollow">Cerrar Sesi&oacute;n
					<img src="../Appearance/imagenes/Cerrar-Sesion.png" alt="Cerrar"/>
					</a>        
				</div>                                
			  </div>   
			</div>
		</ul>
		  
      </div>		
    </nav>	
	  
	 
	<div id="Banner">
		<div class="container">
			<div class="row" style="padding-top: 50px">
				<div class="Titulo_Texto" ><span>Mesa de Ayuda Digital</span></div>
			</div>
			<div class="row">
				<div id="Titulo"><span>Sistema de ticket de OPDS</span></div>			
			</div>						
		</div>
	</div>  
  </div>
	-->
</body>
</html>

