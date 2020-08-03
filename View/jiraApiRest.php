<!DOCTYPE html>
<html>
<head>
    <title>OPDS</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="../Apparance/Style-css/style-index.css">
    <link rel="stylesheet" href="../Apparance/Style-css/style-jiraApiRest.css">
    <link rel="stylesheet" href="../Appearance/Bootstrap-4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="../Appearance/Bootstrap-4/js/bootstrap.min.js"> </script>
    <script src="../Appearance/Bootstrap-4/js/jquery-3.3.1.min.js"> </script>
    <script src="../Appearance/Bootstrap-4/js/popper.min.js"> </script>
    <script src="../Appearance/Bootstrap-4/js/bootstrap.bundle.js" > </script>
    <script src="../Appearance/Bootstrap-4/js/bootstrap.bundle.min.js"> </script> 
    <script src="../Appearance/JavaScript/js-jiraApiRest.js"> </script> 

<style>
.fuente {
  font-family: 'Montserrat', sans-serif;
  font-size:30px;
}
.fuente-txt {
  font-family: 'Montserrat', sans-serif;
  font-size:19px;
}
.fuente-titulo-txt {
  font-family: 'Montserrat', sans-serif;
  font-size:17px;
  color:#4d4d4d;
}
.fuente-titulo {
  font-size:18px;
  font-family: 'Montserrat', sans-serif;
  color:#4d4d4d;
}
</style>

</head>

<body style="background-color: #fafafa "> 
<div id="wrapper">
    <div class="container" >


      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
           <ul class="navbar-nav mr-auto mt-2 mt-lg-0">       
              <a href="../View/index.php"">Crear Ticket</a>
              <a href="../View/searchTicket.php"">Buscar Ticket</a>
   
          </ul>
        </div>
        </nav>


    <form action="../Controller/createIssue-C.php" name="general" method="POST" class="form-group">     
         <div class="row mt-3 mx-3">
            <div class="col " >
               <p class="text-success fuente mt-2"> Crear Ticket  </p>
            </div>   
          </div>  

          <hr>           
            <div class="row mt-3 mx-3">
               <div class="col-2" >
                  <p class="fuente-txt mt-2"> Mail  Requiriente </p>            
               </div>

               <div class="col">
                  <input type="text" name="customfield_10007" id="customfield_10007"  class="form-control" required="true" value="pedrito@gmail.com"> 
               </div>    
            </div>

            <input type="hidden" name="sector"  value="OPDS"/> 
          
            <div class="row mt-3 mx-3">
               <div class="col-2" >
                  <p class="fuente-txt mt-2"> Tipo Solicitud  </p>         
               </div>

               <div class="col">
                   <select class="form-control" name="issueType" required="true">
                      <option value="0"> Seleccione </option>
                      <option value="ISSUESOPORTE">Maquina o Impresora </option>
                      <option value="ISSUESOPORTE">Problema de Red</option>
                      <option value="ISSUESOPORTE">Usuario de Red </option>
                      <option value="ISSUEOPDS">Aplicacion OPDS</option>
                   </select>
               </div>    
            </div> 

            <div class="row mt-3 mx-3">
               <div class="col-2" >
                   <p class="fuente-txt mt-2"> Asunto Ticket  </p>          
               </div>

               <div class="col">
                   <input type="text" name="summary" id="summary" class="form-control" required="true" value="PRUEBA REST HTML - Borrar"> 
               </div>    
            </div> 

            <div class="row mt-3 mx-3">
               <div class="col-2" >
                   <p class="fuente-txt mt-2"> Descripcion  </p>
                
               </div>

               <div class="col">
                   <textarea class="form-control" rows="7" cols="5" name="description" id="description" required="true" >"PRUEBA REST HTML - Borrar" </textarea>
               </div>    
            </div>   

            <div class="row mt-3 mx-3">
            <div class="col offset-6" >
               <input type="submit" name="button" value="Enviar Solicitud" class="btn btn-success btn-lg" onclick="return validateFormCreateIssue();">      
            </div>
              
            <input type="hidden" name="idLogeado" value="idempleado">
            <input type="hidden" name="departamento" value="apellido">
     </form>
     
    </div> 
   </div>
</body>
</html>