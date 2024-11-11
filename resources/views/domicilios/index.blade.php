<!-- resources/views/domicilios/index.blade.php -->

@extends('layouts.app')

@section('content')
<h1>Domicilios</h1>

<div class="tabs">
    <button class="tab-button btn-danger mb-3" onclick="showTab('pendientes')">Pendientes</button>
    <button class="tab-button btn-danger mb-3" onclick="showTab('en-camino')">En Camino</button>
    <button class="tab-button btn-danger mb-3" onclick="showTab('entregados')">Entregados</button>
</div>


<div id="pendientes" class="tab-content" style="display: flex; gap: 2rem; flex-wrap: wrap;">
    @foreach($pendientes as $domicilio)
    <div class="card mb-3 p-3 col-md-3 mr-3">
        <h3>Domicilio #{{ $domicilio->id }}</h3>
        <p>Dirección: {{ $domicilio->direccion_destino }}</p>
        <p>Id cliente: {{ $domicilio->user_id }}</p>
        
        <form action="{{ route('domicilios.update', $domicilio->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="repartidor_id">Asignar Repartidor:</label>
            <select name="repartidor_id" id="repartidor_id" required>
                <option value="">Selecciona un repartidor</option>
                @foreach($repartidores as $repartidor)
                <option value="{{ $repartidor->id }}" {{ $domicilio->repartidor_id == $repartidor->id ? 'selected' : '' }}>
                    {{ $repartidor->name }}
                </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-danger">Guardar</button>
        </form>
    </div>
    @endforeach
</div>

<div id="en-camino" class="tab-content" style="display: none;">
    @foreach($enCamino as $domicilio)
    <div class="card mb-3 p-3 col-md-3 mr-3">
        <h3>Domicilio #{{ $domicilio->id }}</h3>
        <p>Dirección: {{ $domicilio->direccion_destino }}</p>
        <p>Cliente: {{ $domicilio->user->name }}</p>
        <p>Atendido por: {{ $domicilio->user ? $domicilio->repartidor->name : 'Sin asignar' }}</p>
    </div>
    @endforeach
</div>

<div id="entregados" class="tab-content" style="display: none;">
    @foreach($entregados as $domicilio)
    <div class="card mb-3 p-3 col-md-3 mr-3">
        <h3>Domicilio #{{ $domicilio->id }}</h3>
        <p>Dirección: {{ $domicilio->direccion_destino }}</p>
        <p>Cliente: {{ $domicilio->user->name }}</p>
        <p>Atendido por: {{ $domicilio->user ? $domicilio->repartidor->name : 'Sin asignar' }}</p>
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