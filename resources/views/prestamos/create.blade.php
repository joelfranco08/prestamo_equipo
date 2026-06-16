@extends('layouts.app')

@section('content')
<div class="card shadow-sm max-width-600 mx-auto">
    <div class="card-header bg-primary text-white"><h5>Registrar Nuevo Préstamo</h5></div>
    <div class="card-body">
        <form action="{{ route('prestamos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Equipo de Tecnología</label>
                <select name="equipo_id" class="form-select @error('equipo_id') is-invalid @enderror">
                    <option value="">-- Seleccionar Equipo Disponible --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }} ({{ $equipo->codigo }})</option>
                    @endforeach
                </select>
                @error('equipo_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Solicitante</label>
                <select name="solicitante_id" class="form-select @error('solicitante_id') is-invalid @enderror">
                    <option value="">-- Seleccionar Solicitante --</option>
                    @foreach($solicitantes as $solicitante)
                        <option value="{{ $solicitante->id }}">{{ $solicitante->nombre }} [{{ $solicitante->tipo }}]</option>
                    @endforeach
                </select>
                @error('solicitante_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha de Salida</label>
                    <input type="date" name="fecha_prestamo" value="{{ date('Y-m-d') }}" class="form-control @error('fecha_prestamo') is-invalid @enderror">
                    @error('fecha_prestamo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha Esperada Retorno</label>
                    <input type="date" name="fecha_devolucion_esperada" class="form-control @error('fecha_devolucion_esperada') is-invalid @enderror">
                    @error('fecha_devolucion_esperada') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Condiciones de Entrega</label>
                <textarea name="observaciones_entrega" rows="2" class="form-control" placeholder="Ej. Incluye cargador original y estuche..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Confirmar Préstamo e Iniciar Flujo</button>
        </form>
    </div>
</div>
@endsection
