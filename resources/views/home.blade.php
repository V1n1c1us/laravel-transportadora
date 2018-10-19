@extends('template.website')
@section('content')
    <div class="container">
        <section class="produtos">
            <div class="row">
                @forelse ($produtos as $produto)
                <div class="col-md-4 m-bottom">
                    <div class="card text-center" style="width: 18rem;">
                            @foreach ($produto->imagens as $imagem)
                                @if ($imagem->imgprincipal == 1)
                                    <img class="img-fluid card-img-top" src="{{ Storage::url($imagem->file) }}" alt="Card image cap">
                                @endif
                            @endforeach
                        <div class="card-body">
                            <h5 class="card-title">{{ $produto->nome }}</h5>
                            @if ($produto->quantidade < 10)
                                <h6 class="card-subtitle mb-2 text-muted">Estoque: <span class="badge badge-pill badge-danger">{{ $produto->quantidade }}</span></h6>
                            @else
                                <h6 class="card-subtitle mb-2 text-muted">Estoque: <span class="badge badge-pill badge-success">{{ $produto->quantidade }}</span></h6>
                            @endif
                            <p class="card-text">{{ $produto->descricao }}</p>
                            <p>Fornecedor:<span class="badge badge-pill badge-light"> {{ $produto->fornecedor->nome }}</span></p>
                                <a href="produto/info/{{ $produto->id }}" class="btn btn-primary"><i class="fas fa-info-circle text-center"></i></a>
                        </div>
                    </div>
                </div>

                @empty
                    <h2>nada</h2>
                @endforelse
            {!! $produtos->links() !!}
            </div>

        </section>
    </div>
@endsection

