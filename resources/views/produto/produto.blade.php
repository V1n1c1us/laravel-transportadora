@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data"
    @csrf
    <input type="text" name="nome" id="">
    <input type="text" name="descricao" id="">
    <input type="text" name="quantidade" id="">
    <input type="text" name="file" id="">
    <button type="submit">Enviar</button>
</form>
<hr>
<h3>({{ $fornecedores->count() }}) produtos cadastrados</h3>
<ul>
@forelse ($fornecedores as $item)
    <li>Nome: {{ $item->nome }}</li>
    <li>Descrição: {{ $item->descricao }}</li>
    <li>Qtda: {{ $item->quantidade }}</li>
@empty
    <h2>nada</h2>
@endforelse
</ul>
