<?php
    function set_value_dump($var){
        //Retorna valor del dump sobre $var (valor dentro de esa posición)
        //Retorna el valor de $var en la posición $var
        ob_start();
        var_dump($var);
        return ob_get_clean();
    }

    function return_cut_value($string, $size){
    	//Retorna el subString cortado a partir de la posición $size
    	//Descarta lo anterior a $size
        return substr($string, $size);
    }

    function issueDoesNotExist ($str){
        //User o password incorrectos
        if($str == "Issue Does Not Exist"){
            return true;
        }else{
            return false;
        }
    }

    function attachmentSizeIsOkey ($sizeOfAttachment){
        //Si tiene algo el archivo retorna true
        //Algo mayor a 2.000kb retorna false
        if($sizeOfAttachment > 0){
              return true;
        }else{
             return false;
        }
    }

    function getAttachmentname ($string){
        //Hago explode al string recibido
        //Devuelvo la extensión del archivo, corto en el "."
        //Ej: prueba.txt => devuelve txt
        $explodeString = explode(".", $string);

        return $explodeString[0];
    }

    function getAttachmentExtension ($string){
        //Hago explode al string recibido
        //Devuelvo la extensión del archivo, corto en el "."
        //Ej: prueba.txt => devuelve txt
        $explodeString = explode(".", $string);

        return $explodeString[1];
    }

    function validateEmail ($email){
        //Comprueba si el email es válido, retorna true si es válido el email ingresado.
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }

    }   


    //----------------------------------------------------------------------------------------------------------//
    function constructArrayDataReq ($reqType, $nameUserLogued, $surnameUserLogued){
        //Construye el array con la información necesaria para hacer la ejecución del Curl a la Api rest
        //Atributos en común:

        //--------------escapeshellarg
        //Codifica los caracteres especiales que vienen desde el html y php a java, para que le pegue el parámetro a Java
        //Fuente: https://www.php.net/manual/es/function.escapeshellarg.php
        $stringReplaceSummary = $_POST['summary']; 
        $arr['summary'] = escapeshellarg ($stringReplaceSummary);

        $stringReplaceDescription = $_POST['description'];     
        $phptojavaStringDesc = escapeshellarg ($stringReplaceDescription);
        //-------------------------------
         
        $arr['description'] = $phptojavaStringDesc.$nameUserLogued.' '.$surnameUserLogued;
        $arr['customfield_10007'] = $_POST['customfield_10007']; //Email

        if ($reqType == "REQSOPDS"){
                $arr['project'] = array( 'key' => 'REQOPDS');
                $arr['issuetype'] = array( 'name' => 'REQS OPDS');
        }else{ 
            if($reqType == "REQSP3P1"){
                $arr['project'] = array( 'key' => 'REQP3P1');
                $arr['issuetype'] = array( 'name' => 'REQS P3P1');
            }
        }
        return $arr;
    }

    function constructArrayDataIssue ($issueType, $nameUserLogued, $surnameUserLogued){
        //Construye el array con la información necesaria para hacer la ejecución del Curl a la Api rest
        //Atributos en común:
        $arr['summary'] = $_POST['summary'];
        //$nameUserLogued = DPTO. $surnameUserLogued =INFORMATICA  (DPTO.INFORMATICA)

        $suportTo = "(". $_POST['suportTo'] .")";  //EJ: (Impresora)
        //--------------escapeshellarg
        //Codifica los caracteres especiales que vienen desde el html y php a java, para que le pegue el parámetro a Java
        //Fuente: https://www.php.net/manual/es/function.escapeshellarg.php
        $stringReplaceSummary = $_POST['summary']; 
        $arr['summary'] = escapeshellarg ($stringReplaceSummary);

        $stringReplaceDescription = $_POST['description'].' '.$suportTo;     
        $phptojavaStringDesc = escapeshellarg ($stringReplaceDescription);
        //-------------------------------

        $arr['description'] = $phptojavaStringDesc.' '.$nameUserLogued.' '.$surnameUserLogued;

        $arr['customfield_10007'] = $_POST['customfield_10007']; //Email
        $variable = $_POST['sector'];
        $arr['customfield_10302'] = array( 'value' => $_POST['sector']); //Sector

        if ($issueType == "MDAOL"){
                $arr['project'] = array( 'key' => 'MDAOL');
                $arr['issuetype'] = array( 'name' => 'MDA-OL');
        }else{ 
            if($issueType == "ISSUESOPORTE"){
                $arr['project'] = array( 'key' => 'ISSUE');
                $arr['issuetype'] = array( 'name' => 'ISSUE SOPORTE');
            } else{
                if($issueType == "ISSUEP3P1"){
                    $arr['project'] = array( 'key' => 'ISSUE');
                    $arr['issuetype'] = array( 'name' => 'ISSUE P3P1');
                } else {
                    //ISSUEOPDS
                    $arr['project'] = array( 'key' => 'ISSUE');
                    $arr['issuetype'] = array( 'name' => 'ISSUE OPDS');
                }
            }
        }
        return $arr;
    }


    function constructArrayAddComment ($newComment){
        //Construye el array con la información necesaria para hacer la ejecución del Curl a la Api rest
        $arr['body'] = $newComment; //Comentario

        return $arr;
    }

    function constructArrayAddAttachment ($attachment){
        // DE PRUEBA

        //$data = array("file" =&gt; "@filepath/filename.png;filename=filename.png");
        //Construye el array con la información necesaria para hacer la ejecución del Curl a la Api rest
        //$attachment = $_FILES['file']

        //CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file\"; filename=\"[object Object]\"\r\nContent-Type: false\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--"

        //$attachment is the name of the input area on the form 
        //tmp_name tiene el archivo  y name tiene el nombre
        $nameAttach = $attachment['name']; // name of the file
        $tempAttach = $attachment['tmp_name']; //temporary file location when click upload it temporary stores on the computer

        //LINUX SV
        //curl -D- -u Receptor:opds -X POST -H "X-Atlassian-Token: nocheck" -F "file=@/opt/atlassian/jira/BUILDING.txt" 172.16.18.52:8080/rest/api/2/issue/ISSUE-488/attachments    
        //WINDOWS LOCAL
        //curl -D- -u Receptor:opds -X POST -H "X-Atlassian-Token: nocheck" -F "file=@C:/xampp/htdocs/apirestjira/Bootstrap-4/Bootstrap-4/css/estilos.css" 172.16.18.52:8080/rest/api/2/issue/ISSUE-488/attachments        

        //172.16.18.52:8080/rest/api/2/issue/ISSUE-488/attachments
        //HEADERS:
        //Authorization = Basic UmVjZXB0b3I6b3Bkcw==
        //X-Atlassian-Token = nocheck
        //Body file        


        //ACA
        //$arr = array('file =;@'. $tempAttach .';filename='. $nameAttach);
        //$arr = array('file'=>'/opt/atlassian/jira/temp/README.txt;filename=README.txt');
        //$arr = array('file' => '@'.$nameAttach.'');
        //$arr = `curl --silent -u Receptor:opds -X POST -H "X-Atlassian-Token: nocheck" -F "file=@C:/xampp/htdocs/apirestjira/Bootstrap-4/Bootstrap-4/css/estilos.css" 172.16.18.52:8080/rest/api/2/issue/ISSUE-488/attachments`;
        //$arr = array('file =;@'. $tempAttach .';filename='. $nameAttach);

        $salida1 = shell_exec('set');
        echo(" >> SET!! >>>> ");
        echo($salida1);
        echo("USUARIO ACTUAL: ");
        $salida2 = shell_exec('whoami');
        echo($salida2);

        //$salida3 = shell_exec('curl -D- -u Receptor:opds -X POST -H "X-Atlassian-Token: nocheck" -F "file=@/opt/atlassian/jira/BUILDING.txt" 172.16.18.52:8080/rest/api/2/issue/ISSUE-488/attachments');

        //Shell local: anda; shell sv linux: anda; desde aca no. (Son permisos de credenciales, no tiene usuario autenticado)
        //$salida3 = shell_exec('curl -D- -u Receptor:opds -X GET 172.16.18.52:8080/rest/api/2/issue/ISSUE-488/comment');
        $salida3 = shell_exec('curl -D- -u Receptor:opds -X GET 172.16.18.52:8080/rest/api/2/issue/11135');

        echo(" >>>> RESULT CONSULTA >>>> ");
        $res = json_encode($salida3);
        print_r($salida3);
        echo($res);
        //print_r($arr);
        echo("<<<< ");

        //$arr = array('file'=>'/opt/attlassian/jira/temp'.$tempAttach.';filename='.$nameAttach);
        //$arr = array('file'=>'/opt/atlassian/jira/temp/README.txt;filename=README.txt');  
        //////////////////////////////////////////

        return $arr;
    }

    function obtainIssuesByStatus($email){
        require_once("../Model/functionsCurl-M.php");

        //SON 5 ESTADOS
        $arrayOfissuesstatus[0] = "TODOS";
        $arrayOfissuesstatus[1] = "HECHO";
        $arrayOfissuesstatus[2] = "PENDIENTE";
        $arrayOfissuesstatus[3] = "ENCURSO";
        $arrayOfissuesstatus[4] = "REFERIDO";
        for($pos=0; $pos<5; $pos++){
            $ch = curlConnectGetIssuesByEmail($email, $arrayOfissuesstatus[$pos]);
            //Ejecuto consulta Curl
            $tickets = curlExecGet($ch);

            $jsonTickets = json_decode($tickets);
            $json = json_decode($tickets, true);

            $arrayOfissues[$arrayOfissuesstatus[$pos]] = $json;
        }

        return $arrayOfissues;
    }

    function to_utf8( $string ) {
    // From http://w3.org/International/questions/qa-forms-utf-8.html
            if ( preg_match('%^(?:
                [\x09\x0A\x0D\x20-\x7E]            # ASCII
                | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
                | \xE0[\xA0-\xBF][\x80-\xBF]         # excluding overlongs
                | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
                | \xED[\x80-\x9F][\x80-\xBF]         # excluding surrogates
                | \xF0[\x90-\xBF][\x80-\xBF]{2}      # planes 1-3
                | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
                | \xF4[\x80-\x8F][\x80-\xBF]{2}      # plane 16
                )*$%xs', $string) ) {
            return $string;
            } else {
                return iconv( 'CP1252', 'UTF-8', $string);
            }
    }

?>
