@extends('layouts.app')

@section('content')
    <section class="ticket">
        <div class="container">
            @if($datos['success'])
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $datos['success'] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="card border-light mb-3 col-10">
                    <div class="card-header font-weight-bold badge-secondary">Compra N° {{ $datos['id_compra'] }} </div>
                    <div class="card-body">
                        <h5>{{$datos['cliente']}}</h5>
                        <table class="table table-stripped table-responsive-sm" style="width: 100%;">
                            <thead>
                                <tr><th>Producto </th>    
                                    <th>Cantidad</th>    
                                    <th>Precio unitario</th>    
                                    <th>Total</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datos['productos'] as $producto)
                                    <tr>
                                        <td>{{ $producto->name }}</td>
                                        <td>{{ $producto->quantity }}</td>
                                        <td>{{ $producto->price }}</td>
                                        <td>{{ $producto->price * $producto->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h5 class="card-title">Dirección</h5>
                        <p class="card-text">{{ $datos['direccion'] }} {{ $datos['estado']}} , {{ $datos['pais'] }}. CP {{ $datos['cp']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection