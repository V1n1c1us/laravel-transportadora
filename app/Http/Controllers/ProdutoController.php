<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Fornecedor;
use App\ProdutoImagem;
use App\Http\Requests\ProdutoRequest;
use Image;
use Illuminate\Http\File;
use Carbon\Carbon;

class ProdutoController extends Controller
{

    public function __construct(Produto $produto,Fornecedor $fornecedor,ProdutoImagem $produtoImagem)
    {
        $this->produto = $produto;
        $this->fornecedor = $fornecedor;
        $this->produtoImagem = $produtoImagem;
    }

    public function index(Produto $produto)
    {
        $produtos = $this->produto->with('imagens:id,produto_id,file,file_thumb,imgprincipal','fornecedor:id,nome')->paginate(10);

        $fornecedores = $this->fornecedor->all();

        return view('produto.index', compact('produtos','fornecedores'));
    }

    public function store(ProdutoRequest $request)
    {
       $insert = $this->produto->create($request->all());

       //$folder = 'produto_img_'.$request->nome;

       $files = $request->file('file');

       foreach($files as $file) {
           $filename = now()->timestamp. '.' . $file->getClientOriginalExtension();
           //$current_time = Carbon::now()->timestamp;
           //$filename = $current_time.'.'.$file->getClientOriginalExtension();
           //$destination = public_path() . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR;
           //$fullPath = DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $filename;
           $fullPath = 'fotos_produtos/'.$filename;
           $fullpathThumb = 'fotos_produtos_thumb/'.$filename;
           //$filepath = public_path() . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $filename;

           Storage::putFileAs('public/fotos_produtos/', $file, $filename,'public');
           Storage::makeDirectory('public/fotos_produtos_thumb');
           $image = Image::make('../storage/app/public/'.$fullPath)->save('../storage/app/public/'.$fullpathThumb, 40);

           /*$file = Storage::disk('public')->put('fotos_produtos', new File($file), 'public');

           $image = Image::make('../storage/app/public/'.$file);
           $image->save('../storage/app/public/'.$fullpathThumb, 40);
            */
           $createFile = $this->produtoImagem->create(['produto_id' => $insert->id,
                                                       'file' => $fullPath,
                                                       'file_thumb' => $fullpathThumb]);
        }

        return redirect()->route('produto.create')
                         ->withSuccess('Fornecedor cadastrado com sucesso!');
    }

    public function view($id)
    {
        //Loading Specific Columns-> imagens / fornecedor
        $produto = $this->produto->with('imagens:produto_id,file,file_thumb','fornecedor:id,nome')->find($id);
        //dd($prodinfo);
        return view('produto.view', compact('produto'));
    }

    public function edit($id)
    {
        $produto = $this->produto->with('imagens:id,produto_id,file,file_thumb,imgprincipal','fornecedor:id,nome')->find($id);
        $fornecedores = $this->fornecedor->all();
        return view('produto.edit', compact('produto','fornecedores'));
    }

    public function update(Request $request,$id)
    {
        $produto = $this->produto->find($id);

        $produto->nome = $request->get('nome');
        $produto->descricao = $request->get('descricao');
        $produto->quantidade = $request->get('quantidade');
        $produto->fornecedor_id = $request->get('fornecedor_id');
        $imagChecked = $request->get('delete_images');
        $idImg = $request->get('imgprincipal');

        $files = $request->file('file');
        foreach($files as $file) {
            $filename = now()->timestamp. '.' . $file->getClientOriginalExtension();
            $fullPath = 'fotos_produtos/'.$filename;
            $fullpathThumb = 'fotos_produtos_thumb/'.$filename;

            Storage::putFileAs('public/fotos_produtos/', $file, $filename,'public');
            Storage::makeDirectory('public/fotos_produtos_thumb');
            $image = Image::make('../storage/app/public/'.$fullPath)->save('../storage/app/public/'.$fullpathThumb, 40);

            $createFile = $this->produtoImagem->create(['produto_id' => $produto->id,
                                                        'file' => $fullPath,
                                                        'file_thumb' => $fullpathThumb]);
         }

       $this->produtoImagem->where('produto_id', $produto->id)->update(['imgprincipal' => 0]);
       $atualiza = $this->produtoImagem->where('id', '=', $idImg)->update(['imgprincipal' => 1]);

       $produto->save();

       return redirect()->route('produto.create')->withSuccess('Produto editado com sucesso!');
    }

    /**
     * Remove register and file from storage
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $produto = $this->produto->with('imagens','fornecedor')->find($id);

        if(isset($produto)) {
            foreach($produto->imagens as $image) {
                $deletefile = $image->file;
                $deletefilethumb = $image->file_thumb;
                Storage::disk('public')->delete([$deletefile, $deletefilethumb]);

                //unlink(storage_path('public/'.$image->file));
                //unlink(storage_path('public/'.$image->file));
                //Storage::disk('public')->delete($deletefilethumb);
            }
            $delete = $produto->delete();
            if($delete){
                return redirect()->route('produto.create')
                ->withSuccess('Produto deletado com sucesso!');
            } else {
                return redirect()->route('/')
                             ->withSuccess('Ops.. Erro ao deletar o produto!');
            }
        }


        /*



        */
    }

}
