<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function __construct (Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    public function index ()
    {
        $fornecedores = $this->fornecedor->all();

        return view ('fornecedor.index', compact('fornecedores'));
    }

    public function store (Request $request)
    {
        $insert = $this->fornecedor->create($request->all());

        return redirect()->route('fornecedor.index')
                         ->withSuccess('Fornecedor cadastrado com sucesso!');
    }
}
