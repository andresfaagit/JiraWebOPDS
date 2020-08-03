<?php
    
    require_once("../Model/functionsCurl-M.php");
    require_once("../Model/functionsGeneral-M.php"); 

    if ($_SESSION['isLogued']){
            $ticketKey = to_utf8($_POST['ticketKey']); //EJ: REQOPDS-32
            //$newAttachment = $_POST['attachment']; //adjunto que viene desde el Form por Post
            //----------------------------------------------------------------------------------------

            //Como construir el $data que recibe la api rest de jira con el archivo:
            //https://community.atlassian.com/t5/Jira-questions/Upload-URL-Attachment-via-API-on-JIRA-PHP/qaq-p/44828
            //https://community.atlassian.com/t5/Questions/JIRA-How-to-add-attachment-for-issues-using-REST-API-PHP/qaq-p/80626

            $attachmentAdded = false;
            $newAttachment =$_FILES['file']; //adjunto que viene desde el Form
            if (isset($_FILES['file']) && ($newAttachment['name'] != $_SESSION["oldAddedAttachment"])) {
                    //ACA TENGO - EJ: Ticket >> ISSUE-488| Archivo >> 820| Extension >> txt| tmp_name >> /tmp/phpOjDWzH

                    if (isset($ticketKey)){
                            $operation = AddAttachmentToJira($ticketKey, $newAttachment);
                            if($operation == "Size accepted"){
                                    $attachmentAdded = true;
                                    $_SESSION["oldAddedAttachment"] = $newAttachment['name']; //No se agrega el mismo adjunto que agregó antes
                            }else{
                                $attachmentAdded = false;
                            }
                    }
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
                $message="Error al obtener el ticket; vuelva a intentarlo";
            }else{

                //Estado ticket
                $statusTicket = set_value_dump($json["fields"]["status"]["name"]); //Estado del ticket
                $cutWord = return_cut_value($statusTicket, 10);

                //Titulo Ticket
                $summaryTicket = set_value_dump($json["fields"]["summary"]); //Titulo del ticket
                $cutSummaryTicket = return_cut_value($summaryTicket, 10);

                //Obtengo los comentarios del ticket
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

                //$message se usa para validar en la vista               
                if ($attachmentAdded == true){
                    $message="Adjunto agregado correctamente";
                }else{
                    if($operation == "Size exceeded"){
                        $messageAttachmentExceeded="Adjunto demasiado grande";
                        
                    }
                    
                    $message="Datos obtenidos correctamente";
                }    

            }

            include "../View/ticketSearchedInfo.php";      

    }else{ 
        //No está logueado
        $message = "Acceso denegado";
        echo("Acceso denegado");
        include "../View/message.php"; 
    } 
?>