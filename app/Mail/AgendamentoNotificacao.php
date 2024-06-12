<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgendamentoNotificacao extends Mailable
{
    use Queueable, SerializesModels;

    public $linkConfirmacao;

    public function __construct($linkConfirmacao)
    {
        $this->linkConfirmacao = $linkConfirmacao;
    }

    public function build()
    {
        return $this->subject('Confirme seu agendamento')
                    ->view('site.email.confirmacao_agendamento')
                    ->with(['linkConfirmacao' => $this->linkConfirmacao]);
    }
}
