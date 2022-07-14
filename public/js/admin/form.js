var messageResponse= $('#processData'),
    textErrorRecaptcha = '<div class="error">Por favor selecciona el código de verificación humana</div>';

function uploadFile(el, id, bProcedencia){//Funcion encargada de enviar el archivo via AJAX    

    var inputFileImage = document.getElementById(el.id);
    var file           = inputFileImage.files[0];
    var data           = new FormData();
    
    data.append('fileToUpload',file);
                
    $.ajax({
        url: url_global+"/public/subirFile.php",
        type: "POST",
        dataType: 'JSON',
        data: data,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
            if(data != "")
                $("#"+id).val(data.name);
        }
    });   
}


function validateCatalago(){

    if($("#formCurso #nombre").val() == ''){
        return false;
    }

    return true;
}
