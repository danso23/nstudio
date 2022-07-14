var objDataTbl;
var objTarget;
var elemtetmp;

const Toast = Swal.mixin({
							  toast: true,
							  position: 'center',
							  showConfirmButton: false,
							  timer: 3000,
							  timerProgressBar: true,
							  didOpen: (toast) => {
							    toast.addEventListener('mouseenter', Swal.stopTimer)
							    toast.addEventListener('mouseleave', Swal.resumeTimer)
							  }
							})

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.formatNumber').on('keyup',function(){

	// skip for arrow keys
  if(event.which >= 37 && event.which <= 40){
    event.preventDefault();
  }

  $(this).val(function(index, value) {
    return value
      .replace(/\D/g, "")
      .replace(/([0-9])([0-9]{2})$/, '$1.$2')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
    ;
  });

		// replace(/[^\d.,]+/g,'').replace(/[.,](?![^,.]*$)/g, '').replace(',','.')
  //        .replace(/(\.\d{3})\d*$/, '$1 ')
  //         .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 '));

});


$(document).ready(function(){	
 			
	
	/**************************************** Section view *******************************************************/
	$('#return_table').on('click',function(){
		$('#area_table').show();
		$('#gesto').hide();
		
		$('.carousel-inner').empty();
		$('.carousel-inner').append(elemtetmp);
		
		$('#gesto').find('.crload').each(function(){							
			$(this).val('');
		});				
		document.querySelector('#'+form[0].id+' #hdditem').value = 0;		
		
		if (myDropzone.files.length > 0){ 
			myDropzone.removeFile(myDropzone.files[0]);
		}
		

		objDataTbl.destroy();
		dataCurso() ;
		objDataTbl.columns.adjust().draw();
	});
	

	/**************************************** Section C *******************************************************/

	// $("#button").click(function (e) {
	$('#formCurso').on('submit',function(e){                
        e.preventDefault();
        let bS = false;
        $('#gesto').find('.crload').each(function(){							
					if($(this).val() == ''){
						$(this).focus();
						Toast.fire({
						  icon: 'error',
						  title: 'Acompleta la información necesaria'
						})
						bS = true;
						
						return false;
					}
				});	
        
        if(!bS){
					$.post({url:url_global+"/admin/storeProducto_beta",data: $('#formCurso').serializeArray(),cache: false,})
	        .done(function(data,status) {          
	          
	          if(!data.lError){          
	          	$('#hdditem').val(data.cError);
	          	$('#bstate').val(true);    

	          				       
					    if(myDropzone.getRejectedFiles().length > 0) {
					        Toast.fire({
									  icon: 'error',
									  title: 'Imagenes no validas'
									})
					    }
							else if (myDropzone.files.length > 0){ 
								myDropzone.processQueue();
							}
							else{
								Toast.fire({
							  	icon: 'success',
							  	title: 'Edición realizado con exito'
								})	
							}
	          }
	          else{

	            Toast.fire({
						  	icon: 'error',
						  	title: data.cMensaje
							})
	          }
	        });	
        }    
	});	

	$('.carousel-inner').on('click','a.deleteIm',function(){
		let hiImg = $(this).data('del');
		Swal.fire({
		  title: '¿Estas seguro de eliminar la imagen'+$(this).data('del'),
		  text: "¡Esta acción no se podra deshacer!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: '¡Si, Eliminar!'
		}).then((result) => {
		  if(result.isConfirmed) {
		    

		  	$.post({url:url_global+"/admin/delimg",data:{refereimg: hiImg,uuidprod:$('#hdditem').val()} ,cache: false,})
		    .done(function(data,status) {          
		     	
		     	Swal.fire(
				      '¡Eliminado!',
				      data,
				      'success'
		    		)	 
		      if(!data.lError){          
		      	
		      	objDataTbl.destroy();
						dataCurso() ;
						objDataTbl.columns.adjust().draw();
		        
		        document.getElementById("prod_"+hiImg).remove();	

		        Swal.fire(
				      '¡Eliminado!',
				      data.cMensaje,
				      'success'
		    		)		               
		      }
		      else{
		        
		      }
		    });		    
		  }
		})		
	});

	$('.carousel-inner').on('click','a.setPortada',function(){
				
		Swal.fire({
        title: 'Procederas a cambiar la portada del producto. ¿Desea continuar?',
        //showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        //denyButtonText: `Regresar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {                        

        	let getElement = $(this).data('cover');

					$.post({url:url_global+"/admin/changecover",data: {uuidprod: $('#hdditem').val(),setcover:getElement},cache: false,})
			    .done(function(data,status) {          
			      
			      if(!data.lError){  

			      	$('.product-image3').find('span').each(function(){ 
			      			$(this).prev('ul.social').prepend('<li><a data-toggle="tooltip" title="Selecciona Portada" class="setPortada" data-cover="'+$(this).prev('ul.social').find('.deleteIm').data('del')+'"><i class="fa fa-cog"></i></a></li>');
			      			$(this).remove();      			
			      	});

			      	$('.carousel-inner').find('#prod_'+getElement).each(function(){

			      		$(this).closest('div').find('.product-image3').append('<span class="product-new-label">Portada</span>');
			      		$(this).find('ul.social .setPortada').remove();
			      		$('.tooltip').tooltip('hide');

			      	});        	     	


			        Toast.fire({
									  	icon: 'success',
									  	title: data.cMensaje
										})	        
			      }
			      else{
			        
			      }
			    });	                 
        } 
      })			
	});
	

	/**************************************** Section table *******************************************************/
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});

	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});

	$('#catalogo_productos').on('click','a.delete',function(){		

		Swal.fire({
		  title: '¿Estas seguro eliminar el folio: '+$(this).data('position')+'?',
		  text: "¡Esta acción no se podra deshacer!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: '¡Si, Eliminar!'
		}).then((result) => {
		  if(result.isConfirmed) {
		    

		  	$.post({url:url_global+"/admin/delitem",data:{refereimg: $(this).data('position')} ,cache: false,})
		    .done(function(data,status) {          
		      
		      if(!data.lError){          
		      	
		      	objDataTbl.destroy();
						dataCurso() ;
						objDataTbl.columns.adjust().draw();
		        
		        Swal.fire(
				      '¡Eliminado!',
				      data.cMensaje,
				      'success'
		    		)		               
		      }
		      else{
		        
		      }
		    });		    
		  }
		})
	});



	/**************************************** Section old *******************************************************/	

	$("#btnGuardarTemario").click(function(e) {
		e.preventDefault();
		guardarTemario();
	});

	$("#btnGuardarCurso").click(function(e) {
		e.preventDefault();
		guardarProducto();
	});

	$("#btnGuardarMaterial").click(function(e) {
		e.preventDefault();
		guardarMaterial();
	});

	$("#btnGuardarUsuario").click(function(e) {
		e.preventDefault();
		guardarUsuario();
	});
});




