<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    use HasFactory;

    protected $table = 'bairros';
    protected $primaryKey = 'id_bairro';

    protected $fillable = [
        'id_bairro',
        'nome',
        'valor_frete',
        'isActive',
    ];

    public $timestamps = false;

}
