<?php

namespace App\Http\Controllers;
use App\Http\Requests\BairroRequest;
use App\Models\Bairro;
use App\Models\Cidade;
use DB;
use Illuminate\Http\Request;

class BairroController extends Controller
{
    public function index()
    {
        $bairros = Bairro::where('isActive', 1)->get();
        if(empty($bairros) || $bairros == []){
            return response()->json('nenhum bairro encontrado', 405);
        }
        foreach($bairros as $bairro){
            $bairro['valor_frete'] = bcadd($bairro['valor_frete'], 0, 2);
        }

        return response()->json($bairros, 200);
    }

    public function store(BairroRequest $req)
    {
        $bairro = new Bairro();
        if($bairro->where('isActive', 1)->where('nome', $req->nome)->first()){
            return response()->json(
                'Bairro já cadastrado', 405
            );
        }
        $bairroCreate = $bairro->create(
            [
                "nome" => $req->nome,
                "valor_frete" => (float)$req->valor_frete,
                "isActive" => 1
             ]
        );

        if(!$bairroCreate){
            return response()->json("não foi possível cadastrar o bairro", 403);
        }

        $bairroCreate->valor_frete = (string)$bairroCreate->valor_frete;
        return response()->json($bairroCreate, 200);
    }


    public function put(BairroRequest $req, $id_bairro)
    {
        $bairro = new Bairro();
        $bairroSelected = $bairro->where('isActive', 1)->find($id_bairro);

        if(empty($bairroSelected)){
            return response()->json('id não encontrado', 409);
        }

        if($bairroSelected->valor_frete == $req->valor_frete
            && $bairroSelected->nome == $req->nome)
        {
            return response()->json('Nenhum dado alterado', 405);
        }
         $bairroSelected->nome = $req->nome;
         $bairroSelected->valor_frete = $req->valor_frete;
         $bairroSelected->update();

         return response()->json("Bairro $bairroSelected->nome atualizado com sucesso",
             200);

    }

    public function deleteBairro($id_bairro)
    {
        $bairro = Bairro::where('isActive', 1)->find($id_bairro);
        if(!$bairro){
            return response('bairro não encontrado', 403);
        }
        $bairro->isActive = 0;
        $bairro->save();
        return response()->json("bairro $bairro->nome deletado com suceso", 200);
    }

}
