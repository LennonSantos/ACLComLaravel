<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    public $fillable = ['numero_unidade','id_responsavel','metragem','quantidade_comodos','numero_matricula','situacao','id_bloco'];

    public function bloco()
    {
        return $this->belongsTo('App\Bloco', 'id_bloco');
    }

    public function morador()
    {
        return $this->belongsTo('App\Morador', 'id_responsavel');
    }
}
