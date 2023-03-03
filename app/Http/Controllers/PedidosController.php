<?php

namespace App\Http\Controllers;

use App\Models\Quantidades;
use App\Models\StoreStatus;
use App\Services\ItensPedidoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\ItensPedido;
use MelhorEnvio\Resources\Shipment\Product;
use MelhorEnvio\Shipment;
use MelhorEnvio\Resources\Shipment\Package;
use MelhorEnvio\Enums\Service;
use MelhorEnvio\Enums\Environment;
use App\Services\EnderecoEntregaService;


use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $itens_pedido = Pedido::with('itensPedido')
                              ->with('enderecoEntrega')
                              ->with('bairro')
                              ->where('status_pedido', 'pendente')
                              ->get();
        foreach($itens_pedido as $pedido){
            $pedido['bairro']['valor_frete']
                = (string)$pedido['bairro']['valor_frete'];
        }
        if(!empty($itens_pedido)){
            return response()->json($itens_pedido);
        } else {
            return response()->json('nenhum pedido encontrado :(', 200);
        }

    }

    public function byId($id)
    {
        $pedido = Pedido::with('itensPedido')
            ->with('enderecoEntrega')
            ->with('bairro')->find($id);
        if($pedido){
            return response()->json($pedido, 200);
        }else{
            return response()->json('id não encontrado :(');
        }
    }

    public function store(Request $req)
    {
        $store = StoreStatus::find(1);

        if($store->store_status === "fechada"){
            return response()->json(
                ["message" => $store->message],
                499
            );
        }

        $pedido_req = $req;
        $valorPedido = floatval($pedido_req['valor']);

        $endereco_req = array_merge($req['endereco_entrega'], ['id_app_user' =>  Auth::guard('app')->user()->id]);
        $enderecoEntrega = new EnderecoEntregaService($endereco_req);
        $enderecoNow = $enderecoEntrega->saveEnderecoEntrega();

        $pedidos = Pedido::create([
            'valor' => $valorPedido,
            'forma_pagamento' => $pedido_req['forma_pagamento'],
            'nome_cliente' => $pedido_req['nome_cliente'],
            'id_bairro' => $enderecoNow->id_bairro,
            'id_endereco_entrega' => $enderecoNow->id,
            'cpf/cnpj' =>  $pedido_req['cpf/cnpj'],
            'observacao' => $pedido_req['forma_pagamento'] == "Dinheiro"
                ? "Troco para R$ {$pedido_req['observacao']}"
                : $pedido_req['observacao'],
            'telefone' => $pedido_req['telefone'],
            'status_pedido' => $pedido_req['status_pedido'],
        ]);

        $itens_req= $req['itens_pedido'];
        $itensPedido = new ItensPedidoService($itens_req, $pedidos->id_pedido);
        $itensPedido->saveItensPedido();

        $data = Pedido::with('itensPedido')
                      ->with("enderecoEntrega")
                      ->with('bairro')
                      ->find($pedidos->id_pedido);

        if(!$data){
            return response()->json(["response" => $data, "eror" => "erro ao finalizar o pedido"], 400);
        }
        $data['bairro']['valor_frete'] =  (string)$data['bairro']['valor_frete'];
        return response()->json($data, 200);
    }

    public function basic(Request $req)
    {
        $query = Pedido::query();
        if($req->has('status_pedido')) {
            $query->with('itensPedido')->where('status_pedido', 'LIKE', '%'.$req->status_pedido.'%');
        }
        $pedidos = $query->get();
        return response()->json($pedidos);
    }


    public function putStatus(Request $req, $id)
    {
        $data = Pedido::with('itensPedido')->find($id);
        $data->status_pedido = $req->status_pedido;
        $data->save();

        return response()->json($data, 200);
    }

    public function listPending()
    {
        $pedidos = Pedido::with('itensPedido')
            ->whereIn('status_pedido', array('recebido', 'pendente'))->get();
        return response()->json($pedidos);
    }
}
