<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                        <input type="text" id="id" name="id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" disabled value="{{ $user->id }}">
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $user->name }}">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $user->email }}">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="role" name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option disabled value="">Selecciona un rol</option>
                            @foreach($roles as $roleOption)
                                <option value="{{ $roleOption->role }}" @if($user->role == $roleOption->role) selected @endif>
                                    {{ ucfirst($roleOption->role) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm">
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