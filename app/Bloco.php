<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{
    public $fillable = ['nome_bloco','quantidade_unidade'];
}
