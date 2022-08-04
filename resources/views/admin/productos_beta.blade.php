@extends('layouts.app')
@section('css')
	<meta name="_token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('public/fonts/fonts_roboto_varela.css') }}">
    <link rel="stylesheet" href="{{ asset('public/fonts/fonts_material.css') }}">
    <link rel="stylesheet" href="{{asset('js/dropzone_5_7_0/dist/basic.css')}}">
    <link rel="stylesheet" href="{{asset('js/dropzone_5_7_0/dist/dropzone.css')}}">
    <link rel="stylesheet" href="{{ asset('public/fonts/font_awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/responsive.bootstrap4.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('public/js/SweetAlert2/sweetalert2.min.css') }}">
	
    <link href="{{ asset('public/css/admin/catalogos.css') }}" rel="stylesheet" type="text/css" />

    
    <!-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> -->
	<!-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> -->

@endsection
@section('content')
<body>

	<!--Tab-->

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-6">
						<h2>Administrador de <b>Productos</b></h2>
					</div>
					<div class="col-6 col-md-6">
						<a href="#editCursoModal_" class="btn btn-success mb-2" data-toggle="modal" onclick="storeCurso('', 'Nuevo')"><i class="material-icons">&#xE147;</i> <span>Agregar Nuevo Productos</span></a>
                        <a href="#deleteCursoModal" class="btn btn-danger mb-2" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar seleccionados</span></a>
					</div>
                </div>
            </div>



            <div class="table-responsive p-0" id="area_table">
	            <table id="catalogo_productos" class="table align-items-center mb-0" style="width: 100%;">
				
	            </table>
        	</div>

        	<div id="gesto" style="display:none;">
        		<div class="row">   
                <div class="col-lg-12">
	                <form id="formCurso" class="form-horizontal">
	                <!-- <div class="form-horizontal"> -->
	                @csrf	                    
	                    <div class="header">Editar Producto</div>
	                    <div class="form-content">
	                    	<input type="hidden" name="modalidad" id="modalidad" class="crload">
	                    	<input type="hidden" name="hdditem" id="hdditem">
	                    	<input type="hidden" name="bstate" id="bstate">			
	                    	<div class="row">	                    		                    	
	                    		<div class="col-md-4 form-row">
	                    			<button class="btn btn-primary btn-sm" type="button" id="return_table"><i class="fa fa-arrow-left"></i> Regresar</button>	                    			
	                    		</div>  	
	                    		<div class="col-md-4 form-row"></div>								
  								<div class="col-md-4 form-row">  									
  									<button class="btn btn-primary btn-sm" type="button">Configurar Tallas</button>
  								</div>	                    		
	                    	</div>
							<br>
	                    	<div class="row" id="load">
	                    		<div class="col-lg-4 col-sm-12">

	                    			<h4 class="heading">Información</h4>
	                    			
	                    			<label class="control-label" for="nombre"><i class="fa fa-font"></i></label>
		                            <input class="form-control crload" id="nombre" name="nombre" placeholder="Nombre" type="text">		                            

		                            <label class="control-label" for="desc_prod"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></label>
		                            <textarea class="form-control crload" placeholder="Descripción" id="desc_prod" name="desc_prod"></textarea>

		                            <label class="control-label" for="precio"><i class="fa fa-usd"></i></label>
		                            <input class="form-control crload formatNumber" id="precio" name="precio" placeholder="Precio" type="text">
		                            		                           
	                    		</div>
	                    		
	                    		<div class="col-lg-4 col-sm-12">
	                    			<h4 class="heading">Stock</h4>
                    				<div class="form-row">
	                    				<div class="col-lg-4">
	                    					<label class="control-label" for="tall_xs">S</label>
	                            			<input class="form-control crload" id="tall_xs" name="tall_xs" type="text">
	                    				</div>
	                    				<div class="col-lg-4">
	                    					<label class="control-label" for="talla_md">M</label>
	                            			<input class="form-control crload" id="talla_md" name="talla_md" type="text">
	                    				</div>
	                    				<div class="col-lg-4">
	                    					<label class="control-label" for="talla_lg">L</label>
	                            			<input class="form-control crload" id="talla_lg" name="talla_lg" type="text">
	                    				</div>
                    				</div>	              																					


                    				<div class="form-row">
                    					<div class="col-12">
	                    					<label for="color_clothes" class="control-label">Color</label>
											<input type="text" name="color_clothes" id="color_clothes" class="form-control crload mt-3" required>
										</div>

										<div class="col-12">
											<label for="categoria_cloths" class="control-label">Categoría</label>
											<select class="form-control mt-4 crload" name="categoria_cloths" id="categoria_cloths">
												<option selected hidden value="">Selecciona una categoría</option>
												@foreach($datos['categorias'] as $cat)
													<option value="{{$cat->id_categoria}}">{{$cat->nombre_categoria}}</option>
												@endforeach
											</select>
										</div>

										 
      

										<div class="col-12">	
											<div id='dZUpload' class='dropzone borde-dropzone' style='cursor: pointer;'>
						                        <!-- <input type="hidden" name="path" id="path"> -->
						                        <div class='dz-default dz-message text-center'>
						                           <span><h3>Arrastra la imagen</h3></span>
						                           <br>
						                            <p>(o Clic para seleccionar)</p>
						                        </div>
						                    </div>
						                    <!-- </form> -->
										</div>

                    					<!-- <div class="col-lg-4">
	                    					<label class="control-label" for="nombre">Cotorno</label>
	                            			<input class="form-control" id="nombre" name="nombre" type="text">
	                    				</div>
	                    				<div class="col-lg-4">
	                    					<label class="control-label" for="nombre">Largo</label>
	                            			<input class="form-control" id="nombre" name="nombre" type="text">
	                    				</div>
	                    				<div class="col-lg-4">
	                    					<label class="control-label" for="nombre">Ancho</label>
	                            			<input class="form-control" id="nombre" name="nombre" type="text">
	                    				</div> -->
                    				</div>      			
	                    		</div>
	                    		
	                    		<div class="col-lg-4 col-sm-12">
	                    			<div id="MiddleCarousel" class="carousel slide UACarousel" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-target="#MiddleCarousel" data-slide-to="0" class="active"></li>
											<li data-target="#MiddleCarousel" data-slide-to="1"></li>
										</ol>
										
										<div class="carousel-inner">
											<div class="carousel-item active" id="default_item">
									  			<!-- <img class="d-block w-100" src="https://i.hizliresim.com/LDPMg0.jpg" alt="First slide"> -->
									  			<div class="product-grid3">
									                <div class="product-image3">
									                    <div>
									                        <img class="pic-1" src="https://www.w3schools.com/bootstrap4/img_avatar4.png">
									                        <!-- <img class="pic-2" src="https://www.w3schools.com/bootstrap4/img_avatar3.png"> -->
									                    </div>
									                    <ul class="social">
									                        <!-- <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li> -->
									                        <!--<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> -->
									                        <li><a data-toggle="tooltip" title="Selecciona Portada"><i class="fa fa-cog"></i></a></li>
															<li><a data-toggle="tooltip" title="Elimina Imagen"><i class="fa fa-trash" data></i></a></li>
									                    </ul>
									                    <span class="product-new-label">New</span>
									                </div>									                
									            </div>
											</div>											
										</div>
										
										<a class="carousel-control-prev" href="#MiddleCarousel" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#MiddleCarousel" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>

										

									</div>
									<!-- <div class="form-row">
										subir
									</div> -->
									<div id="circle">
										<div class="loader"></div>
									</div> 
	                    		</div>	                    		 
	                    	</div><!--Fin Row-->

	                    	<div class="row ">
	                    		<div id="circle_load" class="my-5 p-lg-3">
									<div class="loader"></div>
								</div>
	                    	</div>

	                    	<br>
	                    	<div class="row">
	                    		<!-- <div class="col-md-4 form-row">
	                    			<button class="btn btn-primary btn-sm" type="button" id="return_table"><i class="fa fa-arrow-left"></i> Regresar</button>	                    			
	                    		</div> -->  	
	                    		<!-- <div class="col-md-4 form-row"></div>								 -->
  								<div class="col-md-12 col-sm-12 d-inline form-row">  									
  									<button class="btn btn-primary mt-4" id="button">Guardar</button>
  								</div>	
	                    	</div>
	                    </div> 
	                </div>                   
	                </form>
                </div><!--FIN 6-->
            </div>	
        	</div>
        </div>
    </div>
    <!--End Tab-->
	
</body>
@endsection
@section('script')
	<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('public/js/datatable_responsive_2_2_9.js') }}"></script>
	<script src="{{ asset('public/js/responsive.bootstrap4.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/SweetAlert2/sweetalert2.all.min.js') }}"></script>
	<script src="{{asset('js/dropzone_5_7_0/dist/dropzone.js')}}"></script>
	<!-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('public/js/admin/catalogos_beta.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/admin/form.js') }}"></script>	
	
	
	<script>
		var url_global = "{{ url('') }}";
		var form = $("#formCurso");
		dataCurso();
	</script>
@endsection
