@extends('template.website')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nome" id="">
    <input type="text" name="descricao" id="">
    <input type="text" name="quantidade" id="">
    <select name="fornecedor_id" id="">
        <option>Selecionte um Fornecedor</option>
        @foreach ($fornecedores as $item)
            <option value="{{ $item->id }}">{{ $item->nome }}</option>
        @endforeach
    </select>
    <input type="file" name="file" id="file">
    <button type="submit">Enviar</button>
</form>
<hr>
<h3>({{ $produtos->count() }}) produtos cadastrados</h3>
<ul>
@forelse ($produtos as $item)
    <li>Nome: {{ $item->nome }}</li>
    <li>Descrição: {{ $item->descricao }}</li>
    <li>Qtda: {{ $item->quantidade }}</li>
    <li>Fornecedor: {{ $item->fornecedor->nome }}</li>
    @forelse ($item->imagens as $itemimg)
        <li>{{ $itemimg->file }}</li>
    @empty
        <img src="#" alt="">
    @endforelse
@empty
    <h2>nada</h2>
@endforelse
</ul>
@endsection

