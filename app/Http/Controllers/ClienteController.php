<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){

        $idCliente = session('id');
        $cliente = Cliente::find($idCliente);

        $tipoUsuario = session('tipo');

        $usuario = Usuario::find($tipoUsuario);

        if(!$cliente){
            abort(404,'Cliente não encontrado');
        }
        return view('site.dashboard.cliente.cliente', compact('cliente', 'usuario'));
    }

    //API
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente, 200);

    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'emailUsuario' => 'required|email',
        'senhaUsuario' => 'required',
    ]);

    $usuario = Usuario::where('emailUsuario', $credentials['emailUsuario'])
                      ->where('senhaUsuario', $credentials['senhaUsuario'])
                      ->first();

    if ($usuario && $usuario->tipoUsuario_type == 'cliente') {
        $cliente = $usuario->tipo_usuario()->first();
        if ($cliente) {
            return response()->json([
                'message' => 'Login bem sucedido',
                'user' => [
                    'id' => $usuario->idUsuario,
                    'nome' => $usuario->nomeUsuario,
                    'email' => $usuario->emailUsuario,
                    'tipo' => $usuario->tipoUsuario_type,
                    'dados_cliente' => [
                        'idCliente' => $cliente->idCliente,
                        'nome' => $cliente->nomecliente,
                    ],
                ],
                'access_token' => $usuario->createToken('auth_token')->plainTextToken,
                'token_type' => 'Bearer',
            ]);
        }
    }
    return response()->json(['data' => ['message' => 'Credenciais inválidas ou usuário não é um cliente']], 401);
}



    public function agendar(){

        $idCliente = session('id');
        $cliente = Cliente::find($idCliente);

        return view('site.dashboard.cliente.agendamento', compact('cliente'));
    }

}
