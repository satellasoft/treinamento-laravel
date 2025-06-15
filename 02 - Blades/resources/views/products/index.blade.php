@extends('partials.master')

@section('title', 'Listagem de Produtos')

@section('body')
    <h1>Listagem de produtos</h1>

    @foreach ($products as $product)
        @include('products.card', ['product' => $product])
    @endforeach

    <div class="mt-5">
        @include('forms.reserve')
    </div>
@endsection
