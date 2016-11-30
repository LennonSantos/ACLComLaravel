<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    public $fillable = ['numero_unidade','id_responsavel','metragem','quantidade_comodos','numero_matricula','situacao','id_bloco'];
}
