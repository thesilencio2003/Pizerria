<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Listado de Pedidos y Pizzas</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Listado de Pedidos y Pizzas</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Tamaño de Pizza</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderPizzas as $orderPizza)
                    <tr>
                        <td>{{ $orderPizza->id }}</td>
                        <td>{{ $orderPizza->order->id }} - {{ $orderPizza->order->client->name }}</td>
                        <td>{{ $orderPizza->pizzaSize->size }}</td>
                        <td>{{ $orderPizza->quantity }}</td>
                        <td>
            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orderPizzas->links() }} <!-- Paginación -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>