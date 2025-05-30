<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agregar Usuario</title>
</head>
<body>
    <div class="container">
        <h1>Agregar Usuario</h1>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" required class="form-control" id="name" name="name" placeholder="Nombre del usuario">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" required class="form-control" id="email" name="email" placeholder="Email del usuario">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" required class="form-control" id="password" name="password" placeholder="Contraseña">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" required class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select class="form-select" id="role" name="role">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->role }}">{{ ucfirst($rol->role) }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('users.index') }}" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>