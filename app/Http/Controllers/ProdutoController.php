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
        $produtos = $this->produto->with('imagens:id,produto_id,file,imgprincipal','fornecedor:id,nome')->paginate(10);

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

           $filepath = public_path() . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $filename;

           if(Storage::allFiles($folder) == []){
            $file->move($destination, $filename);
            try {
                \Tinify\setKey("yb-oBFKJV_eyc7qTVibYs5yMLyLrEYEY");
                $source = \Tinify\fromFile($filepath);
                $source->toFile($filepath);
            } catch(\Tinify\AccountException $e) {
                // Verify your API key and account limit.
                return redirect('images/create')->with('error', $e->getMessage());
            } catch(\Tinify\ClientException $e) {
                // Check your source image and request options.
                return redirect('images/create')->with('error', $e->getMessage());
            } catch(\Tinify\ServerException $e) {
                // Temporary issue with the Tinify API.
                return redirect('images/create')->with('error', $e->getMessage());
            } catch(\Tinify\ConnectionException $e) {
                // A network connection error occurred.
                return redirect('images/create')->with('error', $e->getMessage());
            } catch(Exception $e) {
                // Something else went wrong, unrelated to the Tinify API.
                return redirect('images/create')->with('error', $e->getMessage());
            }

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

    public function edit ($id)
    {
        $produto = $this->produto->with('imagens:id,produto_id,file,imgprincipal','fornecedor:id,nome')->find($id);
        $fornecedores = $this->fornecedor->all();
        return view('produto.edit', compact('produto','fornecedores'));
    }

    public function update (Request $request, $id)
    {
        $produto = $this->produto->find($id);

        $produto->nome = $request->get('nome');
        $produto->descricao = $request->get('descricao');
        $produto->quantidade = $request->get('quantidade');
        $produto->fornecedor_id = $request->get('fornecedor_id');
        $imagChecked = $request->get('delete_images');
        $idImg = $request->get('imgprincipal');

        if($imagChecked != null){
            //unlink(public_path(). DIRECTORY_SEPARATOR . $item->file);
            $this->produtoImagem->destroy($imagChecked);
        }

        $this->produtoImagem->where('produto_id', $produto->id)->update(['imgprincipal' => 0]);

        $atualiza = $this->produtoImagem->where('id', '=', $idImg)->update(['imgprincipal' => 1]);

        $produto->save();

        return redirect()->route('produto.index')->withSuccess('Produto editado com sucesso!');
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
