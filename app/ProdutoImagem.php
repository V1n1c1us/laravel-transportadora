<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    public $timestamps = false;

    protected $fillable = ['file','produto_id'];

    // imagem tem 1 produto
    public function produto ()
    {
        return $this->belongsTo(Produto::class);
    }
}
