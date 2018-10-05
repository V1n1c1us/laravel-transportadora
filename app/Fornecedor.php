<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    public $timestamps = false;

    protected $fillable = ['nome','cnpj'];

    // fornecedor tem muitos produtos
    public function produtos ()
    {
        return $this->hasMany(Produto::class);
    }
}
