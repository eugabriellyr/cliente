<?php

namespace App\Jobs;

use App\Models\Agendamento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgendamentoNotificacao;

class EnviarNotificacaoAgendamento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $agendamento;

    public function __construct(Agendamento $agendamento)
    {
        $this->agendamento = $agendamento;
    }

    public function handle()
    {
        $linkConfirmacao = route('confirmar.agendamento', ['id' => $this->agendamento->idAgendamento]);
        Mail::to($this->agendamento->cliente->emailCliente)->send(new AgendamentoNotificacao($linkConfirmacao));
    }
}
