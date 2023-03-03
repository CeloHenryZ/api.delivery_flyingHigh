<?php

namespace App\Http\Controllers;

use App\Models\TipoTamanhos;
use Illuminate\Http\Request;

class TipoTamanhosController extends Controller
{

    public function index() {
        $tiposTamanhos = TipoTamanhos::all();
        return response($tiposTamanhos, 200);
    }

    public function byId($id) {
        $tipoTamanho = TipoTamanhos::find($id);
        return response($tipoTamanho, 200);
    }

    public function store(Request $req)
    {
        $rawData = $req->id_;
        $tipoTamanho = TipoTamanhos::create($rawData);
        return response($tipoTamanho, 200);
    }

    public function update(Request $req, $id) {
        $tipoTamanho = TipoTamanhos::find($id);
        $tipoTamanho->update(['tipo'=>$req->tipo]);
        $tipoTamanho->save();

        $retorno = TipoTamanhos::all();
        return response($retorno, 200);

    }

    public function destroy($id) {
        $tipoTamanho = TipoTamanhos::find($id)->delete();

        if($tipoTamanho) {
            return response("Sucess!", 200);
        } else return ('Error!');



    }
}
