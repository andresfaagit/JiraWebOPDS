<?php
    require_once("../Model/functionsCurl-M.php");
    require_once("../Model/functionsGeneral-M.php"); 
    $ch = curlConnectPost();

    //Atributos a dar de alta por API Rest DEBERIA IR A MODEL
    $issueType = $_POST['issueType'];

    $nameUserLogued = $_SESSION['nameLogued']; 
    $surnameUserLogued = $_SESSION['surnameLogued'];    
    $email = $_POST['customfield_10007'];
    $oldAddedIssue = $_POST['summary'].$email.$issueType;


    if (isset($issueType) && (validateEmail($email) == true) && ($oldAddedIssue != $_SESSION["oldAddedIssue"])){
        $arr = constructArrayDataIssue($issueType, $nameUserLogued, $surnameUserLogued);
    	$isCreated = true;
        //Guardo los datos recopilados
        $json_arr['fields'] = $arr;
        $json_string = json_encode ($json_arr);   
        //Ejecuto consulta Curl
        $result = curlExecPost($ch, $json_string);
        $_SESSION["oldAddedIssue"] = $oldAddedIssue; //No se agrega el mismo issue que tiene mismo summary y usuario que agregó antes
        //Si se da f5, o se trata de meter un issue con mismo email y summary seguidamente, no te deja.
        //Se agregó este control por session y la validación en el IF
    }
	

    if ($isCreated == true){
    	//Si se creó con éxito el issue
    	//$result tiene el JSON de respuesta de creación de ticket:
    	//{"id":"10633","key":"MDAOL-51","self":"http://172.16.18.52:8080/rest/api/2/issue/10633"} 
	    $ticketCreated = $result;
        $jsonTicket = json_decode($ticketCreated);
        $json = json_decode($ticketCreated, true);

        if($json["errors"]["description"]){
            //Si tiene error al enviar los datos del formulario html - php - java - ApiRest
            //"Operation value must be a string"
            print_r($json["errors"]);
            $error = $json["errors"];
            $message = "Error al copiar y pegar el texto en la descripcion";
        }

	    include "../View/ticketCreatedInfo.php";
    }else{
        include "../View/index.php";
    }
?>	