<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoEntrega extends Model
{
    use HasFactory;

    public $table = "endereco_entrega";
    public $primaryKey = "id";

    public $fillable = [
        "id_bairro",
        "id_app_user",
        "rua",
        "numero",
        "complemento",
    ];

    public $timestamps = false;

    public function bairro()
    {
        return $this->hasOne(Bairro::class, "id_bairro", "id_bairro");
    }
}
