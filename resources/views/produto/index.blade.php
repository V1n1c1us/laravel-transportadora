@extends('template.website') @section('content') @if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
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
            <th scope="col">Fornecedor</th>
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
            <td>{{ $produto->fornecedor->nome }}</td>
            <td>
                <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal_{{$produto->id}}">
                    <i class="far fa-eye"></i>
                </button>
            </td>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal_{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="badge badge-pill badge-info">{{ $produto->imagens->count() }}</span> Imagens</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    @forelse ($produto->imagens as $produtoImg)
                                    <div class="col-md-4">
                                      <div class="card">
                                          <img class="card-img-top rounded" src="{{ Storage::url($produtoImg->file) }}" alt="Card image cap">
                                          <div class="card-body">
                                          </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="alert alert-info" role="alert">
                                        O <strong>{{ $produto->nome }}</strong> não contêm imagens cadastradas!
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
            </div>

            <td>
                <div class="btn-group" role="group" aria-label="actions">
                    <button type="button" class="btn btn-link">
                        <a href="produto/delete/{{ $produto->id }}"><i class="fas fa-trash-alt fa-1x"></i></a>
                    </button>
                    <button type="button" class="btn btn-link">
                        <a href="produto/edit/{{ $produto->id }}"><i class="fas fa-edit fa-1x"></i></a>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $produtos->links() !!} @endsection
