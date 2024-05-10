@extends('site.dashboard.dashboardLayout.layout')

<title>Cliente - Agendar </title>

@section('dash')

    <!DOCTYPE html>
    <html>

    <head>
        <title>Agendamento de Horários</title>
        {{-- <link rel="stylesheet" href="{{ asset('dash/css/agenda.css') }}" /> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <style>
            input {}

            h1 {
                color: #59848e;
            }

            .funcionario {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }

            .info {
                display: flex;
                flex-direction: column;
                margin-right: 20px;
                background-color: #59848e;
                border-radius: 5px;
                padding: 15px;
                width: 20%;
            }

            .info img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                margin: auto;
            }

            .horarios {
                display: flex;
                flex-wrap: wrap;
                /* Adiciona quebra de linha */
            }


            .horario {
                border: 1px solid #59848e;
                border-radius: 5px;
                padding: 10px;
                margin-right: 10px;
                flex-basis: calc(20% - 10px);
                /* Define a largura para 50% - margem */
                margin-bottom: 10px;
                /* Espaçamento inferior */
                color: #59848e;
                text-align: center;
                cursor: pointer;

            }

            .horario:hover {
                color: #fff;
                background-color: #59848e;
            }

            .div-mae {
                display: flex;
                flex-direction: column;
            }

            label,
            input {
                margin: 10px 0;
            }
        </style>


        <div class="div-mae">
            <div class="container" style="width: 50% !important">
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

                        <label for="servico">Selecione o Serviço</label>
                        <select name="servico" id="servico">
                            <option value="">Selecione...</option>
                            <option value="servico"></option>
                        </select>

                        <div class="data">
                            <label for="date">Selecione a Data:</label>
                            <input type="date" placeholder="Data: DD/MM/AAAA" />
                        </div>

                        <div class="funcionario">
                            <div class="info">
                                <img src="maria.jpg" alt="Maria Souza" />
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


                    </div>


                    <button class="agendar-btn" type="submit">Agendar</button>
                </form>
            </div>
        </div>
        {{-- <script src="{{ asset('dash/js/agenda.js') }}"></script> --}}

        {{-- <script>
            $(document).ready(function() {
                $('#especialidade').change(function() {
                    var especialidadeSelecionada = $(this).val();

                    // Verifica se uma especialidade foi selecionada
                    if (especialidadeSelecionada) {
                        // Envia uma solicitação AJAX para listar os serviços correspondentes à especialidade selecionada
                        $.ajax({
                            url: "{{ route('listarServicos') }}",
                            method: 'GET',
                            data: { especialidade: especialidadeSelecionada },
                            success: function(data) {
                                // Limpa o dropdown de serviços
                                $('#servico').empty();
                                // Adiciona a opção padrão
                                $('#servico').append($('<option>', { value: '', text: 'Selecione...' }));
                                // Preenche o dropdown com os serviços retornados
                                $.each(data, function(index, servico) {
                                    $('#servico').append($('<option>', { value: servico.id, text: servico.nome }));
                                });
                            }
                        });
                    }
                });
            });
        </script> --}}
        {{-- ESSE SCRIPT FUNCIONA PORÉM NÃO LISTA --}}

        <script>
            $(document).ready(function() {
                $('#especialidade').change(function() {
                    var especialidadeSelecionada = $(this).val();

                    // Verifica se uma especialidade foi selecionada
                    if (especialidadeSelecionada) {
                        // Envia uma solicitação AJAX para listar os serviços correspondentes à especialidade selecionada
                        $.ajax({
                            url: "{{ route('listarServicos') }}",
                            method: 'GET',
                            data: {
                                especialidade: especialidadeSelecionada
                            },
                            success: function(data) {
                                // Limpa o dropdown de serviços
                                $('#servico').empty();
                                // Adiciona a opção padrão
                                $('#servico').append($('<option>', {
                                    value: '',
                                    text: 'Selecione...'
                                }));
                                // Preenche o dropdown com os serviços retornados
                                $.each(data, function(index, servico) {
                                    // Cria uma string com os dados desejados
                                    var optionText = servico.nomeServico + ' - ' + servico
                                        .duracaoServico + ' - ' + servico.valorServico;
                                    // Adiciona a opção ao dropdown
                                    $('#servico').append($('<option>', {
                                        value: servico.id,
                                        text: optionText
                                    }));
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error); // Log de erro no console
                            }
                        });
                    }
                });
            });
        </script>

    </body>

    </html>
    {{-- @endsection --}}
