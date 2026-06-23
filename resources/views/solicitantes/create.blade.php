@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Registrar Nuevo Solicitante</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('solicitantes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="documento" class="form-label">Documento de Identidad / Ficha</label>
                    <input type="text" class="form-control @error('documento') is-invalid @enderror"
                           name="documento" id="documento" value="{{ old('documento') }}" required>
                    @error('documento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                           name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror"
                           name="correo" id="correo" value="{{ old('correo') }}" required>
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Solicitante</label>
                    <select class="form-select @error('tipo') is-invalid @enderror" name="tipo" id="tipo" required>
                        <option value="" selected disabled>-- Seleccione Tipo --</option>
                        <option value="Estudiante" {{ old('tipo') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                        <option value="Docente" {{ old('tipo') == 'Docente' ? 'selected' : '' }}>Docente</option>
                    </select>
                    @error('tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('solicitantes.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Registro</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
