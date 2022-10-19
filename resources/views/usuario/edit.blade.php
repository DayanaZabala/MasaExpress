@extends('layouts.main')

@section('titulo', 'Editar Usuario')

@section('content')

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nombre" id="name" value="{{ $usuario->name }}" readonly>
            <label for="nombre">Nombre</label>
    </div>
    <div class="form-floating mb-3">
            <input type="text" class="form-control" name="email" placeholder="email" id="email" value="{{ $usuario->email }}" readonly>
            <label for="nombre">Correo electrónico</label>
    </div>
        <label for="roles" class="fw-bold">Roles</label>
        @foreach ($roles as $item)
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="rol[]" value="{{ $item->id }}" @if($usuario->roles->pluck('id')->contains($item->id)) checked @endif>
                <label class="form-check-label">{{ $item->nombre }}</label>
            </div>

        @endforeach
        <button type="submit" class="btn btn-secondary">Guardar</button>
    </form>

@endsection