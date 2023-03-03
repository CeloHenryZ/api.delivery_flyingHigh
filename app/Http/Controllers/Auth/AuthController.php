<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAppRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\AppUser;
use App\Services\ContatoUsuarioService;
use App\Services\EnderecoEntregaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('appJwt', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request, $remember = 0)
    {
        $credentials = $request->validated();
        $newUser = AppUser::create($credentials);

        if (empty($newUser)) {
            return response(['message' => 'nao foi possivel criar o usuario']);
        }

        $remember = $request->remember;

        if(!$token = auth()->guard('app')->attempt($request->only(['password', 'cpf']), $remember)) {
            return response()->json(['error' => 'erro interno, token invalido.'], 401);
        }

        $enderecoEntrega = array_merge($request['endereco_entrega'], ['id_app_user' => $newUser->id]);
         (new EnderecoEntregaService($enderecoEntrega))->saveEnderecoEntrega();

        $contatoUsuario = array_merge($request['contato'], ['id_app_user' => $newUser->id]);
        (new ContatoUsuarioService($contatoUsuario))->saveContatoUsuario();

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $newUser,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(LoginAppRequest $request)
    {
        try{
            $request->validated();

            if(! $token = auth()->attempt($request->except('remember'), $request->remember)){
                return response()->json(['error' => 'unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }
        catch(\Exception $e) {
            return $e;
        }
    }

    public function me()
    {
        try{
        return response()->json(auth()->user());
        }
        catch(\Exception $e) {
            return $e;
        }
    }

    public function logout()
    {
        auth('app')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('app')->factory()->getTTL() * 60
        ]);
    }

}
