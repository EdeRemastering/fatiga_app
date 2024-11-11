@extends('layouts.app')

@section('content')
    <h1>Mis Domicilios</h1>

    <div class="row">
        @foreach($domicilios as $domicilio)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Domicilio</h5>
                        <p class="card-text"><strong>Dirección de destino:</strong> {{ $domicilio->direccion_destino }}</p>
                        <p class="card-text"><strong>Estado:</strong> {{ $domicilio->estado }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        Fecha de creación: {{ $domicilio->created_at->format('d-m-Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
