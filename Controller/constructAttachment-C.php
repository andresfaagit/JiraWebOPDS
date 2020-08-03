<?php
	if ($_SESSION['isLogued']){
    	$jsonTicket = ($_SESSION['jsonTicket']); //Toda la info del ticket
    	$ticketKey = $jsonTicket->{'key'}; //Identificador del issue/Req
    	include "../View/ticketAddAttachment.php";
    	
    }else{
        //No está logueado
        $message = "Acceso denegado";
        echo("Acceso denegado");
        include "../View/message.php"; 
    } 	
    
?>  