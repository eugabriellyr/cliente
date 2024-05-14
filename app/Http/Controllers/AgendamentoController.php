<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Especialidade;
use App\Models\Funcionario;
use App\Models\Usuario;
use App\Models\ServicosModel;
use Illuminate\Http\Request;


class AgendamentoController extends Controller
{
    //
    // public function ListarCategorias(){
    //     $categorias = ServicosModel::select('tipoServico')->distinct()->get();

    //     return view('site.dashboard.cliente.agendamento', compact('categorias'));
    // }

    // public function ListarEspecialidade()
    // {
    //     $idCliente = session('id');
    //     $cliente = Cliente::find($idCliente);



    //     return view('site.dashboard.cliente.agendamento', compact('especialidades')) ;
    // }

    public function index()
    {

        $idCliente = session('id');
        $cliente = Cliente::find($idCliente);

        // $idFuncionario = session('id');
        // $func = Funcionario::find($idFuncionario);

        $especialidades = Especialidade::select('especialidade')->distinct()->get();

        return view('site.dashboard.cliente.agendamento', compact('cliente', 'especialidades'));
    }

    public function listarServicos(Request $request)
    {
        $especialidadeSelecionada = $request->input('especialidade');

        // Consulta os serviços correspondentes à especialidade selecionada
        $servicos = ServicosModel::where('tipoServico', $especialidadeSelecionada)->get();

        // Retorna os serviços
        return $servicos;
    }

    public function ListarHorarios(){

    }
}
