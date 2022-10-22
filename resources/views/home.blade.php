@extends('layouts.app')

@section('css')
	<meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!--start content-->
    <section class="hero" id="div-principal">
        
            <div id="home" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    @foreach($datos['carrusel'] as $caru)
                        <li data-target="#home" data-slide-to="{{$caru->id_carrusel}}"></li>
                    @endforeach
                </ul>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    @foreach($datos['carrusel'] as $caru)
                        <div class="carousel-item @if($caru->id_carrusel == 1) active @endif">
                            <img src="{{asset('public/carrusel')}}/{{$caru->url}}" alt="{{$caru->descripcion}}" style="width:100%">
                        </div>
                    @endforeach
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#home" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#home" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <!-- <div class="row align-items-start text-center" style="justify-content:center;">
                <div class="col-4 text-center" id="texto-principal">
                    <p id="cafes-principal">Nueva colección<p class="txt-cafe-cursivas" id="texto-exclusiva">exclusiva</p></p>
                    <button type="" class="btn btn-pink btn-add-sp" id="btn-principal">IR A TIENDA</button>
                </div>
            </div> -->
        
    </section>
    <section class="">
        <div class="col-12 text-center mt-0">
            @foreach($datos['categorias'] as $cat)
                <div class="d-inline">
                    <a data-categoria="{{$cat->id_categoria}}" onclick="cargarCategoria({{$cat->id_categoria}});" class="a-menu i-categoria" style="padding: 5px;">
                    <!-- <img class="img-fluid img-icons" src="{{ asset('/public/img/categorias/') }}/{{ $cat->icono }}">--><span class="textos-cafes" style="font-family: Playfair Display !important; font-size: 22px;">{{ $cat->nombre_categoria }}</span></a>
                </div>
            @endforeach
        </div>
    </section>
    <!--start content -->
    <section class="section-productos">
        <div class="container">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="container contaner-productos">
                <div class="row justify-content-center" id="div_Productos">
                
                </div>
            </div>
        </div>
    </section>
    <section class="">
        <div class="container mt-4">
            <div class="row align-items-start text-center" style="justify-content:center;">
                <div class="col-lg-6 col-s-6">
                    <p class="text-left txt-cafe-cursivas">Más vendidos</p>
                </div>
                <div class="col-lg-6 col-s-6 text-right" id="divTienda">
                    <a id="divTienda" class="btn btn-pink" href="{{ url('/categoria/1') }}">IR A TIENDA</a>
                </div>
            </div>
        </div>
    </section>
    <section class="hero">
        <div class="container ">
            <div class="row align-items-start text-center" style="justify-content:center;">
                <div class="col-lg-6 col-s-12">
                    <div class="col-s-12 vendido01" style="text-align: left;float: left;width: 100%;">
                        <div style="background-color:#E6C8BD; width: 40%; height:300px; padding-top:100px;float:right">
                        <p class="txt-cafe" style="text-align: left; padding-left:8px">Jumper Naranja</p>
                        <p class="p-3 text-light text-right texto-precio">$699</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-s-12 text-center">
                    <img src="{{ asset('public/img/productos/image00002.jpeg') }}" alt="index.php" width="100%">
                    <p class="txt-cafe text-left">Vestido Halter<span class="text-pink texto-precio ">$899</span></p>
                </div>
                <div class="col-lg-3 col-s-12 text-center">
                    <img src="{{ asset('public/img/productos/vendido01.jpeg') }}" alt="index.php" width="100%">
                    <p class="txt-cafe" style="text-align: left;">Sombreros de playa<span class="text-pink texto-precio">$499</span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="hero">
        <div class="container">
            <div class="row align-items-start text-center" style="justify-content:center;">
                <div class="col-lg-5 col-s-12">
                    <p class="txt-cafe-cursivas" style="text-align: left;">La historia</p>
                    <p class="textos-small" style="text-align: left;">Nstudioveinte.mx nace del sueño de Nicole Pichardo, una joven yucateca. El proyecto da inicio de la mano de su novio Octavio García quien juntos complementaron las ideas para poder tener un espacio acogedor en cada una de las visitas de sus clientas. La primera boutique abre sus puertas el 9 de marzo del 2019.<br><br>
                        Nuestro propósito es muy claro, brindar la mejor calidad al mejor precio, representando exclusividad e innovación en cada una de las prendas. <br><br>
                        Nosotros buscamos acercarnos a las mejores propuestas de moda, además de transmitir nuestra dedicación y nuestro cuidado por los detalles. Ofrecemos una forma diferente de combinar todas las prendas de nuestras colecciones. 
                        </p>
                    
                </div>
                <div class="col-lg-7 col-s-12 text-center">
                    <img src="{{ asset('public/img/historiaNs.jpeg') }}" alt="index.php" width="40%">
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-start text-center" style="justify-content:center;">
                <div class="col-lg-4 col-s-12">
                    <p class="txt-cafe-cursivas" style="text-align: right;">Visión</p>
                    <p class="textos-small" style="text-align: right;">Nuestra visión es ofrecerle a las mujeres productos de calidad, con precios accesibles y en tendencia. Procurando siempre la comodidad y estilos en cada una de nuestras prendas y accesorios con los mejores diseños representativos de la marca.</p>
                </div>
                <div class="col-lg-4 col-s-12 text-center" id="img-vision">
                    <img src="{{ asset('public/img/image00009.jpeg') }}" alt="index.php" style="width:65%;" >
                </div>
                <div class="col-lg-4">
                    <p class="txt-cafe-cursivas" style="text-align: left;">Misión</p>
                    <p class="textos-small" style="text-align: left;">Posicionarnos en el mercado Yucateco como una marca líder a nivel local y nacional con el fin de ofrecer prendas a la vanguardia con la mejor calidad y a los mejores precios.</p>
                </div>
            </div>
        </div>
    </section>
       
@endsection
@section('script')
<script>
	var url_global = "{{ url('') }}";
</script>
@endsection