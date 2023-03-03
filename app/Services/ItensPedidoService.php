<?php

namespace App\Services;

use App\Models\ItensPedido;
use App\Models\Quantidades;

class ItensPedidoService
{
    private $itensPedido;
    private $idPedido;

    public function __construct($itensPedido, $idPedido)
    {
        $this->itensPedido = $itensPedido;
        $this->idPedido    = $idPedido;
    }

    public function saveItensPedido()
    {
        foreach($this->itensPedido as $item){
            $itens = ItensPedido::create(
                [
                    "id_produto"       => $item['id_produto'],
                    'id_pedido'        => $this->idPedido,
                    "tamanho"          => $item['tamanho'],
                    'quantidade'       => $item['quantidade'],
                    'valor_unitario'   => $item['valor_unitario'],
                    'descricaoProduto' => $item['descricaoProduto'],
                    'codigoProduto'    => $item['codigoProduto'],
                ]
            );
            $quantidades = Quantidades::where('id_produto', $item['id_produto'])
                ->where('tamanho', $item['tamanho'])->get();

            foreach ($quantidades as $quantidade){
                if($item['quantidade'] > $quantidade->quantidade){
                    return response()->json([
                        "response" => "quantidade máxima dos items: {$quantidade->quantidade}"
                    ], 401);
                }
                event(new \App\Events\userOderedItems($itens));
            }
        }
    }
}
