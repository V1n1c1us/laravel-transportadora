@extends('template.website')
@section('content')

<form action="{{ route('produto.update', $produto->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nomeProduto">Nome</label>
            <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto" name="nome" value="{{ $produto->nome }}">
        </div>
        <div class="form-group col-md-6">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" placeholder="Quantidade" name="quantidade" value="{{ $produto->quantidade }}">
        </div>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição do Produto</label>
        <textarea class="form-control" id="descricao" rows="3" name="descricao">{{ $produto->descricao }}</textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fornecedor">Fornecedor</label>
            <select name="fornecedor_id" id="inputState" class="form-control">
                <option value="{{ $produto->fornecedor_id }}" selected>{{ $produto->fornecedor->nome }}</option>
                @foreach ($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="file">Imagens</label>
            <input type="file" class="form-control-file" id="file" name="file[]" multiple>
        </div>
    </div>
    <div class="form-row">
            <div class="form-group col-md-12">
                    <label for="fornecedor">Escolha a imagem principal</label>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Imagem</th>
                        <th>Check</th>
                    </tr>
                    @forelse ($produto->imagens as $produtoImagem)
                    <tr>
                        <td>{{ $produtoImagem->id }}</td>
                        <td><img class="img-edit-table rounded" src="{{asset($produtoImagem->file) }}" alt=""></td>
                        <td>
                            <div class="form-check">
                                @if ($produtoImagem->imgprincipal == 1)
                                    <input class="form-check-input" type="radio" value="{{ $produtoImagem->id }}" id="imgprincipal" name="imgprincipal" checked>
                                @else
                                    <input class="form-check-input" type="radio" value="{{ $produtoImagem->id }}" id="imgprincipal" name="imgprincipal">
                                @endif

                            </div>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </table>
            </div>
        </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
