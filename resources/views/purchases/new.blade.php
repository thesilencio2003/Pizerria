<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ __('Create New Client') }}</title>
</head>
<body>
    <div class="container">
        <h1>Crear Nueva Compra</h1>
<form action="{{ route('purchases.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="supplier_id">Proveedor</label>
        <select name="supplier_id" id="supplier_id" class="form-control" required>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="raw_material_id">Materia Prima</label>
        <select name="raw_material_id" id="raw_material_id" class="form-control" required>
            @foreach ($rawMaterials as $rawMaterial)
                <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Cantidad</label>
        <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="purchase_price">Precio de Compra</label>
        <input type="number" name="purchase_price" id="purchase_price" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="purchase_date">Fecha de Compra</label>
        <input type="date" name="purchase_date" id="purchase_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Crear Compra</button>
</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


