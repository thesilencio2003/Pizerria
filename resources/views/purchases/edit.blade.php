<div class="container">
    <h1>Editar Compra</h1>
    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="supplier_id">Proveedor</label>
            <select name="supplier_id" id="supplier_id" class="form-control" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="raw_material_id">Materia Prima</label>
            <select name="raw_material_id" id="raw_material_id" class="form-control" required>
                @foreach ($rawMaterials as $rawMaterial)
                    <option value="{{ $rawMaterial->id }}" {{ $rawMaterial->id == $purchase->raw_material_id ? 'selected' : '' }}>{{ $rawMaterial->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Cantidad</label>
            <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" value="{{ $purchase->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="purchase_price">Precio de Compra</label>
            <input type="number" name="purchase_price" id="purchase_price" class="form-control" step="0.01" value="{{ $purchase->purchase_price }}" required>
        </div>
        <div class="form-group">
            <label for="purchase_date">Fecha de Compra</label>
            <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="{{ $purchase->purchase_date->format('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Compra</button>
    </form>
</div>