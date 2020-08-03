<?php      
    header('Cache-Control: no cache'); //Evita revalidación de formularios (puede ir hacia atrás con la flecha del navegador)
                                       //Se usa entre controllers, para evitar el "error": https://www.rephp.com/navegar-de-vuelta-con-el-envio-de-formulario-php.html
	if ($_SESSION['isLogued']){
		//Si está logueado
        //Depende que botón toque, el issueType cambia
        $issueType = $_POST['issueType'];
       	$suportTo = $_POST['suportTo'];
       	$suportFromTitle = $_POST['suportFromTitle'];
	    include "../View/createTicket.php";  
	    
	}else{
		//No está logueado
		$message = "Acceso denegado";
		echo("Acceso denegado");
		include "../View/message.php"; 
	}

?>	