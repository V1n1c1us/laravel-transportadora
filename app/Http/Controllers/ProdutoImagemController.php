<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoImagemController extends Controller
{
        //produto tem várias imagens
    public function produto ()
    {
        return $this->belogsTo(Produto::class);
    }
}
