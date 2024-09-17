@extends('layouts.auth')

@section('title', 'Confirmar Senha')

@section('content')
    <h2 class="text-2xl font-bold text-center text-yellow-400 mb-6">Confirmar Senha</h2>
    <div class="mb-4 text-sm text-gray-300">
        {{ __('Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                Confirmar
            </button>
        </div>
    </form>
@endsection
