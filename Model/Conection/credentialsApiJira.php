<?php

    //URL Base de Api Rest Jira OPDS
    function getURLJiraPathBase(){
    	return 'http://incidenciasexternas.opds.gba.gov.ar:8080';
    }

    //Usuario y contraseña necesarios para pegarle a la Api de jira
    //Authorization --> Basic
    function authApiJira (){
         $user = "Receptor";
         $pass = "opds";

         $credentials = ($user.':'.$pass);
         return $credentials; 
    }
?>