function dataCurso() {	
	$.ajax({
		type: "GET",
		dataType: "json",
		url: url_global+"/admin/jsonproductos",
		success: function(data){
			var element ="";
			console.log(data);
			element +="<thead>"+
                    	"<tr>"+
							"<th>"+"Folio"+"</th>"+
	                        "<th>Producto</th>"+
	                        "<th>Descripción</th>"+
							"<th>Portada</th>"+
							"<th>Imagen 2</th>"+
							"<th>Imagen 3</th>"+
							"<th>Imagen 4</th>"+
							"<th>Imagen 5</th>"+
							"<th>Imagen 6</th>"+
	                        "<th>Precio</th>"+
							"<th>Cantidad S</th>"+
	                        "<th>Acciones</th>"+
							"<th>Id</th>"+
							"<th>IdCategoria</th>"+
							"<th>cantidad_s</th>"+
							"<th>cantidad_m</th>"+
							"<th>cantidad_g</th>"+
							"<th>busto_s</th>"+
							"<th>busto_m</th>"+
							"<th>busto_g</th>"+
							"<th>largo_s</th>"+
							"<th>largo_m</th>"+
							"<th>largo_g</th>"+
							"<th>manga_s</th>"+
							"<th>manga_m</th>"+
							"<th>manga_g</th>"+
							"<th>color</th>"+
                    	"</tr>"+
            		"</thead>"+
					"<tbody>";
						data.forEach((el, i) => {
							element += "<tr>"+
								"<td>"+//0
									"<span class='custom-checkbox'>"+
										"<input type='checkbox' id='checkbox"+el.id_producto+"' name='options[]' value='"+el.id_producto+"'>"+
										"<label for='checkbox"+el.id_producto+"'>"+el.id_producto+"</label>"+
									"</span>"+
								"</td>"+
								"<td>"+el.nombre_producto+"</td>"+
								"<td>"+el.desc_producto+"</td>"+
								"<td>"+el.url_imagen+"</td>"+
								"<td>"+el.url_imagen2+"</td>"+
								"<td>"+el.url_imagen3+"</td>"+//5
								"<td>"+el.url_imagen4+"</td>"+
								"<td>"+el.url_imagen5+"</td>"+
								"<td>"+el.url_imagen6+"</td>"+
								"<td>"+el.precio+"</td>"+
								"<td>"+el.cantidad_s+"</td>"+ //10
								"<td>"+
									"<a href='#editCursoModal_' class='edit' id='btn_edit_"+el.id_producto+"' data-toggle='modal' onclick='storeCurso("+i+","+'"Editar"'+")'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>"+
									"<a class='delete' id='btn_delete_"+el.id_producto+"' data-toggle='modal' data-position='"+el.id_producto+"'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>"+
								"</td>"+
								"<td>"+el.id_producto+"</td>"+
								"<td>"+el.id_categoria+"</td>"+
								"<td>"+el.cantidad_s+"</td>"+
								"<td>"+el.cantidad_m+"</td>"+//15
								"<td>"+el.cantidad_g+"</td>"+
								"<td>"+el.busto_s+"</td>"+
								"<td>"+el.busto_m+"</td>"+
								"<td>"+el.busto_g+"</td>"+
								"<td>"+el.largo_s+"</td>"+//20
								"<td>"+el.largo_m+"</td>"+
								"<td>"+el.largo_g+"</td>"+
								"<td>"+el.manga_s+"</td>"+
								"<td>"+el.manga_m+"</td>"+
								"<td>"+el.manga_g+"</td>"+
								"<td>"+el.color+"</td>"+//26
							"</tr>";
						});
					element += "</tbody>";
					objTarget = {"visible": false,  "targets": [ 3,4,5,6,7,8,10,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26] };
					
					$("#catalogo_productos").empty();
					$("#catalogo_productos").html(element);
					crearDataTable("catalogo_productos", objTarget);			
    	}
	});
}


