<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="husbcdco0jp887uzycozutz8axy1n3" />


    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link href="{{ asset('public/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('public/img/favicon.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="{{ asset('public/js/all.js') }}" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="{{ asset('public/css/font-family.css') }}" rel="stylesheet" /><!-- Merriweather-->
    <link href="{{ asset('public/css/font-family2.css') }}" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="{{ asset('public/css/magnific-popup.min.css') }}" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet" />
    <!-- AOS ANIMATION -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/animation_aos/aos.css') }}">
    @yield('css')
    <style>
        /*@if (Request::is('/'))
            @media only screen and (min-width: 200px) and (max-width: 359px){
                main{
                    bottom: 0 !important;
                }
            }
        @endif*/
    </style>
</head>
<body>
    <div id="app">
       <!-- HEADER -->
        <div class="col-12 text-center barra-top m-0">
            <h3 class="textos-grises">Descuentos hasta un 30% <br class="d-block d-sm-block d-md-none d-lg-none">
            <span>Consultas las bases <a href="#" class="textos-cafes">aquí</a> </span></h3>
        </div>
        <div class="col-12 container info-nav">
            <div class="col-12 mrl-q">
                <header id="site-header">
                    <!-- style="@if (Request::is('/')) padding: 0px 0px !important; @endif" -->
                    <a href="{{ asset('/')}}" class="logo">
                        <img src="{{ asset('public/img/logo.svg') }}" class="logo-black" alt="">
                        <!-- <img src="img/logo.svg" class="logo-white" alt=""> -->
                    </a>
                    <ul class="menu-right m-0">
                        <li>
                            @if (Auth::guest())
                                <a class="btn sesion" href="{{ url('/login') }}"><i class="far fa-user" aria-hidden="true"></i> </a>
                            @else
                                <a class="btn sesion" href="{{ url('/logout') }}"><i class="fa fa-user fa-1x"></i></a>
                            @endif
                        </li>
                        <li>
                            <a href="#" class="icon-search" data-toggle="modal" data-target="#exampleModal">
                                <img src="{{ asset('public/icons/busqueda.svg') }}" alt="Busqueda">
                            </a>
                        </li>
                        <li>
                            @if (count(Cart::getContent()))
                                <a href="{{ route('cart.checkout') }}" class="icon-shopping"><img src="{{ asset('public/icons/carrito.svg') }}" alt="Carrito"><span class="badge badge-danger">{{count(Cart::getContent())}}</span></a>
                            @else
                                <a href="{{ route('cart.checkout') }}" class="icon-shopping"><img src="{{ asset('public/icons/carrito.svg') }}" alt="Carrito"></a>
                            @endif
                        </li>
                        <li>
                            <button type="button" class="toggle-menu btn-primary">
                                <a href="" class="icon-shopping "><img src="{{ asset('public/icons/barras.svg') }}"></a>
                            </button>
                        </li>   
                    </ul>
                    
                    
                </header>
            </div>    
        </div>   
        @include('layouts.template_navbar_responsive')
        <!-- END HEADER -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text icon-search" id="basic-addon1"><i class="fas fa-search fa-rotate-90"></i></span>
                            </div>
                            <input type="text" class="form-control form-search" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="txtSearch">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="@if (Request::is('/')) py-0 @else py-4 @endif" data-aos="fade-in">
        <!-- style="@if (Request::is('/')) position: relative;bottom: 70px; @endif" -->
            @yield('content')
        </main>
        <!--footer-->
        <footer class="site-footer">
        <div class="container">
            <div class="row align-items-start text-center" style="justify-content:center;">
                <div class="col-lg-6 col-md-6 col-12 text-center">
                    <a href=""><img src="{{ asset('public/img/logo.svg') }}" alt="index.php" class="img-fluid" ></a>
                    <p class="textos-pagos">Boutique dedicada a la venta de ropa de mujer,  donde el diseño y la tendencia tienen un espacio. </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-start text-center">
                <div class="col text-center">
                    <a href="https://www.facebook.com/nstudioveinte.mx/"><img src="{{ asset('public/icons/iconofacebook.svg') }}" alt="index.php" class="img-icons" ></a>
                    <a href="https://instagram.com/nstudioveinte.mx?utm_medium=copy_link"><img src="{{ asset('public/icons/iconoinstagram.svg') }}" alt="index.php" class="img-icons" ></a>
                </div>
                <div class="col text-center">
                <a href=""><img src="{{ asset('public/icons/iconoxxopay.svg') }}" alt="index.php" class="img-icons" ></a>
                    <a href=""><img src="{{ asset('public/icons/iconovisa.svg') }}" alt="index.php" class="img-icons" ></a>
                    <a href=""><img src="{{ asset('public/icons/iconomastercard.svg') }}" alt="index.php" class="img-icons" ></a>
                </div><br><br><br>
            </div>
        </div>
            <div class="col-12 text-center copyright">
                <ul class="m-0">
                    <li class="textos-pagos" style="color:#938079 !important;">&copy; 2021 Desarrollo por...</li>
                    <li class="br-copy link-copy textos-pagos"><a class="textos-cafes" href="#"> &nbsp;Políticas de privacidad</a></li>
                    <li class="link-copy textos-pagos"><a class="textos-cafes" href="#">Términos y Condiciones</a></li>
                </ul>
            </div>
        </footer>
        <!--end footer-->
        <!-- Bootstrap core JS-->
        <script src="{{ asset('public/js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Third party plugin JS-->
        <script src="{{ asset('public/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.magnific-popup.min.js')}}"></script>
        <script type='text/javascript' src="{{ asset('public/js/main.js') }}"></script>
        <script src="{{ asset('public/js/wow.min.js') }}"></script>
        <!-- Core theme JS-->
        <!-- <script src="{{ asset('public/js/scripts.js') }}"></script> -->
        <!-- AOS ANIMATION -->
        <script type="text/javascript" src="{{ asset('public/animation_aos/aos.js') }}"></script>
        <!-- INIT AOS -->
        <script type="text/javascript" src="{{ asset('public/js/animation.js') }}"></script>
        @yield('script')
    </div>
    </section> 
</body>
</html>
