<?php 
      $ruta = __DIR__;
      
      if(isset($_FILES['fileToUpload'])){
            $errors     = array();
            $file_name  = $_FILES['fileToUpload']['name'];
            $file_size  = $_FILES['fileToUpload']['size'];
            $file_tmp   = $_FILES['fileToUpload']['tmp_name'];
            $file_type  = $_FILES['fileToUpload']['type'];

            $formatos_permitidos =  array('jpeg','jpg','png','heic','heif');
            $extension           = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            if(!in_array($extension, $formatos_permitidos) ) {
               echo  json_encode(array(
                        'Error' => true, 
                        'name' => 'Formato no permitido')                        
                     );
               exit;
            }

            //if($file_size > 2097152) {
            if($file_size > 5242880){
               $errors[] = 'El archivo no puede superar los 10 MB';
            }  

            if(empty($errors) == true) {
                  if(move_uploaded_file($file_tmp, $ruta."\\img\\productos\\".$file_name)){
                     $mensaje = "Se subio correctamente";
                  }
                  else{
                     $mensaje = "Hubo un detalle en la subida";
                  }
                  echo  json_encode(array(
                              'Error' => false, 
                              'name'  => $file_name,
                              'cMensaje' => $mensaje,
                              'ruta'  => $ruta."\\img\\productos\\",
                              'extension' => $_FILES['fileToUpload']['type']

                           )
                        );
            }else{
               
               echo json_encode(
                                 array(
                                    'Error'  => true, 
                                    'name'   => $file_name,
                                    'size'   => $file_size,
                                    'cError' => $errors
                                 )
                              );
            }//
      }
  
?>