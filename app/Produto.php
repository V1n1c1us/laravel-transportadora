<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public $timestamps = false;

    protected $fillable = ['nome','descricao','quantidade','fornecedor_id','produto_imagem_id'];

    //produto pertence a 1 fornecedor
    public function fornecedor ()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    //produto tem várias imagens
    public function imagens ()
    {
        return $this->hasMany(ProdutoImagem::class);
    }
}
