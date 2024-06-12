<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agendamento;
use App\Jobs\EnviarNotificacaoAgendamento;
use Carbon\Carbon;

class EnviarNotificacoesAgendamentos extends Command
{
    protected $signature = 'notificacoes:enviar';
    protected $description = 'Enviar notificações de agendamentos pendentes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Buscar agendamentos a 24 horas de distância e que ainda estão pendentes
        $agendamentos = Agendamento::where('dataAgendamento', Carbon::now()->addDay()->toDateString())
                                   ->where('statusAgendamento', 'pendente')
                                   ->get();

        foreach ($agendamentos as $agendamento) {
            EnviarNotificacaoAgendamento::dispatch($agendamento);
        }

        $this->info('Notificações enviadas com sucesso.');
    }
}
