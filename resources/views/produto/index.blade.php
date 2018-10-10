@extends('template.website') @section('content') @if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nomeProduto">Nome</label>
            <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto" name="nome">
        </div>
        <div class="form-group col-md-6">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" placeholder="Quantidade" name="quantidade">
        </div>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição do Produto</label>
        <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fornecedor">Fornecedor</label>
            <select name="fornecedor_id" id="inputState" class="form-control">
                <option>Selecionte um Fornecedor</option>
                @foreach ($fornecedores as $item)
                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="file">Imagens</label>
            <input type="file" class="form-control-file" id="file" name="file[]" multiple>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
<hr>
<h3><span class="badge badge-primary badge-pill">{{ $produtos->count() }}</span> produtos cadastrados</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Imagens</th>
            <th scope="col">Operação</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($produtos as $produto)
        <tr>
            <th scope="row">{{ $produto->id }}</th>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->descricao }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_{{$produto->id}}">
                    Launch demo modal
                </button>
            </td>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal_{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="badge badge-pill badge-info">Imagens</span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="modal-list">
                                @forelse ($produto->imagens as $produtoImg)
                                    <li><img class="rounded float-left modal-image" src="{{asset($produtoImg->file) }}" alt="{{ $produtoImg->id }}"></li>
                                @empty
                                <img src="#" alt="">
                                @endforelse
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <td>
                <a href="produto/delete/{{ $produto->id }}"><i class="fas fa-trash-alt fa-2x"></i></a> |
                <a href=""><i class="fas fa-edit fa-2x"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
