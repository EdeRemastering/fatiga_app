@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @foreach ($repartidores as $repartidor)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $repartidor->name }}</h5>
                        <p class="card-text">
                            Estado: 
                            <span class="badge 
                                {{ $repartidor->estado == 'Ocupado' ? 'bg-danger' : 'bg-success' }}">
                                {{ $repartidor->estado }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
        
  
@endsection
