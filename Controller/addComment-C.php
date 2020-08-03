<?php

    $ticketKey = $_POST['ticketKey']; //EJ: REQOPDS-32
    $newComment = $_POST['newComment']; //Comentario que viene desde el Form


    require_once("../Model/functionsCurl-M.php");
    require_once("../Model/functionsGeneral-M.php"); 

    //----------------------------------------------------------------------------------------
    //post con body = $newComment e issue = $ticketKey
    $ch = curlConnectPostPutComment($ticketKey);
    if (isset($ticketKey) && ($newComment != $_SESSION["oldAddedComment"])){
        $arr = constructArrayAddComment($newComment);
        $isCreated = true;
        //Guardo los datos recopilados
        $json_arr  = $arr;
        $json_string = json_encode ($json_arr);   
        //Ejecuto consulta Curl
        $result = curlExecPost($ch, $json_string); //$result Tiene el msj de respuesta
        $_SESSION["oldAddedComment"] = $newComment; //No se agrega el mismo comentario que agregó antes
    }   

    //----------------------------------------------------------------------------------------
    //Lo mismo que traerse todos los comentarios; simulo recarga luego de agregar un comentario
    //Obtengo toda la info del issue, con sus comentarios (Recargo)
    $ch = curlConnectGetIssueAllFields($ticketKey);

    //Ejecuto consulta Curl
    $ticketGet = curlExecGet($ch);

    $jsonTicket = json_decode($ticketGet);
    $json = json_decode($ticketGet, true);

    //json to object
    if($json["errorMessages"][0]){
        $message="El numero de ticket ingresado es incorrecto o inexistente; vuelva a intentarlo";
    }else{

        //Estado ticket
        $statusTicket = set_value_dump($json["fields"]["status"]["name"]); //Estado del ticket
        $cutWord = return_cut_value($statusTicket, 10);

        //Titulo Ticket
        $summaryTicket = set_value_dump($json["fields"]["summary"]); //Titulo del ticket
        $cutSummaryTicket = return_cut_value($summaryTicket, 10);

        $comments = set_value_dump($json["fields"]["comment"]["comments"]); //Todos los Comentarios
        $totalComments=($json["fields"]["comment"]["total"]); //Cantidad de comentarios (int)
        
        if($totalComments > 0){ //Si hay comentarios
            $arrayOfComments = array("size" => $totalComments);

            for($i=0; $i < $totalComments; $i++){
                //Coment tiene: Array: "self"/"id"/"author"/"body"/"createdupdated"/updateAutor
                $comment = $json["fields"]["comment"]["comments"][$i]; 
                $bodyComment = $json["fields"]["comment"]["comments"][$i]["body"];
                //Array con los comentarios y su autor respectivamente
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

                    $arrayOfAttachments[$pos]["urlContentFile"] = $json["fields"]["attachment"][$pos]["content"];
                    $pos++;
            }else{
                    $isNotEnd=false;
            }
        } 
        $arrayOfAttachments["size"] =sizeof($arrayOfAttachments);



        $message="Datos obtenidos correctamente";
    }   

    include "../View/ticketSearchedInfo.php";
?>	