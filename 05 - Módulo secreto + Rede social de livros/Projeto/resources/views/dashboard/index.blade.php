@extends('partials.body')

@section('title', 'Bem-vindo de volta')

@section('body')
    <!-- Form -->
    <div class="card p-3 mb-4">
        <label class="mb-2">O que você está lendo?</label>
        <div class="d-flex gap-2 mb-2">
            <input type="text" class="form-control" placeholder="Título">
            <input type="text" class="form-control" placeholder="Autor">
        </div>
        <textarea class="form-control mb-2" rows="3" placeholder="Observações"></textarea>
        <div class="d-flex align-items-center gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="completo">
                <label class="form-check-label" for="completo">Completou</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="favorito">
                <label class="form-check-label" for="favorito">Favoritar</label>
            </div>
            <label class="ms-auto me-1 mb-0">Estrelas</label>
            <input type="number" class="form-control" value="5" style="width: 60px;">
        </div>
        <button class="btn btn-success">Postar</button>
    </div>


    <div>
        @include('dashboard.card')
    </div>
@endsection
