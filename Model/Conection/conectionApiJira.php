<?php
    require_once("credentialsApiJira.php");
    //Conexión por CURL a API Rest Jira
    function conectToApiJira (){
        $conection = base64_encode(authApiJira());
        return $conection;
    }

    //Retorna el json a la consulta por api rest de ServerInfo, si no conecta retorna un json vacío
    function serviceApiJiraisRunning (){
        $base64_usrpwd = base64_encode(authApiJira());

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                'Authorization: Basic '.$base64_usrpwd));
        curl_setopt($ch, CURLOPT_URL, 'http://incidenciasexternas.opds.gba.gov.ar:8080/rest/api/2/serverInfo'); //
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Ejecución del Curl. 
        $result = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($result, true);

        //Si no conecta; el json de respuesta está vacío; sino todo el server Info:
        //Array ( [baseUrl] => http://172.16.18.52:8080 [version] => 8.0.1 [versionNumbers] => Array ( [0] => 8 [1] => 0 [2] => 1 ) [deploymentType] => Server [buildNumber] => 800009 [buildDate] => 2019-02-20T00:00:00.000-0300 [serverTime] => 2019-05-14T14:05:14.784-0300 [scmInfo] => f5186e157f3e26c0180673ce49d51cb56d8f7579 [serverTitle] => Jira OPDS ) 

        return  $json;   
    }

    function getURLJira(){
    	$url = getURLJiraPathBase();
    	return $url;
    }

?>
