@extends('layouts.app')
@section('css')
	<meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('public/fonts/fonts_roboto_varela.css') }}">
    <link rel="stylesheet" href="{{ asset('public/fonts/fonts_material.css') }}">
    <link rel="stylesheet" href="{{ asset('public/fonts/font_awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/js/SweetAlert2/sweetalert2.min.css') }}">
	
    <link href="{{ asset('public/css/admin/catalogos.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<body>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-6">
						<h2>Administrador de <b>Productos</b></h2>
					</div>
					<div class="col-6 col-md-6">
						<a href="#editCursoModal" class="btn btn-success mb-2" data-toggle="modal" onclick="storeCurso('', 'Nuevo')"><i class="material-icons">&#xE147;</i> <span>Agregar Nuevo Productos</span></a>
                        <a href="#deleteCursoModal" class="btn btn-danger mb-2" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar seleccionados</span></a>
					</div>
                </div>
            </div>
            <table id="catalogoCursos" class="table table-striped table-hover table-responsive">
			
            </table>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="editCursoModal" class="modal fade" tabindex="-1" data-backdrop="false" data-dismiss="modal" style="overflow-y: scroll; position: absolute;">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="formCurso">
					@csrf
					<div class="modal-header">
						<h4 class="modal-title" id="modal-title-curso">Editar Productos</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

						<!-- <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a> -->

						<!-- <nav>
							<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Galería</a>
								<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Tallas</a>
								
							</div>
						</nav> -->

						<!-- <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent"> -->
							<!-- <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> -->
								<input type="hidden" name="hddIdCurso" id="hddIdCurso">			
								<div class="form-group">
									<label for="nombre" class="textos-cafes">Nombre</label>
									<input type="text" name="nombre" id="nombre" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="desc_curso" class="textos-cafes">Descripción</label>
									<textarea name="desc_curso" id="desc_curso" class="form-control" required></textarea>
								</div>	

								<div class="form-group">
									<label for="precio" class="textos-cafes">Precio</label>
									<input type="text" name="precio" id="precio" class="form-control" required>
								</div>						
							<!-- </div> -->

							<!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> -->
								<!-- Inicio -->
								<!-- <div class="container-fluid">
									<div id="carouselExample" class="carouselPrograms carousel slide" data-ride="carousel" data-interval="false">
								        <div class="carousel-inner row w-100 mx-auto" role="listbox">
								            <div class="carousel-item col active">
								               <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 1" class="thumb">
								                      <img class="img-fluid mx-auto d-block" src="https://www.hola.com/imagenes/moda/20200326164119/blusas-estilos-primavera-verano/0-803-630/blusa-miss-selfridges-asos-a.jpg" alt="slide 1">
								                    </a>
								                  </div>
								                </div>
								            </div>
								            <div class="carousel-item col ">
								               <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 3" class="thumb">
								                     <img class="img-fluid mx-auto d-block" src="https://dsnegsjxz63ti.cloudfront.net/images/pg/m_326067db6c8d719.jpg" alt="slide 2">
								                    </a>
								                  </div>
								                </div>
								            </div>
								            <div class="carousel-item col ">
								               <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 4" class="thumb">
								                     <img class="img-fluid mx-auto d-block" src="https://dsnegsjxz63ti.cloudfront.net/images/pg/m_325fa88f014b9c0.jpg" alt="slide 3">
								                    </a>
								                  </div>
								                </div>
								            </div>
								            <div class="carousel-item col ">
								                <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 5" class="thumb">
								                     <img class="img-fluid mx-auto d-block" src="//via.placeholder.com/600x400?text=4" alt="slide 4">
								                    </a>
								                  </div>
								                </div>
								            </div>
								            <div class="carousel-item col ">
								              <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 6" class="thumb">
								                      <img class="img-fluid mx-auto d-block" src="//via.placeholder.com/600x400?text=5" alt="slide 5">
								                    </a>
								                  </div>
								                </div>
								            </div>
								            <div class="carousel-item col ">
								               <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 7" class="thumb">
								                      <img class="img-fluid mx-auto d-block" src="//via.placeholder.com/600x400?text=6" alt="slide 6">
								                    </a>
								                  </div>
								                </div>
								            </div>
								            <div class="carousel-item col ">
								               <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 8" class="thumb">
								                      <img class="img-fluid mx-auto d-block" src="//via.placeholder.com/600x400?text=7" alt="slide 7">
								                    </a>
								                  </div>
								                </div>
								            </div>
								             <div class="carousel-item col  ">
								                <div class="panel panel-default">
								                  <div class="panel-thumbnail">
								                    <a href="#" title="image 2" class="thumb">
								                     <img class="img-fluid mx-auto d-block" src="//via.placeholder.com/600x400?text=8" alt="slide 8">
								                    </a>
								                  </div>
								                  
								                </div>
								            </div>
								        </div>
								        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
								            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
								            <span class="sr-only">Previous</span>
								        </a>
								        <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
								            <span class="carousel-control-next-icon" aria-hidden="true"></span>
								            <span class="sr-only">Next</span>
								        </a>
								    </div>
								</div> -->

								<!-- Fin -->
								<br><br>
								<div class="form-group">
									<label for="portada" class="textos-cafes">Imagen principal</label>
									<input type="file" class="form-control custom-input" placeholder="Portada" name="portada" id="portada" onchange="uploadFile(this, 'portadaFile', 'C')">
									<input type="hidden" name="portadaFile" id="portadaFile">
								</div>
								<div class="form-group">
									<label for="portada2" class="textos-cafes">Imagen 2</label>
									<input type="file" class="form-control custom-input" placeholder="Portada" name="portada2" id="portada2" onchange="uploadFile(this, 'portadaFile2', 'C')">
									<input type="hidden" name="portadaFile2" id="portadaFile2">
								</div>
								<div class="form-group">
									<label for="portada3" class="textos-cafes">Imagen 3</label>
									<input type="file" class="form-control custom-input" placeholder="Portada" name="portada3" id="portada3" onchange="uploadFile(this, 'portadaFile3', 'C')">
									<input type="hidden" name="portadaFile3" id="portadaFile3">
								</div>
								<div class="form-group">
									<label for="portada4" class="textos-cafes">Imagen 4</label>
									<input type="file" class="form-control custom-input" placeholder="Portada" name="portada4" id="portada4" onchange="uploadFile(this,'portadaFile4', 'C')">
									<input type="hidden" name="portadaFile4" id="portadaFile4">
								</div>
								<div class="form-group">
									<label for="portada5" class="textos-cafes">Imagen 5</label>
									<input type="file" class="form-control custom-input" placeholder="Portada" name="portada5" id="portada5" onchange="uploadFile(this,'portadaFile5', 'C')">
									<input type="hidden" name="portadaFile5" id="portadaFile5">
								</div>
								<div class="form-group">
									<label for="portada6" class="textos-cafes">Imagen 6</label>
									<input type="file" class="form-control custom-input" placeholder="Portada" name="portada6" id="portada6" onchange="uploadFile(this,'portadaFile6', 'C')">
									<input type="hidden" name="portadaFile6" id="portadaFile6">
								</div>
							<!-- </div> -->

							<!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"> -->
								<div class="form-group">
									<label for="categoria" class="textos-cafes"><b>Cantidad de piezas por talla</b></label><br>
									<table class="table">
		                            <thead class="textos-cafes">
		                                <tr>
		                                <th scope="col" style="width: 30%">S</th>
		                                <th scope="col" style="width: 30%">M</th>
		                                <th scope="col" style="width: 30%">L</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <tr>
		                                <td class="textos-grises"><input type="text" name="cantidad_s" id="cantidad_s" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="cantidad_m" id="cantidad_m" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="cantidad_g" id="cantidad_g" class="form-control" required></td>
		                                </tr>
		                            </tbody>
		                        </table>
								</div>
								<label for="categoria" class="textos-cafes"><b>Guía de tallas</b></label><br>
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
		                                <td class="textos-grises"><input type="text" name="busto_s" id="busto_s" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="busto_m" id="busto_m" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="busto_g" id="busto_g" class="form-control" required></td>
		                                </tr>
		                                <tr>
		                                <th scope="row" class="textos-cafes">Contorno cadera</th>
		                                <td class="textos-grises"><input type="text" name="largo_s" id="largo_s" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="largo_m" id="largo_m" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="largo_g" id="largo_g" class="form-control" required></td>
		                                </tr>
		                                <tr>
		                                <th scope="row" class="textos-cafes">Largo total</th>
		                                <td class="textos-grises"><input type="text" name="manga_s" id="manga_s" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="manga_m" id="manga_m" class="form-control" required></td>
		                                <td class="textos-grises"><input type="text" name="manga_g" id="manga_g" class="form-control" required></td>
		                                </tr>
		                            </tbody>
		                        </table>
								<div class="form-group">
									<label for="color" class="textos-cafes">Color</label>
									<input type="text" name="color" id="color" class="form-control textos-small" required>
								</div>
								<div class="form-group">
									<label for="categoria" class="textos-cafes">Categoría</label>
									<select class="form-control" name="categoria" id="categoria">
										<option selected hidden value="default">Selecciona una categoría</option>
										@foreach($datos['categorias'] as $cat)
											<option value="{{$cat->id_categoria}}">{{$cat->nombre_categoria}}</option>
										@endforeach
									</select>
								</div>
						<!-- 	</div>
						</div>	 -->																							
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" id="btnCancelarCurso" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-info" id="btnGuardarCurso" value="Guardar">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteCursoModal" class="modal fade" data-backdrop="false" data-dismiss="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Eliminar Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" onclick="deletCurso('','Eliminar')" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
@endsection
@section('script')
	<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/js/dataTables.bootstrap4.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/SweetAlert2/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/catalogos.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/admin/form.js') }}"></script>	
	<script>
		var url_global = "{{ url('') }}";
		var form = $("#formCurso");
		dataCurso();
	</script>
@endsection
