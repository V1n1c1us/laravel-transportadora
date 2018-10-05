<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class HomeController extends Controller
{
    public function index ()
    {
        $produtos = Produto::with('imagens','fornecedor')->get();
        //dd($produtos);
        return view('home', compact('produtos'));
    }
}
