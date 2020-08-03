<?php
    header('Cache-Control: no cache'); //Evita revalidación de formularios (puede ir hacia atrás con la flecha del navegador)
                                       //Se usa entre controllers, para evitar el "error": https://www.rephp.com/navegar-de-vuelta-con-el-envio-de-formulario-php.html
    if ($_SESSION['isLogued']){
        require_once("../Model/functionsCurl-M.php");
        require_once("../Model/functionsGeneral-M.php"); 

        if(isset($_GET['attachId'])){
            $attachId = ($_GET['attachId']);

            //$attachmentNameFile = getAttachmentName($_GET['attachmentName']);
            //$attachmentExtension = getAttachmentExtension($_GET['attachmentName']);
            $attachmentFileName = $_GET['attachmentName'];
        }

        $ch = curlConnectGetAttachment($attachId);
        //Ejecuto consulta Curl
        $attachment = curlExecGet($ch);
        $message="Datos obtenidos correctamente";

        //DESCARGO EL DOCUMENTO ('http://incidenciasexternas.opds.gba.gov.ar:8080/secure/attachment/idAttach/');      
        //$stringHeader = 'Content-disposition:$attachment; filename='."$attachmentName";
        //header('Content-disposition:$attachment; filename='."$attachmentNameFile"."."."$attachmentExtension");
        header('Content-disposition:$attachment; filename='."$attachmentFileName");
        echo($attachment);    
        exit;

        include "../View/ticketSearchedInfo.php";
    }else{
        //No está logueado
        $message = "Acceso denegado";
        echo("Acceso denegado");
        include "../View/message.php"; 
    }    
    
?>  