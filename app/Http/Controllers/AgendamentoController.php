<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Especialidade;
use App\Models\Funcionario;
use App\Models\Usuario;
use App\Models\ServicosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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

    public function listarHorarios(Request $request)
{
    $especialidade = $request->input('especialidade');
    $tipoServico = $request->input('tipoServico');
    $data = $request->input('data');

    $sql = "SELECT
                f.idFuncionario,
                f.nomeFuncionario,
                h.horario,
                s.duracaoServico
            FROM
                tblfuncionarios f
            CROSS JOIN
                tblhorarios h
            LEFT JOIN
                tblservicos s ON s.idServico = :tipoServico
            LEFT JOIN
                tblhorarios_disponiveis hd ON f.idFuncionario = hd.idFuncionario
                AND h.horario >= hd.data_hora_inicial
            LEFT JOIN
                tblagendamentos a ON f.idFuncionario = a.idFuncionario
                AND DATE(a.dataAgendamento) = :data
                AND DATE_ADD(h.horario, INTERVAL TIME_TO_SEC(s.duracaoServico) SECOND) BETWEEN a.data_hora_inicial AND DATE_ADD(a.data_hora_final, INTERVAL TIME_TO_SEC(s.duracaoServico) SECOND)
            JOIN
                tblespecialidade e ON f.idEspecialidade = e.idEspecialidade
            WHERE
                hd.idFuncionario IS NOT NULL
                AND a.idAgendamento IS NULL
                AND e.especialidade = :especialidade
            ORDER BY
                f.nomeFuncionario,
                h.horario";

    $horarios = DB::select(DB::raw($sql), [
        'tipoServico' => $tipoServico,
        'data' => $data,
        'especialidade' => $especialidade
    ]);

    return response()->json($horarios);
}

}
