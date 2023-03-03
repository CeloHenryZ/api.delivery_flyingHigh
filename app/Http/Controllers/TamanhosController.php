<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Tamanhos;
use Illuminate\Http\Request;

class TamanhosController extends Controller
{

    public function index() {
        $tamanhos = Tamanhos::all();
        return response($tamanhos, 200);
    }

    public function byId($id) {
        $tamanhos = Tamanhos::find($id);
        return response($tamanhos, 200);
    }

    public function byTipoTamanho($id) {
        $tamanhos = Tamanhos::where('id_tipo_tamanho', $id)->get();
        return response($tamanhos, 200);
    }

    public function store(Request $req)
    {
        $reqTam = $req->tamanho;
        $idTipoTamanho = $req->id_tipo_tamanho;
        $tamanho = Tamanhos::create([
           "tamanho" => $reqTam,
            "id_tipo_tamanho" => $idTipoTamanho
        ]);
        return response($tamanho, 200);
    }

    public function update(Request $req, $id) {
        $tamanho = Tamanhos::find($id);
        $tamanho->update(['tamanho'=>$req->tamanho]);
        $tamanho->save();

        $retorno = Tamanhos::all();
        return response($retorno, 200);

    }

    public function destroy($id) {
        $tamanho = Tamanhos::find($id)->delete();

        if($tamanho) {
            return response("Sucess!", 200);
        } else return ('Error!');



    }
}
