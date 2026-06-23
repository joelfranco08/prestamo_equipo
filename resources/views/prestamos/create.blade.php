@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">📋 Registrar Nuevo Préstamo de Equipo</h5>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="equipo_id" class="form-label fw-bold">Seleccionar Equipo Disponible</label>
                    <select class="form-select @error('equipo_id') is-invalid @enderror" name="equipo_id" id="equipo_id" required>
                        <option value="" selected disabled>-- Seleccione un Equipo --</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                [{{ $equipo->codigo }}] - {{ $equipo->nombre }} ({{ $equipo->marca }})
                            </option>
                        @endforeach
                    </select>
                    @error('equipo_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="solicitante_id" class="form-label fw-bold">Seleccionar Solicitante (Aprendiz / Docente)</label>
                    <select class="form-select @error('solicitante_id') is-invalid @enderror" name="solicitante_id" id="solicitante_id" required>
                        <option value="" selected disabled>-- Seleccione el Solicitante --</option>
                        @foreach($solicitantes as $solicitante)
                            <option value="{{ $solicitante->id }}" {{ old('solicitante_id') == $solicitante->id ? 'selected' : '' }}>
                                {{ $solicitante->nombre }} ({{ $solicitante->tipo }} - {{ $solicitante->documento }})
                            </option>
                        @endforeach
                    </select>
                    @error('solicitante_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_prestamo" class="form-label fw-bold">Fecha de Préstamo</label>
                        <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror"
                               name="fecha_prestamo" id="fecha_prestamo"
                               value="{{ old('fecha_prestamo', date('Y-m-d')) }}" required>
                        @error('fecha_prestamo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_dev_esperada" class="form-label fw-bold">Fecha Devolución Esperada</label>
                        <input type="date" class="form-control @error('fecha_dev_esperada') is-invalid @enderror"
                               name="fecha_dev_esperada" id="fecha_dev_esperada"
                               value="{{ old('fecha_dev_esperada') }}" required>
                        @error('fecha_dev_esperada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="observaciones_entrega" class="form-label fw-bold">Observaciones de Entrega (Opcional)</label>
                    <textarea class="form-control @error('observaciones_entrega') is-invalid @enderror"
                              name="observaciones_entrega" id="observaciones_entrega" rows="3"
                              placeholder="Ej. Se entrega con su cargador, mouse y estuche original...">{{ old('observaciones_entrega') }}</textarea>
                    @error('observaciones_entrega')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Confirmar Préstamo e Iniciar Flujo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
