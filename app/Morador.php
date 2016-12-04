<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    protected $table = 'moradores';

     public $fillable = ['id_unidade','data_entrada','nome_completo','cpf','rg','telefone_1','telefone_2','telefone_3','profissao','data_nascimento','sexo','email'];

    public function unidade()
    {
        return $this->belongsTo('App\Unidade', 'id_unidade');
    }
}
