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
        $produtos = $this->produto->with('imagens:produto_id,file','fornecedor:id,nome')->get();

        $fornecedores = $this->fornecedor->all();

        return view('produto.index', compact('produtos','fornecedores'));
    }

    public function store (Request $request)
    {
        $insert = $this->produto->create($request->all());

        return redirect()->route('produto.index')
                         ->withSuccess('Fornecedor cadastrado com sucesso!');
    }

    public function getInfo ($id)
    {
        //Loading Specific Columns-> imagens / fornecedor
        $produto = $this->produto->with('imagens:produto_id,file','fornecedor:id,nome')->find($id);
        //dd($prodinfo);
        return view('produto.info', compact('produto'));
    }

    public function delete($id)
    {
        $produto = $this->produto->with('imagens','fornecedor')->find($id);

        $delete = $produto->delete();

        if($delete){
            return redirect()->route('produto.index')
            ->withSuccess('Produto deletado com sucesso!');
        } else {
            redirect()->route('/')
                         ->withSuccess('Produto deletado com sucesso!');
        }
    }

}
