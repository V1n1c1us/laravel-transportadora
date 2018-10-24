@extends('template.website')
@section('content')
<div class="container">
        <section class="produtos">
            <div class="row">
                <div class="album py-5 bg-light">
                    <div class="row">
                        @forelse ($produtos as $produto)
                            <div class="col-md-4">
                                  <div class="card mb-4 shadow-sm">
                                        @foreach ($produto->imagens as $imagem)
                                        @if ($imagem->imgprincipal == 1)
                                            <img class="img-fluid card-img-top" src="{{ Storage::url($imagem->file_thumb) }}" alt="Card image cap">
                                        @endif
                                    @endforeach
                                    <div class="card-body">
                                      <p class="card-text">{{ $produto->descricao }}</p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{ url('produto/view/'.$produto->id) }}">View</a></button>
                                        </div>
                                        <small class="text-muted">
                                                @if ($produto->quantidade < 10)
                                                <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-pill badge-danger">{{ $produto->quantidade }}</span></h6>
                                            @else
                                                <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-pill badge-success">{{ $produto->quantidade }}</span></h6>
                                            @endif
                                        </small>
                                      </div>
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

