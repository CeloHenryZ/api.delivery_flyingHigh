<?php

namespace App\Services;

use App\Models\EnderecoEntrega;

class EnderecoEntregaService
{
    private $enderecoEntrega;

    public function __construct($enderecoEntrega)
    {
        $this->enderecoEntrega = $enderecoEntrega;
    }

    public function saveEnderecoEntrega()
    {
        return EnderecoEntrega::create([
            "id",
            "id_bairro"   => $this->enderecoEntrega['id_bairro'],
            "id_app_user" => $this->enderecoEntrega['id_app_user'],
            "rua"         => $this->enderecoEntrega['rua'],
            "numero"      => $this->enderecoEntrega['numero'],
            "complemento" => $this->enderecoEntrega['complemento']
                                == null ? ""
                                : $this->enderecoEntrega['complemento'],
        ]);
    }
}
