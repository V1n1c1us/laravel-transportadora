<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use App\Http\Requests\FornecedorRequest;

class FornecedorControllerApi extends Controller
{
    public function __construct (Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    public function index ()
    {
        $fornecedores = $this->fornecedor->all();

        return response()->json($fornecedores);
    }

    public function store (FornecedorRequest $request)
    {
        $data = $request->all();

        $this->fornecedor->create([
            'nome' => $data['nome'],
            'cnpj' => $data['cnpj']
        ]);

        return response()->json();
        /* return redirect()->route('fornecedor.index')
                         ->withSuccess('Fornecedor cadastrado com sucesso!'); */
    }
}
