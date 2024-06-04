<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Usuario;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CadastroController extends Controller
{
    public function index()
    {
        return view('site.cadastro');
    }

    public function cadastroCliente(Request $request)
    {
        $request->validate([
            'nomeUsuarioRegistro'   => 'nullable|string|max:100',
            'senhaUsuarioRegistro'  => 'nullable|string|max:255',
            'emailUsuarioRegistro'  => 'nullable|email|max:200|unique:tblusuarios,emailUsuario',
            'telefoneUsuarioRegistro' => 'nullable|string|max:16',
        ]);

        $usuario = new Usuario();
        $cliente = new Cliente();

        $usuario->nomeUsuario = $request->input('nomeUsuarioRegistro');
        $cliente->nomeCliente = $request->input('nomeUsuarioRegistro');

        $usuario->senhaUsuario = $request->input('senhaUsuarioRegistro');
        $cliente->senhaCliente = $request->input('senhaUsuarioRegistro');

        $usuario->emailUsuario = $request->input('emailUsuarioRegistro');
        $cliente->emailCliente = $request->input('emailUsuarioRegistro');
        $cliente->telefoneCliente = $request->input('telefoneUsuarioRegistro');

        // dd($cliente);
        $cliente->save();

        $ultimoClienteId = $cliente->idCliente;

        $usuario->tipoUsuario_id = $ultimoClienteId;
        $usuario->tipoUsuario_type = 'cliente';

        // dd($usuario);
        $usuario->save();

        Session::flash('message', 'Cadastro realizado com sucesso! Por favor, faça o login.');

        return redirect()->route('login');
    }
}
