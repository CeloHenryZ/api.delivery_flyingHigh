<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    use HasFactory;

    protected $table = 'relatorios';
    protected $primaryKey = 'id_relatorio';

    protected $fillable = [
        'valor_total',
        'valor_frete',
    ];

    public $timestamps = false;
}
