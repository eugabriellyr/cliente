<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Agendamento;
use App\Jobs\EnviarNotificacaoAgendamento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Agendar envio de notificações para agendamentos pendentes
        $schedule->call(function () {
            Log::info('Executando tarefa de envio de notificações.');
            $agendamentos = Agendamento::where('dataAgendamento', Carbon::now()->addDay()->toDateString())
                                        ->where('statusAgendamento', 'pendente')
                                        ->get();

            if ($agendamentos->isEmpty()) {
                Log::info('Nenhum agendamento pendente encontrado.');
            } else {
                Log::info('Agendamentos pendentes encontrados: ' . $agendamentos->count());
                foreach ($agendamentos as $agendamento) {
                    EnviarNotificacaoAgendamento::dispatch($agendamento);
                }
            }
        })->everyMinute();

        // Agendar cancelamento de agendamentos não confirmados
        $schedule->call(function () {
            Log::info('Executando tarefa de cancelamento de agendamentos.');
            $cancelados = Agendamento::where('dataAgendamento', '<', Carbon::now()->toDateString())
                       ->where('statusAgendamento', 'pendente')
                       ->update(['statusAgendamento' => 'cancelado']);

            Log::info('Agendamentos cancelados: ' . $cancelados);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
