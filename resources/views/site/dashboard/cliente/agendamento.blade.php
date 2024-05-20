@extends('site.dashboard.dashboardLayout.layout')

<title>Cliente - Agendar </title>

@section('dash-cliente')

    <head>
        <title>Agendamento de Horários</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    </head>

    <body>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f4f4f4;
            }

            h1 {
                color: #324b5c;
            }

            .info {
                background-color: #ffffff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .horario {
                background-color: #ffffff;
                border: none;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .horario:hover {
                background-color: #59848e;
                color: #ffffff;
            }

            .agendar-btn {
                background-color: #59848e;
                color: #ffffff;
                border: none;
                border-radius: 20px;
                padding: 10px 20px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .agendar-btn:hover {
                background-color: #416f7a;
            }

            input,
            select {
                border-radius: 5px;
                border: 1px solid #ccc;
                padding: 10px;
                width: 100%;
            }

            .container {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .acordeao .acordeao-item {
                border: 1px solid #59848e;
                margin: 10px 0;
                border-radius: 5px;
                padding: 10px;
                margin-bottom: 10px;
                background-color: #ffffff;
            }

            .acordeao .acordeao-item-header {
                cursor: pointer;
                padding: 10px;
                font-weight: bold;
                color: #324b5c;
            }

            .acordeao .acordeao-item-body {
                display: none;
                padding: 20px;
                font-size: 14px;
                border-top: 1px solid #ddd;
            }

            .ui-datepicker {
    background: #f7f7f7;
    border: 1px solid #555;
    color: #333;
}

.ui-datepicker a {
    color: #666;
}

        </style>

        <div class="div-mae">
            <div class="container" style="width: 85% !important">
                <h1>Agendamento</h1>
                <form action="/agendamento/agendar" method="POST">
                    @csrf
                    <div class="div-mae">
                        <label for="especialidade">Categoria Serviço</label>
                        <select name="especialidade" id="especialidade">
                            <option value="">Selecione...</option>
                            @foreach ($especialidades as $especialidade)
                                <option value="{{ $especialidade->especialidade }}">{{ $especialidade->especialidade }}
                                </option>
                            @endforeach
                        </select>

                        {{-- <label for="servico">Selecione o Serviço</label>
                        <select name="servico" id="servico">
                            <option value="">Selecione...</option>
                        </select> --}}

                        <div id="servicosAcordeao" class="acordeao"></div>


                        <div class="data">
                            <label for="date">Selecione a Data:</label>
                            <input type="date" />
                        </div>

                        <input type="text" id="datepicker" placeholder="Data: DD/MM/AAAA">


                        <div class="funcionario">
                            <div class="info">
                                <img src="maria.jpg" alt="Maria Souza" style="width: 80px; height: 80px;" />
                                <h3 style="text-align: center;">Maria Souza</h3>
                            </div>
                            <div class="horarios">
                                <div class="horario">09:00</div>
                                <div class="horario">11:00</div>
                                <div class="horario">15:00</div>
                                <div class="horario">17:00</div>
                                <div class="horario">09:00</div>
                                <div class="horario">11:00</div>
                                <div class="horario">15:00</div>
                                <div the "horario">17:00</div>
                            </div>
                        </div>

                    </div>

                    <button class="agendar-btn" type="submit">Agendar</button>
                </form>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                $('#especialidade').change(function() {
                    var especialidadeSelecionada = $(this).val();
                    if (especialidadeSelecionada) {
                        $.ajax({
                            url: "{{ route('listarServicos') }}",
                            method: 'GET',
                            data: {
                                especialidade: especialidadeSelecionada
                            },
                            success: function(data) {
                                $('#servicosAcordeao').empty(); // Limpa o acordeão
                                $.each(data, function(index, servico) {
                                    // Monta a estrutura do acordeão com os dados dos serviços
                                    var acordeaoItem = $(
                                        '<div class="acordeao-item"></div>');
                                    var header = $('<div class="acordeao-item-header">' +
                                        servico.nomeServico + '</div>');
                                    var body = $('<div class="acordeao-item-body">' +
                                        'Duração: ' + servico.duracaoServico +
                                        ' minutos<br>' +
                                        'Preço: R$' + servico.valorServico + '</div>');
                                    acordeaoItem.append(header, body);
                                    $('#servicosAcordeao').append(acordeaoItem);

                                    // Adiciona funcionalidade de acordeão
                                    header.click(function() {
                                        var itemBody = $(this).next(
                                            '.acordeao-item-body');
                                        if (itemBody.is(':visible')) {
                                            itemBody.slideUp();
                                        } else {
                                            $('.acordeao-item-body').slideUp();
                                            itemBody.slideDown();
                                        }
                                    });
                                });
                            },
                            error: function() {
                                console.error("Erro ao carregar os serviços");
                            }
                        });
                    }
                });
            });

            // Calendário
            $(document).ready(function() {
    $("#datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        dayNames: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
        dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        showOtherMonths: true,
        selectOtherMonths: true
    });
});

        </script>
    </body>
@endsection
