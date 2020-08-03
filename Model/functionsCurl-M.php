<?php
    //IP de http://incidencias.opds.gba.gov.ar:8080 --> 172.16.18.52:8080
    //IP de http://incidenciasexternas.opds.gba.gov.ar:8080 --> 10.42.3.52:8080
    //https://sistemas.opds.gba.gov.ar/intra/Jira/View/login.php  --> Producción

    //Parametrizar la url a una sola variable: curl_setopt($ch, CURLOPT_URL, URLPARAMETRIZABLE ACA);
    require_once("Conection/credentialsApiJira.php");
    //el método: getURLJiraPathBase(); devuelve: //'http://incidenciasexternas.opds.gba.gov.ar:8080';

    //POST
    function curlConnectPost (){
    	//Conexión por CURL a API Rest Jira
    	require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, 'http://incidencias.opds.gba.gov.ar:8080/rest/api/2/issue/');
	    curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/rest/api/2/issue/');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
												'Authorization: Basic '.$base64_usrpwd)); 
	    return $ch;
    }

    function curlConnectPostPutComment ($ticketKey){
        //Conexión por CURL a API Rest Jira
        require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, 'http://incidencias.opds.gba.gov.ar:8080/rest/api/2/issue/');
        curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/rest/api/2/issue/'.$ticketKey.'/comment');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                'Authorization: Basic '.$base64_usrpwd)); 
        return $ch;
    }

    function curlConnectPostPutAttachment ($ticketKey){
        //Conexión por CURL a API Rest Jira
        require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, 'http://incidencias.opds.gba.gov.ar:8080/rest/api/2/issue/');
        curl_setopt($ch, CURLOPT_URL, 'http://10.42.3.34:8080/rest/api/2/issue/'.$ticketKey.'/attachments');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$base64_usrpwd,
                                                   'cache-control: no-cache',
                                                   'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                                                   'x-atlassian-token: nocheck'));
                                                  
        return $ch;
    }

    function AddAttachmentToJira ($ticketKey, $attachment){
        //Intenta agregar el adjunto al issue especificado

        //SUBE TODAS LAS EXTENSIONES PERO DE TAMAÑO LIMITADO
        //Extensiones no aceptadas: .exe
        //RARs de cierto tamaño no aceptado
        //Words no acepta
        //Pdf mas grande no acepta
        //LOS RAR AL SUPERAR CIERTO TAMAÑO NO MANDA (Setear desde JIRA sf)
        //NO SUBE MAS DE 2.000 KB desde PHP; por POSTMAN si

        $sizeOfAttachment = $attachment['size'];
        if(attachmentSizeIsOkey($sizeOfAttachment) == true){
                $message = "Size accepted";
                //echo($message);

                //CONSTRUYE EL POSTFIELDS => 
                $name = $attachment['name']; // name of the file
                $nameAttach = str_replace("'","",$name);
                $tempAttach = $attachment['tmp_name']; //temporary file location when click upload it temporary stores on the computer

                //$fileNameCmps = explode(".", $name);
                //$fileExtension = strtolower(end($fileNameCmps));

                //http://10.42.3.52:8080/rest/api/2/issue/ISSUE-488/attachments (enlace desde Desarrollo al servidor de Jira)
                $result = shell_exec('curl -D- -u Receptor:opds -X POST -H "X-Atlassian-Token: nocheck" -F "file=@'.$tempAttach.';filename='.$name.'" '.getURLJiraPathBase().'/rest/api/2/issue/'.$ticketKey.'/attachments');

                //$result = Tiene el resultado JSON de Jira al hacer el Upload del adjunto
                if(is_null($result)){              
                    $message = "Error upload file";
                }

        }else{
              $message = "Size exceeded";
        }

        return $message;
    }

    function curlExecPost ($ch,$json_string){
    	//Ejecución del Curl. Recibo $ch y $json y devulevo en $result
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$json_string);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
    }

    function curlExecGet ($ch){
        //Ejecución del Curl. 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    //GET
    function curlConnectGetIssueAllFields ($ticketKey){
        //Conexión por CURL a API Rest Jira
        require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                'Authorization: Basic '.$base64_usrpwd));
        curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/rest/api/2/issue/'.$ticketKey); //
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    function curlConnectGetAttachment ($attachId){
        //Conexión por CURL a API Rest Jira
        require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                'Authorization: Basic '.$base64_usrpwd));
        curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/secure/attachment/'.$attachId.'/'); //
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    function curlConnectGetIssuesByEmail ($email, $issuesStatus){
        //Conexión por CURL a API Rest Jira
        require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                'Authorization: Basic '.$base64_usrpwd));

        if($issuesStatus == "TODOS"){
            //DEPENDIENDO EL ESTADO, TRAIGO LOS DESEADOS
            //Va a depender de los estados que tenga en JIRA
            //Estados posibles: HECHO, PENDIENTE, REFERIDO, EN CURSO
            //EJEMPLO EN POSTMAN TODOS para un email: 172.16.18.52:8080/rest/api/2/search?jql=Petitioner~"prueba@gmail.com"
            //EJEMPLO EN POSTMAN con estado: 172.16.18.52:8080/rest/api/2/search?jql=Petitioner~"prueba@gmail.com"+and+status="PENDIENTE"
            curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/rest/api/2/search?jql=Petitioner~"'.$email.'"'); //TODOS
        }else{
            curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/rest/api/2/search?jql=Petitioner~"'.$email.'"+and+status="'.$issuesStatus.'"'); //TODOS los issues con el estado deseado
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }
    
    //Custom Gets
    function curlConnectGetIssueStatus ($ticketKey){
        //Conexión por CURL a API Rest Jira
        //Devuelve el campo status del ticket
        require_once("Conection/conectionApiJira.php"); 
        $base64_usrpwd = conectToApiJira();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                'Authorization: Basic '.$base64_usrpwd));
        curl_setopt($ch, CURLOPT_URL, getURLJiraPathBase().'/rest/api/2/issue/'.$ticketKey.'?fields=status'); //
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

?>