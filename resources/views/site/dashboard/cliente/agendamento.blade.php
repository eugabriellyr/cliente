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
                width: 85%;
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
                /* background-color: rgba(224, 224, 224, 0.5); */
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
                /* Define a cor do texto preto */
            }

            /* Select Meses */
            .flatpickr-current-month .flatpickr-monthDropdown-months option {
                background-color: black;
                /* Fundo branco para opções */
                color: #ffffff;
                /* Cor do texto preto */
            }

            .flatpickr-current-month .flatpickr-monthDropdown-months option:hover {
                background-color: #416f7a;
                /* Fundo para opção ao passar o mouse */
                color: #ffffff;
                /* Cor do texto ao passar o mouse */
            }

            /* Setas  */
            .flatpickr-months .flatpickr-prev-month.flatpickr-next-month,
            .flatpickr-months .flatpickr-next-month.flatpickr-next-month {
                fill: #ffffff;
            }
            .flatpickr-months .flatpickr-prev-month.flatpickr-prev-month {
                fill: #ffffff;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Agendamento</h1>
            <form action="/agendamento/agendar" method="POST">
                @csrf
                <label for="especialidade">Categoria Serviço</label>
                <select name="especialidade" id="especialidade">
                    <option value="">Selecione...</option>
                    @foreach ($especialidades as $especialidade)
                        <option value="{{ $especialidade->especialidade }}">{{ $especialidade->especialidade }}
                        </option>
                    @endforeach
                </select>

                <div id="servicosAcordeao" class="acordeao"></div>

                <label for="data">Selecione uma data:</label>
                <input type="text" id="data" name="data">


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
                        <div class="horario">17:00</div>
                    </div>
                </div>

                <button class="agendar-btn" type="submit">Agendar</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                $('#servicosAcordeao').empty();
                                $.each(data, function(index, servico) {
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

            // Função para calcular a data máxima
            function getMaxDate() {
                var today = new Date();
                var maxDate = new Date();
                maxDate.setMonth(today.getMonth() + 3);
                return maxDate;
            }

            // Inicialize o flatpickr no campo de entrada com localidade em português e desabilitando domingos
            document.addEventListener("DOMContentLoaded", function() {
                flatpickr("#data", {
                    locale: "pt", // Define a localidade para português
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F, Y", // Exibindo dia e mês por extenso em português
                    minDate: "today", // Data mínima é hoje
                    maxDate: getMaxDate(), // Data máxima é 3 meses a partir de hoje
                    disable: [
                        function(date) {
                            // Desabilitar todos os domingos
                            return (date.getDay() === 0);
                        }
                    ],
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        // Adicionar uma classe personalizada para os domingos
                        if (dayElem.dateObj.getDay() === 0) {
                            dayElem.classList.add('disabled');
                        }
                        // Adicionar uma classe para datas fora do intervalo
                        const today = new Date();
                        const maxDate = new Date();
                        maxDate.setMonth(today.getMonth() + 3);
                        if (dayElem.dateObj < today || dayElem.dateObj > maxDate) {
                            dayElem.classList.add('disabled', 'out-of-range');
                        }
                    }
                });
            });
        </script>
    </body>
@endsection
