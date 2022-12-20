<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['fornecedor_id', 'nome', 'descricao', 'peso', 'unidade_id'];

    public function itemDetalhe()
    {
        // utilizando o hasOne com nomes não padronizados no db
        return $this->hasOne('App\Models\ItemDetalhe', 'produto_id', 'id');
    }

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor', 'fornecedor_id', 'id');
    }
}
