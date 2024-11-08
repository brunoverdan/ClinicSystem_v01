@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')

<div class="bg-container text-center">
    <img src="{{ asset('fundoRevegora.jpg') }}" alt="Imagem de Fundo" class="img-fluid">
    <p class="text-white mt-3">Seja bem vindo ao sistema Gerenciamento de Cliente</p>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .bg-container {
            min-height: 100vh; /* Altura total da visualização */
            color: white;
        }
    </style>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LPEVDNJYWL"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-LPEVDNJYWL');
    </script>
@stop

@section('js')
<script>
    console.log("Todos os direitos reservados para clinimaster.net.br ©");
</script>
@stop

