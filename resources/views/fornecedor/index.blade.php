@extends('template.website')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('fornecedor.store') }}" method="post">
    @csrf
    <input type="text" name="nome" id="">
    <input type="text" name="cnpj" id="">
    <button type="submit">Enviar</button>
</form>
<hr>
<h3>({{ $fornecedores->count() }}) fornecedores cadastrados</h3>
<ul>
@forelse ($fornecedores as $item)
    <li>nome: {{ $item->nome }}</li>
    <li>cnpj: {{ $item->cnpj }}</li>
@empty
    <h2>nada</h2>
@endforelse
</ul>
@endsection
                        {{-- @forelse ($produtoimagens as $itemimg)

                        @empty
                            {{-- <img src="https://via.placeholder.com/200x200" alt=""> --}}
                            @endforelse --}}
