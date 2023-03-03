<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContatoUsuario extends Model
{
    use HasFactory;

    public $table = 'contato_app_user';
    public $primaryKey = 'id';

    protected $fillable = [
        'telefone',
        'email',
        'id_app_user',
    ];

    public $timestamps = false;
}
