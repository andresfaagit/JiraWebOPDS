<?php
    header('Cache-Control: no cache'); //Evita revalidación de formularios (puede ir hacia atrás con la flecha del navegador)
                                       //Se usa entre controllers, para evitar el "error": https://www.rephp.com/navegar-de-vuelta-con-el-envio-de-formulario-php.html
    if ($_SESSION['isLogued']){
        require_once("../Model/functionsCurl-M.php");
        require_once("../Model/functionsGeneral-M.php"); 

        if(isset($_GET['ticketKey'])){
             //POR GET
             $ticketKey = (to_utf8($_GET['ticketKey']));
             unset($_GET['ticketKey']); //no iria
        }else{
             //Número ingresado en View/searchTicket.php Por POST
             $ticketKey = ($_POST['ticketKey']);
        }

        $ticketKey = trim($ticketKey); //Saca espacio en blanco al principio de la cadena
        $ch = curlConnectGetIssueAllFields($ticketKey);

        //Ejecuto consulta Curl
        $ticketCreated = curlExecGet($ch);

        $jsonTicket = json_decode($ticketCreated);
        $json = json_decode($ticketCreated, true);

        //json to object
        if($json["errorMessages"][0] || empty($json)){
            $message="El numero de ticket ingresado es incorrecto o inexistente; vuelva a intentarlo";
        }else{

            //Estado Ticket
            $statusTicket = set_value_dump($json["fields"]["status"]["name"]); //Estado del ticket
            $cutWord = return_cut_value($statusTicket, 10);

            //Titulo Ticket
            $summaryTicket = set_value_dump($json["fields"]["summary"]); //Titulo del ticket
            $cutSummaryTicket = return_cut_value($summaryTicket, 10);

            //Descripción Ticket
            $desciption = set_value_dump($json["fields"]["description"]); //Descripcion del ticket
            $descriptionTicket = return_cut_value($desciption, 10);
            $_SESSION["descriptionTicketTemp"] = $descriptionTicket;

            //Comentarios Ticket
            $comments = set_value_dump($json["fields"]["comment"]["comments"]); //Todos los Comentarios
            $totalComments=($json["fields"]["comment"]["total"]); //Cantidad de comentarios (int)
        
            if($totalComments > 0){ //Si hay comentarios
                $arrayOfComments = array("size" => $totalComments);

                for($i=0; $i < $totalComments; $i++){
                    //Coment tiene: Array: "self"/"id"/"author"/"body"/"createdupdated"/updateAutor
                    $comment = $json["fields"]["comment"]["comments"][$i]; 
                    $bodyComment = $json["fields"]["comment"]["comments"][$i]["body"];
                    //Armar array con los comentarios y pasarlo a la vista
                    $arrayOfComments[$i] = $bodyComment;
                    $arrayOfAuthors[$i]["author"] = $json["fields"]["comment"]["comments"][$i]["author"]["name"];
                } 
            }

            //Adjuntos Ticket
            $attachments = set_value_dump($json["fields"]["attachment"]); //Todos los attachments
            //Esto devuelve null: $json["fields"]["attachment"][3]["filename"];
            //Esto devuelve algo (pos 3): $json["fields"]["attachment"][2]["filename"];

            $isNotEnd=true;
            $pos=0;
            while($isNotEnd) { //Tope de archivos (cantidad)
                  if($json["fields"]["attachment"][$pos]["filename"] != null){ 
                        $attachmentName = $json["fields"]["attachment"][$pos]["filename"];
                        $arrayOfAttachments[$pos]["attachmentName"] = $attachmentName;

                        $arrayOfAttachments[$pos]["idFile"] = $json["fields"]["attachment"][$pos]["id"];
                        $arrayOfAttachments[$pos]["urlContentFile"] = $json["fields"]["attachment"][$pos]["content"];
                        $pos++;
                   }else{
                        $isNotEnd=false;
                   }
            } 
            $arrayOfAttachments["size"] =sizeof($arrayOfAttachments);
            //$sizeOfArrayOfAttachments = sizeof($arrayOfAttachments);

            $message="Datos obtenidos correctamente";
        }

        include "../View/ticketSearchedInfo.php";
    }else{
        //No está logueado
        $message = "Acceso denegado";
        echo("Acceso denegado");
        include "../View/message.php"; 
    }   
    
?>  