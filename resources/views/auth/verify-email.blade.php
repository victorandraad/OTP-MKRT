@extends('layouts.auth')

@section('title', 'Verificar E-mail')

@section('content')
    <h2 class="text-2xl font-bold text-center text-yellow-400 mb-6">Verificar E-mail</h2>

    <div class="mb-4 text-sm text-gray-300">
        {{ __('Obrigado por se registrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar? Se você não recebeu o e-mail, ficaremos felizes em enviar outro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                Reenviar E-mail de Verificação
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-300 hover:text-yellow-400">
                Sair
            </button>
        </form>
    </div>
@endsection