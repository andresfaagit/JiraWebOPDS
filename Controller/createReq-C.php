<?php
    require_once("../Model/functionsCurl-M.php");
    require_once("../Model/functionsGeneral-M.php");  
    $ch = curlConnectPost();

    //Atributos a dar de alta por API Rest DEBERIA IR A MODEL
    $reqType = $_POST['reqType'];

    $nameUserLogued = $_SESSION['nameLogued']; 
    $surnameUserLogued = $_SESSION['surnameLogued'];
    $email = $_POST['customfield_10007'];
    $oldAddedReq = $_POST['summary'].$email.$reqType;

    if (isset($reqType) && (validateEmail($email) == true) && ($oldAddedReq != $_SESSION["oldAddedReq"])){
        $arr = constructArrayDataReq($reqType, $nameUserLogued, $surnameUserLogued);
    	$isCreated = true;	
        //Guardo los datos recopilados
        $json_arr['fields'] = $arr;
        $json_string = json_encode ($json_arr);  
        //Ejecuto consulta Curl
        $result = curlExecPost($ch, $json_string);       
         $_SESSION["oldAddedReq"] = $oldAddedReq; //No se agrega el mismo req que tiene mismo summary y usuario que agregó antes
        //Si se da f5, o se trata de meter un req con mismo email y summary seguidamente, no te deja.
        //Se agregó este control por session y la validación en el IF
    }
	
    if ($isCreated == true){
    	//Si se creó con éxito el issue
    	//$result tiene el JSON de respuesta de creación de ticket:
    	//{"id":"10921","key":"REQP3P1-9","self":"http://incidencias.opds.gba.gov.ar:8080/rest/api/2/issue/10921"} 
        $reqCreated = $result;
        $jsonTicket = json_decode($reqCreated);
        $json = json_decode($reqCreated, true);

        if($json["errors"]["description"]){
            //Si tiene error al enviar los datos del formulario html - php - java - ApiRest
            //"Operation value must be a string"
            print_r($json["errors"]);
            $error = $json["errors"];
            $message = "Error al copiar y pegar el texto en la descripcion";
        }
	    include "../View/reqCreatedInfo.php";
    }else{
        include "../View/index.php";
    }
?>	