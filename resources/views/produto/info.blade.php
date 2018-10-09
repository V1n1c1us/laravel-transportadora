@extends('template.website')
@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-auto">
<div class="card" style="width: 20rem;">
        @if ($produto->imagens->isNotEmpty())
        <div class="info-slider">
            @foreach ($produto->imagens as $item)
                <div style="display:inline-block;"><img src="{{ $item->file }}" alt="{{ $item->id }}"></div>
            @endforeach
        </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                O produto <b>{{ $produto->nome }}</b> não possui imagens!
            </div>
        @endif
    <div class="card-body">
        <h5 class="card-title">{{ $produto->nome }}</h5>
        <p class="card-text">{{ $produto->descricao }}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Fornecedor: </li>
        @if ($produto->quantidade < 10)
            <li class="list-group-item">Quantidade: <span class="badge badge-pill badge-danger">{{ $produto->quantidade }}</span></li>
        @else
            <li class="list-group-item">Quantidade: <span class="badge badge-pill badge-success">{{ $produto->quantidade }}</span></li>
        @endif
    </ul>
    <div class="card-body text-center">
        <a href="delete/{{ $produto->id }}" class="card-link"><i class="fas fa-trash-alt"></i></a>
        <a href="#" class="card-link"><i class="fas fa-edit"></i></a>
    </div>
</div>
</div>
</div>

@endsection

