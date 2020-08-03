
function validateFormCreateIssue(){
    var marca=true; 
    if (document.general.issueType.value == 0){    
        marca=false; 
        alert('Tipo de Solicitud erroneo'); 
    }else{
        document.general.submit();
    }

    return marca ;  
  }