function crearDataTable(table, target){

		objDataTbl 	= $("#"+table).DataTable({
						responsive: true,
						autoWidth: false,
						order: [ 0, 'asc' ],
						serverside:true,
						language: {
							"zeroRecords": "No se encontró coincidencias",
							"info": "Mostrando la página _PAGE_ de _PAGES_",
							"infoEmpty": "No records available",
							"infoFiltered": "(filtrado de _MAX_ registros totales)",
							'search': 'Buscar:',
							"lengthMenu":"Mostrar _MENU_ registros",
							'paginate': {
								'next': 'Siguiente',
								'previous': 'Anterior',
							}
						},
						"lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
						"iDisplayLength":	5,
						"columnDefs": [{},target]
					});
}


function deleteCurso(position, tipoAccion){
    
    $(".delete").click(function(e) {
        e.preventDefault();
    });
    if(tipoAccion == "Eliminar"){}
}

function storeCurso(position, tipoAccion){

	$('#area_table').hide();
	$('#gesto').show();

	if(!elemtetmp){
		elemtetmp = $('#default_item').clone();	
	}
	

	if(tipoAccion == "Editar"){
		var datos = objDataTbl.row( position ).data();
		document.getElementsByClassName("header")[0].innerText 							= 'Editar Producto '+datos[1];
		document.querySelector('#'+form[0].id +' #modalidad').value 				= "Editar";
		document.querySelector('#'+form[0].id +' #nombre').value						= datos[1];
		document.querySelector('#'+form[0].id +' #desc_prod').value					= datos[2];
		document.querySelector('#'+form[0].id +' #precio').value						= datos[9];
		document.querySelector('#'+form[0].id +' #tall_xs').value						= (datos[14] == "null") ? 0 : datos[14];//datos[14];
		document.querySelector('#'+form[0].id +' #talla_md').value					= (datos[15] == "null") ? 0 : datos[15];//datos[15];
		document.querySelector('#'+form[0].id +' #talla_lg').value					= (datos[16] == "null") ? 0 : datos[16];//datos[16];
		document.querySelector('#'+form[0].id +' #color_clothes').value			= datos[26];
		document.querySelector('#'+form[0].id +' #categoria_cloths').value	= datos[13];
		document.querySelector('#'+form[0].id+' #hdditem').value 						= datos[12];				
		

		$.post({url:url_global+"/admin/itemsimg",data:{refereimg: datos[12]} ,cache: false,})
    .done(function(data,status) {          
      
      if(!data.lError){          
      	
        $('.carousel-inner').empty();        
        $('.carousel-indicators').empty();
        
        if(data.data.length > 0){
	        data.data.forEach((el, i) => {

	        	let avtiv = (i ==0) ? 'active': '';
	        	let cover = (el.coverimg) ? true : false;
	        	
	        	$('.carousel-inner').append(getItem(avtiv,'../public/'+el.url_path,el.idimgrel,cover));
	        	$('.carousel-indicators').append(getindicators(i,cover));
	        	$('[data-toggle="tooltip"]').tooltip();
	        });
	      }
	      else{
	      	$('.carousel-inner').append(getItem('active','../public/img/noimage.png','',true));
	      }

      }
      else{
        
      }
    });


		// $('.carousel-inner').empty();
		// var Element = "";

		// for(var i=3;i<=8;i++){
		// 	var avtiv = (i==3)?'active':'';
		// 	if(datos[i] != '' && datos[i] != "null" && datos[i] != null){
		// 		// Element = getItem(avtiv,datos[i]);
		// 		$('.carousel-inner').append(getItem(avtiv,'../public/img/productos/'+datos[i]));
		// 	}
		// }

							
	}
	if(tipoAccion == "Nuevo"){
		// document.getElementsByClassName("header").innerHTML = 'Agregar producto';
		document.getElementsByClassName("header")[0].innerText = 'Agregar Producto';
		document.querySelector('#'+form[0].id +' #modalidad').value = "Nuevo";
		document.querySelector('#'+form[0].id+' #hdditem').value = 0;		
		// elemtetmp = $('#default_item').clone();
		$('.carousel-inner').empty();
		$('.carousel-inner').append(elemtetmp);
		$('#gesto').find('.crload').each(function(){							
			$(this).val('');
		});		
		// document.getElementById(form[0].id).reset();
	}
}

