<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Relatorio;
use App\Models\RelatorioPedido;
use Illuminate\Http\Request;

class RelatorioPedidoController extends Controller
{
    public function store(Request $req)
    {
        if($req->type == 'todos'){
            $pedidos = Pedido::all();
        }
        if($req->type == 'faturados'){
            $pedidos = Pedido::where('status', 'faturado')
                ->bairro()->enderecoEntrega()->get();
        }

        Relatorio::create([
            'valor_total' => '',
            'valor_frete' => '',
        ]);

        foreach($pedidos as $pedido) {
            RelatorioPedido::create(

            );
        }

    }
}
