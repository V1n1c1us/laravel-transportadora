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
                <option selected>{{ $produto->fornecedor->nome }}</option>
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
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
@endsection
