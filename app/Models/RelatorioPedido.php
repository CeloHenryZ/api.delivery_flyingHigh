<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatorioPedido extends Model
{
    use HasFactory;

    protected $table = 'relatorios_pedidos';
    protected $primaryKey = 'id_relatorio_pedido';

    protected $fillable = [
        'id_pedido',
        'id_bairro',
        'id_endereco_entrega',
        'id_relatorio',
    ];

    public $timestamps = true;


    public function relatorio()
    {
        $this->belongsTo(Relatorio::class, 'id_relatorio', 'id_relatorio');
    }

    public function pedido()
    {
        $this->hasOne(Pedido::class, 'id_pedido', 'id_pedido');
    }

    public function bairro()
    {
        $this->hasOne(Bairro::class, 'id_bairro', 'id_bairro');
    }

    public function enderecoEntrega()
    {
        $this->hasOne(EnderecoEntrega::class, 'id_endereco_entrega', 'id');
    }
}
