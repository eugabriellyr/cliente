<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Especialidade;
use App\Models\Funcionario;
use App\Models\Usuario;
use App\Models\ServicosModel;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
                f.cargoFuncionario,
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

        // Verifique a estrutura dos dados antes de retornar
        return response()->json($horarios);
    }

    public function agendar(Request $request)
{
    // Validação dos campos
    $request->validate([
        'data' => 'required|date',
        'especialidade' => 'required|string|max:100',
        'horario' => 'required|date_format:H:i',
        'idCliente' => 'required|integer',
        'idFuncionario' => 'required|integer',
        'idServico' => 'required|integer'
    ]);

    // Buscar a duração do serviço
    $servico = ServicosModel::find($request->input('idServico'));
    if (!$servico) {
        return back()->withErrors(['idServico' => 'Serviço não encontrado.']);
    }

    // Calcular data_hora_final
    $dataHoraInicial = Carbon::createFromFormat('Y-m-d H:i', $request->input('data') . ' ' . $request->input('horario'));
    $dataHoraFinal = $dataHoraInicial->copy()->addMinutes($servico->duracaoServico);

    // Criar novo agendamento
    $agendamento = new Agendamento();

    $agendamento->dataAgendamento = $request->input('data');
    $agendamento->categoriaAgendamento = $request->input('especialidade');
    $agendamento->data_hora_inicial = $dataHoraInicial->format('H:i');
    $agendamento->data_hora_final = $dataHoraFinal->format('H:i');
    $agendamento->statusAgendamento = 'pendente';
    $agendamento->idCliente = $request->input('idCliente');
    $agendamento->idFuncionario = $request->input('idFuncionario');
    $agendamento->idServico = $request->input('idServico');

    $agendamento->save();

    return redirect()->route('dashboard.cliente.agendamentos')->with('success', 'Agendamento criado com sucesso');
}

}
