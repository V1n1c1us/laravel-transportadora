<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Fornecedor;
use App\ProdutoImagem;

class ProdutoController extends Controller
{

    public function __construct(Produto $produto, Fornecedor $fornecedor, ProdutoImagem $produtoImagem)
    {
        $this->produto = $produto;
        $this->fornecedor = $fornecedor;
        $this->produtoImagem = $produtoImagem;
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

       $folder = 'produto_img_'.$request->nome;

       $files = $request->file('file');

       foreach($files as $file) {
           $filename = str_random(30) . '.' . $file->getClientOriginalExtension();
           $destination = public_path() . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR;
           $fullPath = DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $filename;

           if(Storage::allFiles($folder) == []){
            $file->move($destination, $filename);
            $createFile = $this->produtoImagem->create(['produto_id' => $insert->id,
                                                     'file' => $fullPath]);
         }
       }
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

        foreach($produto->imagens as $item) {
            unlink(public_path(). DIRECTORY_SEPARATOR . $item->file);
        }
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
