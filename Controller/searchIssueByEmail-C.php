<?php
    header('Cache-Control: no cache'); //Evita revalidación de formularios (puede ir hacia atrás con la flecha del navegador)
                                       //Se usa entre controllers, para evitar el "error": https://www.rephp.com/navegar-de-vuelta-con-el-envio-de-formulario-php.html
    if ($_SESSION['isLogued']){
        require_once("../Model/functionsCurl-M.php");
        require_once("../Model/functionsGeneral-M.php"); 

        $email = ($_POST['email']);
    
        $json = obtainIssuesByStatus($email);

        //json to object
        if($json["TODOS"]["total"] == 0){
            $message=$email." no posee tickets generados";
        }else{
            //Lista de issues para el email ingresado
            $totalTicketsTodos = $json["TODOS"]["total"];
            $issuesTodos = $json["TODOS"]["issues"]; 

            $totalTicketsHecho = $json["HECHO"]["total"];
            $issuesHecho = $json["HECHO"]["issues"];

            $totalTicketsPendiente = $json["PENDIENTE"]["total"];
            $issuesPendiente = $json["PENDIENTE"]["issues"];

            $totalTicketsEnCurso = $json["ENCURSO"]["total"];
            $issuesEnCurso = $json["ENCURSO"]["issues"];

            $totalTicketsReferido = $json["REFERIDO"]["total"];
            $issuesReferido = $json["REFERIDO"]["issues"];

            $message="Datos obtenidos correctamente";
        }

        include "../View/ticketSearchedInfoByEmail.php";
    }else{
        //No está logueado
        $message = "Acceso denegado";
        echo("Acceso denegado");
        include "../View/message.php"; 
    }    
    
?>  