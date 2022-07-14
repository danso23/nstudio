@extends('layouts.app')

@section('content')
    <section class="description">
        @if (!empty($datos['productos']))
            <div class="container mod-producto">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row justify-content-center product">
                    <div class="col-12 col-sm-12 col-md-7 img-desc">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
                            @php $int = 0; @endphp
                            @foreach($datos['imagenes'] as $imagen => $valor)
                                @if(!empty($valor))                                                                    
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$int}}" {{($int == 0) ? "active" : ''}} ></li>
                                    @php $int++; @endphp
                                @endif
                            @endforeach                            
                        </ol>
                        <div class="carousel-inner">
                            <!-- <div class="carousel-item active">
                            <img src="{{ asset('public/img/productos') }}/{{ $datos['productos']->url_imagen }}" alt="" class="mx-auto d-block img-prod">
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('public/img/productos') }}/{{ $datos['productos']->url_imagen2 }}" alt="" class="mx-auto d-block img-prod">
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('public/img/productos') }}/{{ $datos['productos']->url_imagen3 }}" alt="" class="mx-auto d-block img-prod">
                            </div> -->
                            @php $int2 = 0; @endphp
                            @foreach($datos['imagenes'] as $imagen => $valor)
                                @if(!empty($valor))                                   
                                    <div class="carousel-item {{ ($int2 == 0) ? 'active' : '' }}">
                                        <img src="{{ asset('public') }}/{{ $valor['url_path'] }}" alt="" class="mx-auto d-block img-prod">
                                    </div>
                                    @php $int2++; @endphp
                                @endif
                            @endforeach

                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
                        
                    </div>
                    <div class="col-12 col-md-5 option-product">
                        <h4 class="txt-cafe">{{ $datos['productos']->nombre_producto }}</h4>
                        <span class="textos-small-pink">${{ $datos['productos']->precio }}</span>
                        <p class="textos-small">
                        {{$datos['productos']->desc_producto }}
                        </p>
                        <div class="row">
                         {{--<div class="col-12 col-sm-12 col-md-5">
                                <div class="form-group col-12 col-md-11 p-md-0">
                                    <select id="inputState" class="form-control textos-small">
                                        <option selected>Color</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            --}}
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group col-12 col-md-12">
                                    <select id="inputState" class="form-control textos-small">
                                        <option selected>Talla</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-add-sp btn-pink">Añadir al carrito</button>
                            <input type="hidden" name="id_producto" value="{{ $datos['productos']->id_producto }}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="container details-producto">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-3">
                        <div class="col-12 info-2 d-none d-md-block" style="background-color: #B97232 !important;">
                            <p class="textos-blancos">Envíos gratuitos en compras superiores a $999</p><br>
                            <p class="textos-blancos">Debido a las medidas actuales para proteger la seguridad de los empleados de nuestro centro de distribución con motivos del COVID-19, las entregas pueden presentar un retraso. Puedes consultar el estatus de tu pedido <a href="#" class="textos-small">aquí</a>.</p>
                        </div>
                    </div>
                    <div id="detalles" class="col-12 col-md-9 info-details">
                        <h3 class="txt-cafe-cursivas" >Guía de tallas</h3><br>
                        <table class="table">
                            <thead class="textos-cafes">
                                <tr>
                                <th scope="col"></th>
                                <th scope="col">S</th>
                                <th scope="col">M</th>
                                <th scope="col">L</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row" class="textos-cafes">Contorno busto</th>
                                <td class="textos-grises">93</td>
                                <td class="textos-grises">98</td>
                                <td class="textos-grises">103</td>
                                </tr>
                                <tr>
                                <th scope="row" class="textos-cafes">Contorno Cadera</th>
                                <td class="textos-grises">89</td>
                                <td class="textos-grises">90</td>
                                <td class="textos-grises">91</td>
                                </tr>
                                <tr>
                                <th scope="row" class="textos-cafes">Largo total</th>
                                <td class="textos-grises">30</td>
                                <td class="textos-grises">32</td>
                                <td class="textos-grises">34</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="textos-small">-Medidas mostradas en cm.</p>
                        <p class="textos-small">-Las medidas mostradas en la tabla fueron obtenidas directamente de la prenda, puede existir una variación de + - 2cm. Se recomienda dejar por lo menos 1 cm de holguera en contorno de busto.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert text-center alert-danger">
                <p>No se encontro el producto seleccionado</p>
            </div>
        @endif
    </section>
@endsection