function getItem(active,url,uuid = '',cover){

	let Element = '';
	let uuidiv 		= (uuid == '') ? '' : ' id="prod_'+uuid+'" ';
	Element  	+= '<div class="carousel-item '+active+'" '+uuidiv+'>';
				Element 	+= '<!-- <img class="d-block w-100" src="https://i.hizliresim.com/LDPMg0.jpg" alt="First slide"> -->';
				Element     += '<div class="product-grid3">';
				Element     += '<div class="product-image3">';
				Element     += '<div>';
				Element     +=	'<img class="pic-1" src="'+url+'">';
				// Element     +=  '<!-- <img class="pic-2" src="https://www.w3schools.com/bootstrap4/img_avatar3.png"> -->';
				Element     +=  '</div>';
				Element     +=  '<ul class="social">';
				Element     +=  (!cover) ? '<li><a data-toggle="tooltip" title="Selecciona Portada" class="setPortada" data-cover="'+uuid+'"><i class="fa fa-cog"></i></a></li>' : '';
				Element     +=  (uuid != '') ?    '<li><a data-toggle="tooltip" title="Elimina Imagen" class="deleteIm" data-del="'+uuid+'"><i class="fa fa-trash" data></i></a></li>': '';
				Element     +=  '</ul>';
				Element     +=  (cover) ? '<span class="product-new-label">Portada</span>' : '';
				Element     +=  '</div>';
				Element     +=  '</div>';
				Element     +=  '</div>';
	
	return Element;				

}

function getindicators(number, cover){

		let active = (cover) ? 'active' : '';
		return '<li data-target="#MiddleCarousel" data-slide-to="'+number+'" class="'+active+'"></li>';	
}

function guardarProducto(){
	
	dataform = $('#'+form[0].id).serialize();
	dataform+="&token="+document.querySelector('meta[name="_token"]').getAttribute('content');
	dataform+="&portadaFile="+$("#portadaFile").val();
	$.ajax({
		type: "POST",
    	dataType: "json",
    	url: url_global+"/admin/storeProducto/"+document.getElementById("hddIdCurso").value,
		data: dataform,
		success: function(data){
			alert(data.message);
		},
		error: function (jqXHR, exception){
			var msg = '';
			if (jqXHR.status === 0)
				msg = 'Not connect.\n Verify Network.';
			else if (jqXHR.status == 404)
				msg = 'Requested page not found. [404]';
			else if (jqXHR.status == 500)
				msg = 'Internal Server Error [500].';
			else if (exception === 'parsererror')
				msg = 'Requested JSON parse failed.';
			else if (exception === 'timeout')
				msg = 'Time out error.';
			else if (exception === 'abort')
				msg = 'Se aborto el proceso.';
			else
				msg = 'Uncaught Error.\n' + jqXHR.responseText;
			console.log(msg);
			alert("Ocurrio un error[1]")
		}
	});
}

