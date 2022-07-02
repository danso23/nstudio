var messageResponse= $('#processData'),
    textErrorRecaptcha = '<div class="error">Por favor selecciona el código de verificación humana</div>';

function uploadFile(el, id, bProcedencia){//Funcion encargada de enviar el archivo via AJAX
    
    // switch (bProcedencia) {
    //   case 'C':
    //     if(!validateCatalago()){
    //         Swal.fire('Falta información para continuar la subida de archivos');
    //         return            
    //     }
    //     break;
    //   case 'Manzanas':
    //     console.log('El kilogramo de manzanas cuesta $0.32.');
    //     break;
      // case 'Platanos':
      //   console.log('El kilogramo de platanos cuesta $0.48.');
      //   break;
      // case 'Cerezas':
      //   console.log('El kilogramo de cerezas cuesta $3.00.');
      //   break;
      // case 'Mangos':
      // case 'Papayas':
      //   console.log('El kilogramo de mangos y papayas cuesta $2.79.');
      //   break;
      // default:
      //   console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
    // }



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
