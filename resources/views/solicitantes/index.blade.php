@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Administración de Solicitantes</h2>
        <a href="{{ route('solicitantes.create') }}" class="btn btn-primary">Registrar Solicitante</a>
    </div>

    <form action="{{ route('solicitantes.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o documento..." value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Documento</th>
                        <th>Nombre Completo</th>
                        <th>Correo Electrónico</th>
                        <th>Tipo</th>
                        <th>Fecha Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($solicitantes as $solicitante)
                        <tr>
                            <td><strong>{{ $solicitante->documento }}</strong></td>
                            <td>{{ $solicitante->nombre }}</td>
                            <td>{{ $solicitante->correo }}</td>
                            <td>
                                <span class="badge {{ $solicitante->tipo == 'Docente' ? 'bg-info' : 'bg-secondary' }}">
                                    {{ $solicitante->tipo }}
                                </span>
                            </td>
                            <td>{{ $solicitante->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No hay solicitantes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {{ $solicitantes->links() }}
    </div>
</div>
@endsection