var myDropzone = '';

var NumberProd = 0;

Dropzone.autoDiscover = false;

$(function() {


	myAwesomeDropzone = {
	    url: url_global+"/admin/processimg",
	    addRemoveLinks: true,
	    // paramName: "Archivo",
	    parallelUploads:3,
	    maxFiles: 3,
	    uploadMultiple:true,
	    autoProcessQueue: false,
	    maxFilesize: 4, // MB
	    dictRemoveFile: "Quitar",
	    dictInvalidFileType: "Archivo no valido",
	    dictFileTooBig: "El archivo es muy grande ({{filesize}} Mb). Tamaño Permitido: {{maxFilesize}} Mb.",
	    acceptedFiles: ".jpeg,.jpg,.png,.gif",
	    autoDiscover: false,
	    accept:function(file, done) {
	        done();	        
	    },
	    removedfile: function (file) {    		    		
    		
    		file.previewElement.remove();

    		if($('.carousel-inner').find('#'+file.upload.uuid+'.active').length > 0){						
						$('#'+file.upload.uuid+'.active').removeClass('active');
						$('#'+file.upload.uuid).prev().addClass('active');	
						document.getElementById("prod_"+file.upload.uuid).remove();						
				}    		
				else{
					if($('.carousel-inner').find('#prod_'+file.upload.uuid).length > 0){
						document.getElementById("prod_"+file.upload.uuid).remove();
					}
				}

			},	
			thumbnail: function(file,thumb){								    		

				$('#fileUploadHandler').prepend($(file.previewElement));

				for (const element of this.files) {    				
    				
    				if($('.carousel-inner').find('#prod_'+element.upload.uuid).length == 0){

    					if(file.upload.uuid == element.upload.uuid){
    						$('.carousel-inner').append(getItem('',file.dataURL,file.upload.uuid));	        
	      				NumberProd++;
    					}
    				}    				
				}
				
			},	
	    init: function() {        

	    		// if(this.files[1]!=null){
	        //     this.removeFile(this.files[0]);
	        // }

	        
			    this.on('maxfilesexceeded', function(file) {
			    	if($('.carousel-inner').find('#'+file.upload.uuid).length > 0){
							document.getElementById(file.upload.uuid).remove();
						}
			      this.removeFile(file);
			    });
	    		
			    // this.files.forEach(function(element){	          
	      //     this.thumbnail(element);
	      //   });	        

	        this.on("sending", function(file, xhr, formdata){
            formdata.append("ruta", $('#hdditem').val());                      
          });
	    },
	    // sending: function(file,xhr,formdata){
	    //    console.log(file);
	    //    formdata.append("ruta", $('#path').val());
	    // },
	    success: function (file, response) {
	        var imgName = response;
	        file.previewElement.classList.add("dz-success");
	        
	        console.log(response);

	        if(!response.lError){          
      		
      			Toast.fire({
						  icon: 'success',
						  title: 'Edición realizado con exito'
						})	

			      $('.carousel-inner').empty();	
			      $('.carousel-indicators').empty();		      
			      response.data.forEach((el, i) => {
			      	let avtiv = (i == 0) ? 'active' : '';
			      	let cover = (el.coverimg) ? true : false;	
			      	let path  = '../public/'+el.url_path;
			      	console.log(cover);	
			      	//function getItem(active,url,uuid = '',cover){	      	
			      	$('.carousel-inner').append(getItem(avtiv,path,el.idimgrel,cover));
			      	$('.carousel-indicators').append(getindicators(i,cover));
			      });        
			      $('[data-toggle="tooltip"]').tooltip();
			      tempThis = this;
		        setTimeout(function(){
		            tempThis.removeAllFiles(true);	            
		        }, 4000); 	        	        			      

								      
			    }
			    else{
			      
			    }	        	        
	    },
	    error: function (file, response) {
	      //file.previewElement.classList.add("dz-error");
	      //file.previewElement.classList.add("dz-error");
	      $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response);	      
	    }
	} // FIN myAwesomeDropzone

	if($('#dZUpload').length) {
	    myDropzone = new Dropzone("#dZUpload", myAwesomeDropzone); 
	}
});