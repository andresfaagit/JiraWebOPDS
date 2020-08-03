<? 
    header('Cache-Control: no cache'); //Evita revalidación de formularios (puede ir hacia atrás con la flecha del navegador)
                                       //Se usa entre controllers, para evitar el "error": https://www.rephp.com/navegar-de-vuelta-con-el-envio-de-formulario-php.html

    require_once('../Model/functionsLoginOPDS-M.php'); //-->Reemplaza a: require_once('lib/nusoap.php');

    $client = connect_nunusoap_OPDS();

    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        // At this point, you know the call that follows will fail
    }
    //usu and pass: informatica:ponecualquiera (TEST)
    $usu = ($_POST['userLogin']);
    $pass = ($_POST['userPassword']);
    //Método que devuelve la validación de user y pass contra el sistema de OPDS
    $ret = validateUserOPDS ($usu, $pass, $client);


    if(jiraisRunning() && pingToJiraServer()){
    //------------------------------------SI JIRA ESTA CORRIENDO--------------------------------------//
    //------------------------------------SI JIRA RESPONDE PING---------------------------------------//    
    //-------------------------------------------MUESTRO----------------------------------------------//
    //print_r($ret);
    //OK: Array ( [idempleado] => 1349 [apellido] => INFORMATICA [nombre] => DPTO. [documento] => [mensaje] => Usuario y Clave Valida ) idempleado1349 
    //NO OK: Array ( [mensaje] => No-Existe )    
    //Obtener dato específico: $ret["mensaje"];
                 
        if ( $client->fault ) {
            echo  $client->faultcode;
            echo  $client->faultstring;
            echo  $client->faultactor;
            echo  $client->faultdetail;
        }else{
            if (userNotLogued($ret["mensaje"])) {
                    $message = "Usuario y/o pasword erroneos. Vuelva a intentar";
                    include "../View/login.php";
                    
            }else{
                if(retIsArrayResponse($ret)){
                    //--------------------------------SI Api de loguin OPDS respondió---------------------------------//
                    //Si se logeó correctamente
                    session_start();
                    $_SESSION['isLogued'] = true;
                    $_SESSION['userLogued'] = $ret["idempleado"];
                    $_SESSION['nameLogued'] = $ret["nombre"];
                    $_SESSION['surnameLogued'] = $ret["apellido"];
            
                    $userLogued = $ret["idempleado"];
                    $nameLogued = $ret["nombre"];
                    $surnameLogued = $ret["apellido"];
                    $_SESSION['havePermission'] = havePermissionToAccess($userLogued, $nameLogued);            

                    include "../View/index.php";
                    //header("Location: index.php");

                    
                }else{
                    //No hay respuesta de loguin OPDS - soap_client  
                    $message="Temporamente servicio fuera de linea (ERROR: soap_conec). Intente mas tarde o comuniquese con MDA OPDS";
                    include "../View/login.php";
                }    
            }
        }    
       
    }else{
        $message="Temporamente servicio fuera de linea (ERROR: jiraSV_down). Intente mas tarde o comuniquese con MDA OPDS";
        include "../View/login.php";
    }
    
?>  