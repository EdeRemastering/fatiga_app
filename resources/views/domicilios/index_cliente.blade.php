@extends('layouts.app')

@section('content')
    <h1>Mis Domicilios</h1>
    @foreach($domicilios as $domicilio)
        <div class="domicilio">
            <p><strong>Dirección de destino:</strong> {{ $domicilio->direccion_destino }}</p>
            <p><strong>Estado:</strong> {{ $domicilio->estado }}</p>
        </div>
    @endforeach
@endsection
