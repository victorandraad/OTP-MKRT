@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h2 class="text-2xl font-bold text-center text-yellow-400 mb-6">Login</h2>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-yellow-400 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-300">Lembrar-me</span>
            </label>
        </div>

        <div class="flex items-center justify-between mb-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-300 hover:text-yellow-400" href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif

            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                Entrar
            </button>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-300">
                Não tem uma conta? 
                <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold">
                    Registre-se aqui
                </a>
            </p>
        </div>
    </form>
@endsection
