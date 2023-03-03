<?php

namespace App\Services;

use App\Models\ContatoUsuario;

class ContatoUsuarioService
{

    /**
     * @param mixed $contato
     */
    public function __construct($contato)
    {
        $this->contato = $contato;
    }

    public function saveContatoUsuario()
    {
        return ContatoUsuario::create([
            'id',
            'telefone'    => $this->contato['telefone'],
            'email'       => $this->contato['email'],
            'id_app_user' => $this->contato['id_app_user']
        ]);
    }
}
