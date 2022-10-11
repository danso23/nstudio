@extends('layouts.app')

@section('content')
    <!--start content-->
    <section class="productos">
        <div class="container">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row justify-content-center mrl-q">
                @if(isset($datos['productos']))
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 p-0">
                        <div class="container">
                            <div class="row justify-content-center">
                                @foreach ($datos['productos'] as $producto)
                                    <div class="col-9 col-sm-4 col-md-4 col-lg-4 producto">
                                        <img src="{{ asset('public')}}/{{ $producto->path_cover }}" alt="" class="2-100" width="100%">
                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-pink btn-add-sp">Añadir al carrito</button>
                                            <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                                        </form>
                                        <h5 class="txt-cafe"><a class="txt-cafe" href="{{ url('productos/detalle') }}/{{ $producto->id_producto }}">{{ $producto->nombre_producto }}</a></h5>
                                        <span class="textos-small">$ {{ $producto->precio }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row pag-pro justify-content-center">                                                                
                                @if ($datos['productos']->lastPage() > 1)                                
                                    <div class="col-10 col-sm-3 text-center text-sm-left pag-prev">
                                        @if(($datos['productos']->currentPage() != 1))
                                            <a href="{{ $datos['productos']->url($datos['productos']->currentPage()-1) }}" class="textos-small">Anterior</a>
                                        @endif
                                    </div>
                                    
                                    <div class="col-10 col-sm-6 text-center pro-pagination">
                                        <div class="col-12 text-center">
                                            <ul class="m-0">


                                                <li class="textos-cafes">Página</li>
                                                <li class="{{ ($datos['productos']->currentPage()) ? ' active' : '' }} textos-cafes">
                                                    <a href="{{  $datos['productos']->url($datos['productos']->currentPage() )}}">{{ $datos['productos']->currentPage() }}</a>
                                                </li>
                                                <li class="textos-cafes">de</li>
                                                <li class="{{ ($datos['productos']->lastPage()) ? ' active' : '' }} textos-cafes">
                                                    <a href="{{ $datos['productos']->url($datos['productos']->lastPage()) }}">{{ $datos['productos']->lastPage() }}</a>
                                                </li>                                            
                                            </ul>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="col-10 col-sm-3 text-center text-sm-right pag-next" >
                                        @if($datos['productos']->currentPage() != $datos['productos']->lastPage())
                                            <a class="textos-small" href="{{ $datos['productos']->url($datos['productos']->currentPage()+1) }}" >Siguiente</a>
                                        @endif
                                    </div>                                                                    
                                @endif                                                                                   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 info text-left d-block d-sm-block d-md-none">
                        <p>Envíos gratuitos en compras superiores a $999</p>
                        <p class="m-0">Debido a las medidas actuales para proteger la seguridad de los empleados de nuestro centro de distribución con motivos del COVID-19, las entregas pueden presentar un retraso. Puedes consultar el estatus de tu pedido <a href="#">aquí</a>.</p>
                    </div>
                @endif
                @if(isset($datos['buscador']))
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 p-0">
                        <!-- AQUI PONES LO QUE VENGA DE TU BUSCADOR -->
                        @foreach ($datos['buscador'] as $producto)
                            <div class="col-9 col-sm-4 col-md-4 col-lg-4 producto">
                                <img src="{{ asset('public/img/productos')}}/{{ $producto->url_imagen }}" alt="" class="2-100" width="100%">
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-pink btn-add-sp">Añadir al carrito</button>
                                    <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                                </form>
                                <h5><a href="{{ url('productos/detalle') }}/{{ $producto->id_producto }}">{{ $producto->nombre_producto }}</a></h5>
                                <span>$ {{ $producto->precio }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection