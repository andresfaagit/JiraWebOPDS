<?php
    //header("Content-Type: text/xml; charset='ISO-8859-1'\r\n");
    /**
     *  CLIENTE (SOAP CLIENT)
    * 
    */ 
    require_once('Conection/opdsApi/lib/nusoap.php'); //-->Reemplaza a: require_once('lib/nusoap.php');

    function jiraisRunning (){
          //Verifica si Jira Api Rest responde; si el servicio está corriendo o si es posible acceder
          require_once('Conection/conectionApiJira.php');    
          //Retorna true si jira responde
          $result = serviceApiJiraisRunning();
          //AGREGAR UN PING POR CURL
          if(is_null($result)){
                //$message="Jira down";
                return false;
          }else{ 
                if($result["deploymentType"] == "Server"){
                    //$message="Jira running";
                    return true;
                }else{
                    //$message="Jira down";
                    return false;
                }
          }

    }

    function pingToJiraServer (){
          require_once('Conection/conectionApiJira.php');   
          $url = getURLJira(); 
          $ch = curl_init($url); 
          curl_setopt($ch, CURLOPT_NOBODY, true); 
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
          curl_exec($ch); 
          $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
          curl_close($ch); 
          if (200==$retcode){  
              return true; } 
          else { 
              return false; }

    }    

    function connect_nunusoap_OPDS (){
    	  //$url = Webservice OPDS
    	  $url = "http://sistemas.opds.gba.gov.ar/ws/ws_ops_operador.php?wsdl";
        $client = new nusoap_client($url, $wsdl =false,$proxyhost = false,$proxyport = false,$proxyusername = false, $proxypassword = false);

	      return $client;
    }

    function validateUserOPDS ($usu, $pass, $client){
    /**/$ret = $client->call('validausuarioopds', $params = array('usu'  => $usu,
                                                                  'pass'  => $pass,
                                                                  'usuario'  => 'wsopdsint',
                                                                  'password' => 'XLFMDPS'
                                                            ), $url,$soapAction='',
                                                               $headers=false,
                                                               $rpcParams=null,
                                                               $style='rpc',
                                                               $use='encoded');                                                              
	      return $ret;
    }

    function retIsArrayResponse($ret){
        //Evalua si conecta con soap_OPDS. Actualmente: "http://sistemas.opds.gba.gov.ar/ws/ws_ops_operador.php?wsdl"
        //Si $ret no tiene respuesta, no hubo conección a la Api SOAP de OPDS
        //Si $ret trajo algo (el array de conexión), conectó bien; pero no sabemos si las credenciales están bien o no.
        if (is_array($ret)){
            return true;
        }else{
            return false;
        }      

    }

    function userNotLogued ($str){
        //Alternativas de respuesta:
        //mensaje=Acceso NO valido (cuando el usuarioWS no puede conectarse al servicio)
        //mensaje=No-Existe  (cuando el usuario opds no existe)
        //mensaje=Usuario y Clave Valida (cuando el usuario y clave opds son válidos)
        //mensaje=Clave de empleado no valida (cuando la clave de usuario opds es incorrecta)
      
    
        if(($str == "No-Existe") || ($str == "Clave de empleado no valida") || ($str == "Usuario no valido")){
            return true;
        }else{
            //user and pass correctos
            return false;
        }

    }

    function havePermissionToAccess ($userLogued, $nameLogued){
        //ADA, SYNVELT y DPOUT, tienen permisos para ver p3p1 solamente
        //$userLogued = id y $nameLogued= nombre (Departamento)
        //Id ADA: 12915
        //Id DPOUT: 12916
        //Id Synvelt: 12917    
    
        //if(($nameLogued == "ConsultoraSynvelt") || ($nameLogued == "ADA") || ($nameLogued == "DPOUT")){
        if(($userLogued == "12917") || ($userLogued == "12915") || ($userLogued == "12916")){  
            return false;
        }else{
            //Si es algún otro departamento diferente a esos tres devuelve true
            return true;
        }
    }
?>
