<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class HomeController extends Controller
{
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index ()
    {
        $produtos = $this->produto->with('imagens','fornecedor')->get();
        //dd($produtos);
        return view('home', compact('produtos'));
    }
}
