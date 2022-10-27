var protocol = window.location.protocol;
var _obj = [];
(function($) {
$(document).ready( function() {  

    var $window = $(window);
    var site_init = function() {
        $('.toggle-menu').on( 'click', function(e) {
            e.preventDefault();
            $(this).toggleClass('opened');
            $('body').toggleClass('menu-opened');
            $('#navigation').toggleClass('opened'); 
        });
    }

    //Buscador
    $('#txtSearch').keypress(function(e){   
        if(e.which == 13){      
            var usuario = window.document.getElementById("txtSearch").value;
            if (usuario != null)
                location.href = "buscador-productos?buscador=" + usuario ;

        }   
    });

    // Menú detalles producto
    $('.details-producto .info-details:first').show();
    $('.menu-details a:first').addClass('activo');
    $('.menu-details a:first').addClass('activo-2');

    $('.menu-details a').on('click', function() {
        $('.menu-details a').removeClass('activo');
        $(this).addClass('activo');
        $('.menu-details a').removeClass('activo-2');
        $(this).addClass('activo-2');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);

        return false;
    });

    $("input.solonumeros").bind('keypress', function(event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
          event.preventDefault();
          return false;
        }
    });
    //getAllProducts();
    cargarCategoriasSugerencias();
    new WOW().init();
    site_init();
});
})(jQuery);

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

function getAllProducts() {
    let cUrl;
    if(window.location.hostname == 'localhost')
        cUrl = protocol+'//localhost/nstudio/json/productosall';
    else
        cUrl = protocol + '//nstudioveinte.mx/json/productosall'
    fetch(cUrl,
        {method: 'GET'}
    )
    .then(res =>
        res.json())
        .then(r => {
            el = [];
            el["Producto"] = r;
            console.log(el);
    });

}

function cargarCategoriasSugerencias(){
    let cUrl;
    if(window.location.hostname == 'localhost')
        cUrl = protocol+'//localhost/nstudio/sugerencia';
    else
        cUrl = protocol + '//nstudioveinte.mx/sugerencia';
    const fetchpromise = fetch(cUrl,
        {method: 'GET'})
    .then(
        res => res.json() 
        .then(r => {
            if(!r.lError){
                let html ="";
                let cont = 0;
                r.cData.forEach(el => {
                    _obj[cont] = el;
                    cont++;
                });
                console.log(_obj);
            
            }
        })
    );
    
    
    //html+='</div>';
}

function cargarCategoria(id) {
    var html="";
    var item = _obj.filter(x => id == x.FolioCat);
    var pixels = 0;
    var mayorPixels = 0;
    if(item.length > 0){
        html+='<div class="row">';
        html+=' <div class="col-6"></div>';
        html+=' <div class="col-6 text-right">';
        html+='     <a class="btn btn-pink mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">';
        html+='         <i class="fa fa-arrow-left"></i>';
        html+='     </a>';
        html+='     <a class="btn btn-pink mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">';
        html+='         <i class="fa fa-arrow-right"></i>';
        html+='     </a>';
        html+=' </div>';
        html+=' <div class="col-12 producto">';
        html+=' <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">';
        
        html+='     <div class="carousel-inner">';
        var cont_card = 1;
        item.forEach(element => {
            if(cont_card <= 3){
                if(cont_card == 1){
                    html+=' <div class="carousel-item active">';
                    html+='     <div class="row">';
                }
                    html+='         <div class="col-md-4 mb-3">';
                    html+='             <div class="card card-product card-resize-h">';
                    html+='                 <img alt="No disponible" src="'+url_global+'/public'+element.PathImg+'" alt="" class="isImg 2-100 resize mt-3" width="100%">';
                    html+='                 <div class="card-body">';
                    html+='                     <h4 class="card-title txt-cafe">'+element.NombreProd +'</h4>';
                    html+='                     <p class="textos-small-pink">$0.00</p>';
                    html+='                     <a type="button" class="btn btn-pink btn-add-sp" href="'+url_global+'/productos/detalle/'+element.FolioProd+'">Ver producto</a>';
                    html+='                     <input type="hidden" name="id_producto" value="'+element.FolioProd+'">';
                    html+='                  </div>';
                    html+='             </div>';
                    html+='          </div>';
                if(cont_card == 3){
                    html+='     </div>';
                    html+=' </div>';
                    // cont_card=0;
                }
            }
            if(cont_card > 3){
                if(cont_card == 4){
                    html+=' <div class="carousel-item">';
                    html+='     <div class="row">';
                }
                
                html+='         <div class="col-md-4 mb-3">';
                html+='             <div class="card card-product card-resize-h">';
                html+='                 <img alt="No disponible" src="'+url_global+'/public'+element.PathImg+'" alt="" class="isImg 2-100 resize mt-3" width="100%">';
                html+='                 <div class="card-body">';
                html+='                     <h4 class="card-title txt-cafe">'+element.NombreProd +'</h4>';
                html+='                     <p class="textos-small-pink">$0.00</p>';
                html+='                     <a type="button" class="btn btn-pink btn-add-sp" href="'+url_global+'/productos/detalle/'+element.FolioProd+'">Ver producto</a>';
                html+='                     <input type="hidden" name="id_producto" value="'+element.FolioProd+'">';
                html+='                  </div>';
                html+='             </div>';
                html+='          </div>';
                if((cont_card - 1) == item.length){
                    html+='     </div>';
                    html+=' </div>';
                }
            }
            cont_card++;
        });
        
        html+='</div>';
        html+=' </div>';
        html+=' </div>';
        html+='</div>';//row
    }
    else{
        html+='<div style="display:block" class="alert alert-warning">Esta categoría por el momento no contiene productos</div>';
    }
    $("#div_Productos").html(html);
    if($(".producto").length > 0){
        $(".card-product").each(function(index, val) {
            pixels = $(this).innerHeight();
            if(pixels > mayorPixels ){
                mayorPixels = pixels;
            }
        });
        if(mayorPixels > 0){
            $(".card-resize-h").css("height", mayorPixels);
        }
    }
}



/* ERORRS AJAX
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
*/