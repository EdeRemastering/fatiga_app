@extends('layouts.app')

@section('content')
<h1>Mis Domicilios</h1>

<div class="tabs">
    <button class="tab-button btn-danger mb-3" onclick="showTab('pendientes')">Pendientes</button>
    <button class="tab-button btn-danger mb-3" onclick="showTab('entregados')">Entregados</button>
</div>

<!-- Domicilios Pendientes -->
<div id="pendientes" class="tab-content" style="display: block; gap: 2rem; flex-wrap: wrap;">
    @foreach($pendientes as $domicilio)
        <div class="card mb-3 p-3 col-md-3 mr-3">
            <h3>Domicilio #{{ $domicilio->id }}</h3>
            <p>Dirección: {{ $domicilio->direccion_destino }}</p>
            <p>Cliente: {{ $domicilio->user->name }}</p>

            <form action="{{ route('domicilios.marcarEntregado', $domicilio->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Marcar como Entregado</button>
            </form>
        </div>
    @endforeach
</div>

<!-- Domicilios Entregados -->
<div id="entregados" class="tab-content" style="display: none;">
    @foreach($entregados as $domicilio)
        <div class="card mb-3 p-3 col-md-3 mr-3">
            <h3>Domicilio #{{ $domicilio->id }}</h3>
            <p>Dirección: {{ $domicilio->direccion_destino }}</p>
            <p>Cliente: {{ $domicilio->user->name }}</p>
            <p>Estado: {{ $domicilio->estado }}</p>
        </div>
    @endforeach
</div>

<script>
    function showTab(tabName) {
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.style.display = 'none');
        document.getElementById(tabName).style.display = 'block';
    }
</script>
@endsection
