@extends('layouts.app')

@section('content')
<div class="row text-center">
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <h3>{{ $disponibles }}</h3>
                <p class="mb-0">Equipos Disponibles</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark shadow-sm">
            <div class="card-body">
                <h3>{{ $prestados }}</h3>
                <p class="mb-0">Equipos Prestados</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white shadow-sm">
            <div class="card-body">
                <h3>{{ $totalPrestamos }}</h3>
                <p class="mb-0">Total Préstamos</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white shadow-sm">
            <div class="card-body">
                <h3>{{ $vencidos }}</h3>
                <p class="mb-0">Préstamos Vencidos 🔥</p>
            </div>
        </div>
    </div>
</div>
@endsection
