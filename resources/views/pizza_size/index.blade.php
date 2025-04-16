<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Tamaños de Pizza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Listado de Tamaños de Pizza') }} </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pizza</th>
                            <th>Tamaño</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pizzaSizes as $pizzaSize)
                            <tr>
                                <td>{{ $pizzaSize->id }}</td>
                                <td>{{ $pizzaSize->pizza_name }}</td>
                                <td>{{ $pizzaSize->size }}</td>
                                <td>{{ $pizzaSize->price }}</td>
                                <td>
                             
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>