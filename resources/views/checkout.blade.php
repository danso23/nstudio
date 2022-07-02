@extends('layouts.app')

@section('content')
    @if (count(Cart::getContent()))
        <section>
            <div class="container">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <th class="textos-cafes">ID</th>
                                <th class="textos-cafes">Nombre</th>
                                <th class="textos-cafes">Precio</th>
                                <th class="textos-cafes">Cantidad</th>
                                <th class="textos-cafes">Total</th>
                                <th class="textos-cafes"></th>
                            </thead>
                            <tbody>
                                @foreach(Cart::getContent() as $item)
                                    <tr style="background-color: #EFEAE7;">
                                        <td class="textos-cafes">{{ $item->id }}</td>
                                        <td class="textos-cafes">{{ $item->name }}</td>
                                        <td class="textos-cafes">{{ $item->price }}</td>
                                        <td class="textos-cafes">{{ $item->quantity }}</td>
                                        <td class="textos-cafes">${{ $item->price * $item->quantity }}</td>
                                        <td class="textos-cafes">
                                            <form action="{{ route('cart.remove') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_producto" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-link btn-sm text-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('guarda.envio') }}" method="post" class="col-12 col-md-4">
                        @csrf
                        <div class="card">
                            <div class="card-body card-body-custom"  style="font-family:Montserrat, sans-serif; background-color: #EFEAE7;">
                                <h5 class="card-title text-danger textos-cafes">TOTAL A PAGAR</h5>
                                <p class="card-text textos-grises"><b>Subtotal:</b></p>
                                <p class="card-text textos-cafes">${{ Cart::getSubTotal() }}</p>
                                    <div class="form-group">
                                        <label for="Pais" class="textos-grises">País:</label>
                                        <select class="form-control" id="Pais" name="pais">
                                        <option value="MX" selected>México</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Estado" class="textos-grises">Estado:</label>
                                            <select class="form-control" id="Estado" name="estado" required>
                                            <option hidden value="">Seleccione una opción...</option>
                                            <option value="Aguascalientes">Aguascalientes</option>
                                            <option value="Baja California">Baja California</option>
                                            <option value="Baja California Sur">Baja California Sur</option>
                                            <option value="Campeche">Campeche</option>
                                            <option value="Chiapas">Chiapas</option>
                                            <option value="Chihuahua">Chihuahua</option>
                                            <option value="CDMX">Ciudad de México</option>
                                            <option value="Coahuila">Coahuila</option>
                                            <option value="Colima">Colima</option>
                                            <option value="Durango">Durango</option>
                                            <option value="Estado de México">Estado de México</option>
                                            <option value="Guanajuato">Guanajuato</option>
                                            <option value="Guerrero">Guerrero</option>
                                            <option value="Hidalgo">Hidalgo</option>
                                            <option value="Jalisco">Jalisco</option>
                                            <option value="Michoacán">Michoacán</option>
                                            <option value="Morelos">Morelos</option>
                                            <option value="Nayarit">Nayarit</option>
                                            <option value="Nuevo León">Nuevo León</option>
                                            <option value="Oaxaca">Oaxaca</option>
                                            <option value="Puebla">Puebla</option>
                                            <option value="Querétaro">Querétaro</option>
                                            <option value="Quintana Roo">Quintana Roo</option>
                                            <option value="San Luis Potosí">San Luis Potosí</option>
                                            <option value="Sinaloa">Sinaloa</option>
                                            <option value="Sonora">Sonora</option>
                                            <option value="Tabasco">Tabasco</option>
                                            <option value="Tamaulipas">Tamaulipas</option>
                                            <option value="Tlaxcala">Tlaxcala</option>
                                            <option value="Veracruz">Veracruz</option>
                                            <option value="Yucatán">Yucatán</option>
                                            <option value="Zacatecas">Zacatecas</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Direccion" class="textos-grises">Dirección:</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle, Número, Cruzamientos, Fracc." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="CP" class="textos-grises">Código postal:</label>
                                        <input type="text" class="form-control solonumeros" id="codigoPostal" name="codigoPostal" placeholder="C.P." maxlength="5" required>
                                    </div>
                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-cafe">Finalizar compra</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @else
        <section>
            <div class="container">
            <div class="alert-carrito alert-danger mb-5 mt-5" role="alert">
                <h3 class="alert-heading">¡Ups! Parece que aun no has agregado productos a tu carrito</h3>
                <p><a href="{{url('/')}}" class="btn btn-danger">Regresar a inicio</a></p>
                <p class="mb-0">Una vez que hayas agregado un producto a tu carrito podrás continuar con el proceso de compra.</p>
                </div>
            </div>
        </section>
    @endif
@endsection