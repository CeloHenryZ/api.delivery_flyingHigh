<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTamanhos extends Model
{
    use HasFactory;
    protected $table = 'tipo_tamanhos';
    protected $fillable = [
        'id_tipo_tamanho',
        'tipo',
    ];

    protected $primaryKey = 'id_tipo_tamanho';
    protected $hidden = ['pivot'];
    public $timestamps = false;


}
