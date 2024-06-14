<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AgendamentoEmail;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Especialidade;
use App\Models\ServicosModel;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \DateTime;
use \DateInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AgendamentoController extends Controller
{

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
        $servicos = ServicosModel::where('tipoServico', $especialidadeSelecionada)
            ->select('idServico', 'nomeServico', 'valorServico', 'duracaoServico', 'descricaoServico')
            ->get();

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
            s.duracaoServico,
            f.fotoFuncionario
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

    public function agendar(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'data'          => 'required|date',
            'especialidade' => 'required|string|max:100',
            'horario'       => 'required|date_format:H:i',
            'idCliente'     => 'required|integer',
            'idFuncionario' => 'required|integer',
            'idServico'     => 'required|integer'
        ]);

        // Buscar a duração do serviço selecionado
        $servico = ServicosModel::find($request->input('idServico'));
        if (!$servico) {
            return back()->withErrors(['idServico' => 'Serviço não encontrado.']);
        }

        // Buscar o cliente
        $cliente = Cliente::find($request->input('idCliente'));
        if (!$cliente) {
            return back()->withErrors(['idCliente' => 'Cliente não encontrado.']);
        }

        // Buscar o funcionário
        $funcionario = Funcionario::find($request->input('idFuncionario'));
        if (!$funcionario) {
            return back()->withErrors(['idFuncionario' => 'Funcionário não encontrado.']);
        }

        // Pegando parâmetros
        $duracaoServico = $servico->duracaoServico;
        $data = $request->input('data');
        $horario = $request->input('horario');

        // USANDO CARBON:
        // Convertendo a duração do serviço para minutos (para facilitar a soma)
        list($horas, $minutos) = explode(':', $duracaoServico);

        // Combinar só a hora inicial com Carbon
        $horaInicial = Carbon::createFromFormat('H:i', $horario);

        // Adicionar a duração do serviço ao horário inicial
        $horaInicial->addHours($horas)->addMinutes($minutos);

        // Formatar a hora final
        $dataHoraFinal = $horaInicial->format('H:i');

        // Criando novo agendamento
        $agendamento = new Agendamento();
        $agendamento->dataAgendamento = $data;
        $agendamento->categoriaAgendamento = $request->input('especialidade');
        $agendamento->data_hora_inicial = $horario;
        $agendamento->data_hora_final = $dataHoraFinal;
        $agendamento->statusAgendamento = 'pendente';
        $agendamento->idCliente = $request->input('idCliente');
        $agendamento->idFuncionario = $request->input('idFuncionario');
        $agendamento->idServico = $request->input('idServico');

        $agendamento->save();

        // Log para verificar o email do cliente
        Log::info('Email do cliente: ' . $cliente->emailCliente);

        // Enviar email de confirmação
        try {
            Mail::to($cliente->emailCliente)->send(new AgendamentoEmail($agendamento));
            Log::info('Email enviado para: ' . $cliente->emailCliente);
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.cliente')->with('success', 'Agendamento criado com sucesso e email enviado.');
    }

    public function confirmar($id)
{
    $agendamento = Agendamento::find($id);

    if ($agendamento) {
        $agendamento->statusAgendamento = 'confirmado';
        $agendamento->save();

        return "Agendamento confirmado com sucesso.";
    } else {
        return "Agendamento não encontrado.";
    }
} //Mudanças no status do agendamento por meio do id passado
}
