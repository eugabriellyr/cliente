<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Agendamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #1c87c9;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header img {
            width: 50px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #1c87c9;
            margin-top: 0;
        }
        .content p {
            line-height: 1.6;
        }
        .content .details {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .content .details p {
            margin: 0;
        }
        .content .cta {
            text-align: center;
            margin-top: 20px;
        }
        .content .cta a {
            background-color: #1c87c9;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            background-color: #333333;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
        .footer a {
            color: #1c87c9;
            text-decoration: none;
        }
        .steps {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .steps .step {
            width: 30%;
            text-align: center;
        }
        .steps .step img {
            width: 50px;
            margin-bottom: 10px;
        }
        .steps .step p {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://yourlogo.com/logo.png" alt="Logo">
            <h1>Detalhes Agendamento</h1>
        </div>
        <div class="content">
            <h2>Olá {{ $nomeCliente }},</h2>
            <p>Seu agendamento foi realizado com sucesso. Aqui estão os detalhes:</p>
            <div class="details">
                <p><strong>Serviço:</strong> {{ $nomeServico }}</p>
                <p><strong>Preço:</strong> R$ {{ number_format($precoServico, 2, ',', '.') }}</p>
                <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($dataAgendamento)->format('d/m/Y') }}</p>
                <p><strong>Horário:</strong> {{ $horario }}</p>
                <p><strong>Funcionário:</strong> {{ $nomeFuncionario }}</p>
            </div>
            <div class="cta">
                <a href="https://yourwebsite.com">Visite nosso site</a>
            </div>
            <div class="steps">
                <div class="step">
                    <img src="https://yourwebsite.com/step1.png" alt="Step 1">
                    <p>Solicite a viagem</p>
                </div>
                <div class="step">
                    <img src="https://yourwebsite.com/step2.png" alt="Step 2">
                    <p>Encontre seu motorista</p>
                </div>
                <div class="step">
                    <img src="https://yourwebsite.com/step3.png" alt="Step 3">
                    <p>E só sair</p>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Seu Salão. Todos os direitos reservados.</p>
            <p>Visite a nossa <a href="https://yourwebsite.com/support">página de suporte</a> para mais informações.</p>
        </div>
    </div>
</body>
</html>
