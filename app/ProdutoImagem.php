<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    public $timestamps = false;

    protected $fillable = ['file','file_thumb','produto_id','id'];

    // imagem tem 1 produto
    public function produto ()
    {
        return $this->belongsTo(Produto::class);
    }
}
