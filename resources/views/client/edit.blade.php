<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                <form method="POST" action="{{ route('clients.update', ['id' => $client->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                        <input type="text" id="id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $client->id }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Usuario</label>
                        <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option disabled selected value="">Seleccionar Usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $client->user_id) selected @endif>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" id="address" name="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $client->address }}">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" id="phone" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $client->phone }}">
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('clients.index') }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm">
                            Actualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>