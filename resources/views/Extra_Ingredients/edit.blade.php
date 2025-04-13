<div class="container">
    <h1>Editar Ingrediente Extra</h1>

    <form method="POST" action="{{ route('extra_ingredients.update', ['id' => $ingredient->id]) }}">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $ingredient->id }}" disabled>
            <div id="idHelp" class="form-text">ID del ingrediente.</div>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $ingredient->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $ingredient->price }}" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('extra_ingredients.index') }}" class="btn btn-warning">Cancelar</a>
        </div>
    </form>
</div>