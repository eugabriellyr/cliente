@extends('site.dashboard.dashboardLayout.layout')

<title>Cliente - Agendar </title>

@section('dash-cliente')

<head>
    <title>Agendamento de Horários</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #e6e9f0 0%, #eef1f5 100%);
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h1 {
            color: #324b5c;
            text-align: center;
        }

        .info,
        .horario {
            background-color: #ffffff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .horario {
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s;
            padding: 10px;
            text-align: center;
        }

        .horario:hover {
            transform: translateY(-2px);
            background-color: #59848e;
            color: #ffffff;
        }

        .agendar-btn {
            background: linear-gradient(to right, #59848e, #416f7a);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s, transform 0.2s;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .agendar-btn:hover {
            background: linear-gradient(to right, #416f7a, #324b5c);
            transform: translateY(-2px);
        }

        input[type="date"],
        select {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        input[type="date"]:hover,
        select:hover {
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .acordeao .acordeao-item {
            border: 1px solid #59848e;
            margin: 10px 0;
            border-radius: 5px;
            transition: box-shadow 0.3s;
            background-color: #ffffff;
            padding: 10px;
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

        /* ESTILIZAÇÃO CALENDÁRIO */
        .flatpickr-calendar {
            background-color: #ffffff;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .flatpickr-months {
            background-color: #59848e;
            color: #ffffff;
        }

        .flatpickr-weekday {
            color: #59848e;
            font-weight: bold;
        }

        .flatpickr-day {
            border-radius: 50%;
            color: #59848e;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background-color: #59848e;
            color: #ffffff;
            border: none;
        }

        .flatpickr-day:hover {
            background-color: #e4b48d;
            color: #ffffff;
        }

        .flatpickr-day.disabled,
        .flatpickr-day.disabled.in-range,
        .flatpickr-day.disabled.out-of-range,
        .flatpickr-day.disabled:hover {
            color: rgba(89, 132, 142, 0.205);
            cursor: not-allowed;
        }

        .flatpickr-prev-month,
        .flatpickr-next-month {
            color: #ffffff;
        }

        .flatpickr-monthDropdown-months,
        .flatpickr-current-month {
            background-color: #59848e;
            color: #ffffff;
        }

        .flatpickr-day.today {
            border: 1px solid #59848e;
            color: #ffffff;
        }

        .flatpickr-current-month .numInputWrapper input[type="number"] {
            color: #ffffff;
        }

        /* Select Meses */
        .flatpickr-current-month .flatpickr-monthDropdown-months option {
            background-color: black;
            color: #ffffff;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months option:hover {
            background-color: #416f7a;
            color: #ffffff;
        }

        /* Setas  */
        .flatpickr-months .flatpickr-prev-month.flatpickr-next-month,
        .flatpickr-months .flatpickr-next-month.flatpickr-next-month {
            fill: #ffffff;
        }

        .flatpickr-months .flatpickr-prev-month.flatpickr-prev-month {
            fill: #ffffff;
        }

        /* Estilo Serviço selecionado */
        .acordeao .acordeao-item.selected {
            background-color: #59848e;
            color: #ffffff;
        }

        #horariosContainer {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            flex-wrap: wrap;
        }

        /* Horários */
        .funcionario {
            display: flex;
            align-items: flex-start;
            margin: 15px 0;
            cursor: pointer;
            transition: background-color 0.3s;
            position: relative;
            flex-direction: column;
            align-items: center;
            width: 45%;
        }

        .funcionario:hover {
            background-color: #f0f0f0;
        }

        .cartao {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            width: 100%;
            margin-bottom: 10px;
            transition: margin 0.3s;
        }

        .horarios {
            display: flex;
            flex-wrap: wrap;
            background-color: #ffffff;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
            max-height: 260px;
            overflow-y: auto;
            justify-content: center;
        }

        .horario {
            margin: 5px;
            width: 45%;
        }

        .horario input[type="radio"] {
            display: none;
        }

        .horario label {
            border: 1px solid #e4b48d;
            border-radius: 20px;
            padding: 3px 10px;
            color: #e4b48d;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            display: inline-block;
        }

        .horario input[type="radio"]:checked+label {
            background-color: #e4b48d;
            color: white;
        }

        .reservar {
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 10px 20px;
            margin-left: 20px;
            cursor: pointer;
        }

        /* Responsividade */
        @media (max-width: 1200px) {
            .funcionario {
                flex-direction: column;
                align-items: center;
            }

            .cartao {
                width: 100%;
                margin-right: 0;
            }

            .horarios {
                position: static;
                width: 100%;
                margin-top: 10px;
                justify-content: center;
            }

            .horario {
                margin: 5px;
                width: 45%;
            }
        }

        @media (max-width: 900px) {
            .funcionario {
                flex-direction: column;
                align-items: center;
            }

            .cartao {
                width: 100%;
                margin-right: 0;
            }

            .horarios {
                position: static;
                width: 100%;
                margin-top: 10px;
                justify-content: center;
            }

            .horario {
                margin: 5px;
                width: 45%;
            }
        }

        @media (max-width: 768px) {
            #horariosContainer {
                display: flex;
                width: 100%;
                flex-direction: column;
                align-items: center;
            }

            .funcionario {
                flex-direction: column;
                align-items: center;
                width: 95%;
            }

            .cartao {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }

            .horarios {
                position: static;
                width: 100%;
                margin-top: 10px;
            }

            .horario {
                width: 45% !important;
                margin: 5px;
            }
        }

        @media (max-width: 600px) {
            .funcionario {
                flex-direction: column;
                align-items: center;
            }

            .cartao {
                width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }

            .horarios {
                position: static;
                width: 100%;
                margin-top: 10px;
            }

            .horario {
                width: 100%;
                margin: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Agendamento</h1>
        <form action="{{ route('agendar') }}" method="POST">
            @csrf
            <label for="especialidade">Categoria Serviço</label>
            <select name="especialidade" id="especialidade" required>
                <option value="">Selecione...</option>
                @foreach ($especialidades as $especialidade)
                <option value="{{ $especialidade->especialidade }}">{{ $especialidade->especialidade }}</option>
                @endforeach
            </select>

            <input type="hidden" name="idCliente" value="{{$cliente->idCliente }}">
            <input type="hidden" name="idFuncionario" id="idFuncionario">
            <input type="hidden" name="idServico" id="idServico">

            <div id="servicosAcordeao" class="acordeao"></div>

            <div id="calendarioContainer">
                <label for="data">Selecione uma data:</label>
                <input type="text" id="data" name="data" required>
            </div>

            <div id="horariosContainer">
                <!-- Horários disponíveis serão inseridos aqui -->
            </div>

            <button class="agendar-btn" type="submit">Agendar</button>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script>
        $(document).ready(function() {
    // Carregar serviços e definir `idServico` e `idFuncionario`
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
                    $('#servicosAcordeao').empty();
                    $.each(data, function(index, servico) {
                        var acordeaoItem = $('<div class="acordeao-item"></div>');
                        var header = $('<div class="acordeao-item-header" data-tipo-servico="' + servico.idServico + '">' + servico.nomeServico + '</div>');
                        var body = $('<div class="acordeao-item-body" style="display: none;">Duração: ' + servico.duracaoServico + ' minutos<br>Preço: R$' + servico.valorServico + '</div>');
                        acordeaoItem.append(header, body);
                        $('#servicosAcordeao').append(acordeaoItem);

                        header.click(function() {
                            var itemBody = $(this).next('.acordeao-item-body');
                            if (itemBody.is(':visible')) {
                                itemBody.slideUp();
                            } else {
                                $('#servicosAcordeao .acordeao-item-body').slideUp();
                                itemBody.slideDown();
                            }
                            $('#servicosAcordeao .acordeao-item').removeClass('selected');
                            acordeaoItem.addClass('selected');

                            $('#idServico').val($(this).data('tipo-servico'));

                            var tipoServicoSelecionado = $(this).data('tipo-servico');
                            var dataSelecionada = $('#data').val();
                            carregarHorariosDisponiveis(especialidadeSelecionada, tipoServicoSelecionado, dataSelecionada);
                        });
                    });
                },
                error: function() {
                    console.error("Erro ao carregar os serviços");
                }
            });
        }
    });

    // Função para carregar horários disponíveis
    function carregarHorariosDisponiveis(especialidade, tipoServico, data) {
        if (especialidade && tipoServico && data) {
            $.ajax({
                url: "{{ route('listarHorarios') }}",
                method: 'GET',
                data: {
                    especialidade: especialidade,
                    tipoServico: tipoServico,
                    data: data
                },
                success: function(data) {
                    $('#horariosContainer').empty();
                    var funcionarios = {};

                    // Agrupar horários por funcionário
                    data.forEach(function(horario) {
                        if (!funcionarios[horario.idFuncionario]) {
                            funcionarios[horario.idFuncionario] = {
                                nome: horario.nomeFuncionario,
                                cargo: horario.cargoFuncionario,
                                horarios: []
                            };
                        }
                        funcionarios[horario.idFuncionario].horarios.push(horario.horario);
                    });

                    // Criar cartões para cada funcionário
                    $.each(funcionarios, function(id, funcionario) {
                        var card = $('<div class="funcionario"></div>');
                        var info = $('<div class="cartao"><div class="nome">' + funcionario.nome + '</div><div class="funcao">' + funcionario.cargo + '</div></div>');
                        var horariosDiv = $('<div class="horarios" style="display: none;"></div>');
                        funcionario.horarios.forEach(function(horario, index) {
                            var horarioItem = $('<div class="horario"><input type="radio" id="horario-' + id + '-' + index + '" name="horario" value="' + horario + '" data-id-funcionario="' + id + '"><label for="horario-' + id + '-' + index + '">' + horario + '</label></div>');
                            horariosDiv.append(horarioItem);
                        });
                        card.append(info).append(horariosDiv);
                        $('#horariosContainer').append(card);

                        card.click(function() {
                            if (horariosDiv.is(':visible')) {
                                horariosDiv.slideUp();
                            } else {
                                $('#horariosContainer .horarios').slideUp();
                                horariosDiv.slideDown();
                            }
                        });
                    });

                    // Definir `idFuncionario` quando um horário é selecionado
                    $('input[name="horario"]').change(function() {
                        var idFuncionario = $(this).data('id-funcionario');
                        $('#idFuncionario').val(idFuncionario);
                    });
                },
                error: function() {
                    console.error("Erro ao carregar os horários");
                }
            });
        }
    }

    // Inicializar o calendário
    function getMaxDate() {
        var today = new Date();
        var maxDate = new Date();
        maxDate.setMonth(today.getMonth() + 3);
        return maxDate;
    }

    flatpickr("#data", {
        locale: "pt",
        enableTime: false,
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F, Y",
        minDate: "today",
        maxDate: getMaxDate(),
        disable: [function(date) {
            return (date.getDay() === 0);
        }],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            if (dayElem.dateObj.getDay() === 0) {
                dayElem.classList.add('disabled');
            }
            const today = new Date();
            const maxDate = new Date();
            maxDate.setMonth(today.getMonth() + 3);
            if (dayElem.dateObj < today || dayElem.dateObj > maxDate) {
                dayElem.classList.add('disabled', 'out-of-range');
            }
        },
        onChange: function(selectedDates, dateStr, instance) {
            var especialidadeSelecionada = $('#especialidade').val();
            var tipoServicoSelecionado = $('.acordeao-item.selected .acordeao-item-header').data('tipo-servico');
            carregarHorariosDisponiveis(especialidadeSelecionada, tipoServicoSelecionado, dateStr);
        }
    });
});

    </script>
</body>
@endsection
