<?php

namespace App\Services;

use App\Models\ItensPedido;
use App\Models\Produtos;
use App\Models\Quantidades;


class ProductStockManagerService
{
    public $itensPedido;

    public function __construct(ItensPedido $itensPedido)
    {
        $this->itensPedido = $itensPedido;
    }

    public function removeFromStockProductsWithSize()
    {
        $item = $this->itensPedido;
              Quantidades::where('id_produto', $item['id_produto'])
                  ->where('tamanho', $item['tamanho'])
                  ->decrement('quantidade', $item['quantidade']);

    }

}
