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
    getAllProducts();
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
    fetch('https://nstudioveinte.mx/json/productosall',
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

function cargarCategoria(id) {
    var html="";
    $.ajax({
		type: "GET",
    	dataType: "json",
    	url: url_global+"/jsoncategoria/"+id,		
		success: function(data){
            data.forEach(element => {                            
                html+='<div class="col-10 col-sm-9 col-md-2 col-lg-2 producto">';
                html+='<img src="'+url_global+'/public/img/productos/'+element.url_imagen+'" alt="" class="2-100" width="100%"></img>';
                html+='<form action="'+url_global+'/cart-add" method="post">';
                html+='<input type="hidden" name="_token" value="'+document.querySelector('meta[name="_token"]').getAttribute('content')+'">';
                html+='<button type="submit" class="btn btn-pink btn-add-sp">Añadir al carrito</button>';
                html+='<input type="hidden" name="id_producto" value="'+element.id_producto+'">';           
                html+='</form>';
                
                html+='</div>';
            });
            $("#div_Productos").html(html);
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