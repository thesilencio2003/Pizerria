@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pizza</h1>

    <form method="POST" action="{{ route('pizzas.update', $pizza->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $pizza->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $pizza->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $pizza->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Pizza</button>
        <a href="{{ route('pizzas.index') }}" class="btn btn-warning">Cancelar</a>
    </form>
</div>
@endsection
