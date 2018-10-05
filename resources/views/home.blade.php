@extends('template.website')
@section('content')
    <div class="container">
        <section class="produtos">
            <div class="row">
                @forelse ($produtos as $produto)
                <div class="col-md-4">
                    <div class="card text-center" style="width: 18rem;">
                            @if($produto->imagens->isNotEmpty())
                                <img class="card-img-top" src="{{ $produto->imagens->first()->file }}" alt="Card image cap">
                            @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $produto->nome }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Estoque: <span class="badge badge-pill badge-info">{{ $produto->quantidade }}</span></h6>
                            <p class="card-text">{{ $produto->descricao }}</p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-info-circle text-center"></i></a>
                        </div>
                    </div>
                    <ul>
                        <li>Fornecedor: {{ $produto->fornecedor->nome }}</li>
                    </ul>
                </div>
                @empty
                    <h2>nada</h2>
                @endforelse
            </div>

        </section>
    </div>
@endsection

