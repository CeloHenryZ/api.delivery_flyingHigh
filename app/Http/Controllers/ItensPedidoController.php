<?php

namespace App\Http\Controllers;

use App\Models\ItensPedido;
use App\Models\Pedido;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ItensPedidoController extends Controller
{
    public function getItensPedido($id_pedido)
    {
        $pedido = Pedido::find($id_pedido);

        if($pedido)
        {
            $itensPedido = ItensPedido::where('id_pedido', $id_pedido)->get();
            if($itensPedido->isEmpty())
            {
                return response()->json(["response" => "Não há itens nesse pedido"], 403);
            }
            return response()->json($itensPedido, 200);
        }
        return response()->json(["response" => "Pedido não foi encontrado"], 403);
    }
}
