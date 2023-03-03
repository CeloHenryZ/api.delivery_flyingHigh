<?php

namespace App\Http\Controllers;

use App\Models\StoreStatus;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class StoreStatusController extends Controller
{
    public function updateStoreStatus(Request $req)
    {
        $store = StoreStatus::find(1);

        if($store->store_status === 'fechada' && $req->status === 'fechada'){
            return response()->json(["message" => "a loja já se encontra fechada"], 498);
        }
        if($store->store_status === 'aberta' && $req->status === 'aberta'){
            return response()->json(["message" => "a loja já se encontra aberta"], 499);
        }

        $store->store_status = $req->status;
        $store->save();

        return response()->json(["message" => "loja $store->store_status"]);
    }

    public function updateMessageStoreStatus(Request $req)
    {
        $store = StoreStatus::find(1);
        $store->message = $req->message;
        $store->save();
        return response()->json($store, 200);
    }

    public function getStatus()
    {
        $store = StoreStatus::find(1);
        return response()->json($store, 200);
    }

    public function getMessageStore()
    {
        $store = StoreStatus::find(1);
        return response()->json($store, 200);
    }
}
