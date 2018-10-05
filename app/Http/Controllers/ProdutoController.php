<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Fornecedor;

class ProdutoController extends Controller
{

    public function __construct(Produto $produto, Fornecedor $fornecedor)
    {
        $this->produto = $produto;
        $this->fornecedor = $fornecedor;
    }

    public function index (Produto $produto)
    {
        $produtos = $this->produto->with('imagens','fornecedor')->get();

        $fornecedores = $this->fornecedor->all();

        return view('produto.index', compact('produtos','fornecedores'));
    }

    public function store (Request $request)
    {
        $insert = $this->produto->create($request->all());

        return redirect()->route('produto.index')
                         ->withSuccess('Fornecedor cadastrado com sucesso!');
    }

}
