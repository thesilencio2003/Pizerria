<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Pedido') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <!-- Formulario para editar pedido -->
                        <form method="POST" action="{{ route('orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Cliente -->
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Cliente</label>
                                <select class="form-control" id="client_id" name="client_id" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sucursal -->
                            <div class="mb-3">
                                <label for="branch_id" class="form-label">Sucursal</label>
                                <select class="form-control" id="branch_id" name="branch_id" required>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $order->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Precio Total -->
                            <div class="mb-3">
                                <label for="total_price" class="form-label">Precio Total</label>
                                <input type="number" class="form-control" id="total_price" name="total_price" value="{{ $order->total_price }}" step="0.01" required>
                            </div>

                            <!-- Estado -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="pendiente" {{ $order->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_preparacion" {{ $order->status == 'en_preparacion' ? 'selected' : '' }}>En preparación</option>
                                    <option value="listo" {{ $order->status == 'listo' ? 'selected' : '' }}>Listo</option>
                                    <option value="entregado" {{ $order->status == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                </select>
                            </div>

                            <!-- Tipo de Entrega -->
                            <div class="mb-3">
                                <label for="delivery_type" class="form-label">Tipo de Entrega</label>
                                <select class="form-control" id="delivery_type" name="delivery_type" required>
                                    <option value="en_local" {{ $order->delivery_type == 'en_local' ? 'selected' : '' }}>En local</option>
                                    <option value="a_domicilio" {{ $order->delivery_type == 'a_domicilio' ? 'selected' : '' }}>A domicilio</option>
                                </select>
                            </div>

                            <!-- Repartidor -->
                            <div class="mb-3">
                                <label for="delivery_person_id" class="form-label">Repartidor</label>
                                <select class="form-control" id="delivery_person_id" name="delivery_person_id">
                                    <option value="">No asignado</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $order->delivery_person_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Actualizar Pedido</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>