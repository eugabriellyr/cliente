@extends('site.dashboard.dashboardLayout.layout')

<title>Cliente - Agendar </title>

@section('dash')
    <!DOCTYPE html>
    <html>

    <head>
        <title>Agendamento de Horários</title>
        <link rel="stylesheet" href="{{ asset('dash/css/agenda.css') }}" />

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
        </style>


        <div class="div-mae">
            <div class="container" style="width: 100% !important">
                <h1>Agendamento</h1>
                <form id="appointmentForm">
                    <label for="categoria">Categoria Serviço</label>
                    <select name="categoria" id="categoria">
                        <option value="">Selecione...</option>
                        <option value="teste"></option>
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

                    <label for="servico">Selecione o Serviço</label>
                    <input type="tel" id="servico" required />

                    <button class="agendar-btn" type="submit">Agendar</button>
                </form>
            </div>
        </div>
        {{-- <script src="{{ asset('dash/js/agenda.js') }}"></script> --}}

        <script>
            $.fn.calendario = function() {

                var userLang = String(navigator.language || navigator.userLanguage);
                console.log(userLang);
                var mesEX = {
                    "pt-BR": [
                        "",
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro",
                    ],
                    "eng-US": [
                        "",
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                };
                var mesExtenso = mesEX[String(userLang)];
                var diasDaSemanaAbreviaturas = [
                    "dom",
                    "seg",
                    "ter",
                    "qua",
                    "qui",
                    "sex",
                    "sab",
                ];
                var lista = this;
                var nInstancias = 0;
                var montaCabecalho = function(id, ano, mes) {
                    var html = '<tbody id="mgCalendarioCabecalho_' + id + '">';
                    html +=
                        '<tr><td>&#9668;</td><td colspan="5" id="mgCalendarioAno_' +
                        id +
                        '" >' +
                        ano +
                        "</td><td>&#9658;</td></tr>";
                    html +=
                        '<tr><td>&#9668;</td><td colspan="5" id="mgCalendarioMes_' +
                        id +
                        '" >' +
                        mesExtenso[mes] +
                        "</td><td>&#9658;</td></tr>";
                    html += "</tbody>";
                    html += "<tbody><tr>";
                    $.each(diasDaSemanaAbreviaturas, function() {
                        html += "<td>" + this + "</td>";
                    });
                    html += "</tr></tbody>";

                    return html;
                };
                var montaMes = function(
                    id,
                    anoExibir,
                    mesExibir,
                    anoSelecionado,
                    mesSelecionado,
                    diaSelecionado
                ) {
                    var dp = new Date(anoExibir, mesExibir - 1, 1);
                    var du = new Date(anoExibir, mesExibir, 0);
                    var da = new Date(anoExibir, mesExibir - 1, 0);
                    var mesSel =
                        anoExibir === anoSelecionado && mesExibir === mesSelecionado ?
                        true :
                        false;
                    var pMes = mesExibir < 10 ? "0" + mesExibir : mesExibir;
                    var pDate = anoExibir + "-" + pMes;

                    var ultimoDiaMesAnterior = da.getDate();
                    var primeiroDiaDeSemana = dp.getDay();
                    var ultimoDia = du.getDate();
                    var html = "";
                    html += "<tr>";
                    var i = 0;
                    var col = 0;
                    var primeiroMostrado = ultimoDiaMesAnterior - primeiroDiaDeSemana + 1;

                    var dataAtual = new Date();
                    var anoAtual = dataAtual.getFullYear();
                    var mesAtual = dataAtual.getMonth() + 1;
                    var diaAtual = dataAtual.getDate();

                    // Limitando o calendário ao ano atual e aos próximos 4 meses
                    if (
                        anoExibir < anoAtual ||
                        (anoExibir === anoAtual && mesExibir < mesAtual)
                    ) {
                        return ""; // Retorna uma string vazia se o mês for anterior ao mês atual
                    }
                    if (
                        anoExibir > anoAtual ||
                        (anoExibir === anoAtual && mesExibir > mesAtual + 3)
                    ) {
                        return ""; // Retorna uma string vazia se o mês estiver além dos próximos 4 meses
                    }

                    for (i = 0; i < primeiroDiaDeSemana; i++) {
                        html += '<td class="mgVazio">' + primeiroMostrado + "</td>";
                        primeiroMostrado++;
                        if (i === 6) {
                            html += "</tr>";
                            i = 0;
                        }
                    }
                    var diaMes = 1;
                    while (diaMes <= ultimoDia) {
                        if (i === 0) {
                            html += "<tr>";
                        }
                        var extraClass =
                            mesSel && diaMes === diaSelecionado ? "mgDiaSelecionado" : "";
                        var mDia = diaMes < 10 ? "0" + diaMes : diaMes;
                        var mDate = pDate + "-" + mDia;

                        // Desativar dias anteriores à data atual
                        var dataComparacao = new Date(anoExibir, mesExibir - 1, diaMes);
                        if (dataComparacao < dataAtual) {
                            html += '<td class="mgDia mgDiaPassado">' + mDia + "</td>";
                        } else {
                            html +=
                                '<td class="mgDia ' +
                                extraClass +
                                '" data-date="' +
                                mDate +
                                '">' +
                                mDia +
                                "</td>";
                        }

                        if (i === 6) {
                            html += "</tr>";
                            i = 0;
                            col++;
                        } else {
                            i++;
                        }
                        diaMes++;
                        if (col >= 6) break; // Interrompe o loop se exceder 6 semanas
                        if (diaMes > ultimoDia) break; // Interrompe o loop se ultrapassar o último dia do mês
                    }
                    html += "</tr>";

                    return html;
                };

                var abre = function(el) {
                    nInstancias++;
                    var id = el.id === undefined || el.id === "" ? nInstancias : el.id;
                    var d = new Date(),
                        diaAtual = d.getDate(),
                        mesAtual = d.getMonth() + 1,
                        anoAtual = d.getFullYear();
                    var diaSelecionado = "",
                        mesSelecionado = "",
                        anoSelecionado = "";

                    if (el.value !== "") {
                        var daa = el.value.split("-");
                        var diaSelecionado = Number(daa[2]),
                            mesSelecionado = Number(daa[1]),
                            anoSelecionado = Number(daa[0]);
                        var mesExibir = mesSelecionado,
                            anoExibir = anoSelecionado;
                    } else {
                        var mesExibir = mesAtual,
                            anoExibir = anoAtual;
                    }
                    var html = "";
                    html +=
                        '<div id = "mgCalendarioBack_' +
                        id +
                        '" class="mgCalendarioBack"></div>';
                    html +=
                        '<div id = "mgCalendario_' + id + '" class="mgCalendario"><table>';
                    html += montaCabecalho(id, anoExibir, mesExibir);
                    html += '<tbody id="mgCalendarioMesEx_' + id + '">';
                    html += montaMes(
                        id,
                        anoExibir,
                        mesExibir,
                        anoSelecionado,
                        mesSelecionado,
                        diaSelecionado
                    );
                    html += "</tbody>";
                    html += "</table>";
                    html += '<div id="mgCalendarioBots_' + id + '">';
                    html +=
                        '<input type="button" value="ANULAR"/><input type="button" value="FECHAR"/>';
                    html += "</div>";
                    html += "</div>";
                    $("body").append(html);

                    $("#mgCalendarioBack_" + id).on("click", function() {
                        fecha(id);
                    });

                    $(
                        "#mgCalendarioCabecalho_" + id + " tr:nth-child(1) td:nth-child(1)"
                    ).on("click", function() {
                        anoExibir--;
                        mudaAno(
                            id,
                            anoExibir,
                            mesExibir,
                            anoSelecionado,
                            mesSelecionado,
                            diaSelecionado,
                            "menor"
                        );
                    });
                    $(
                        "#mgCalendarioCabecalho_" + id + " tr:nth-child(1) td:nth-child(3)"
                    ).on("click", function() {
                        anoExibir++;
                        mudaAno(
                            id,
                            anoExibir,
                            mesExibir,
                            anoSelecionado,
                            mesSelecionado,
                            diaSelecionado,
                            "maior"
                        );
                    });
                    $(
                        "#mgCalendarioCabecalho_" + id + " tr:nth-child(2) td:nth-child(1)"
                    ).on("click", function() {
                        if (mesExibir === 1) {
                            mesExibir = 12;
                            anoExibir--;
                        } else {
                            mesExibir--;
                        }
                        mudaAno(
                            id,
                            anoExibir,
                            mesExibir,
                            anoSelecionado,
                            mesSelecionado,
                            diaSelecionado,
                            "menor"
                        );
                    });
                    $(
                        "#mgCalendarioCabecalho_" + id + " tr:nth-child(2) td:nth-child(3)"
                    ).on("click", function() {
                        if (mesExibir === 12) {
                            mesExibir = 1;
                            anoExibir++;
                        } else {
                            mesExibir++;
                        }
                        mudaAno(
                            id,
                            anoExibir,
                            mesExibir,
                            anoSelecionado,
                            mesSelecionado,
                            diaSelecionado,
                            "maior"
                        );
                    });
                    $("body").delegate(".mgDia", "click", function() {
                        el.value = $(this).data("date");
                        fecha(id);
                    });
                    $("body").delegate(
                        "#mgCalendarioBots_" + id + " input:nth-child(1)",
                        "click",
                        function() {
                            el.value = "";
                            fecha(id);
                        }
                    );
                    $("body").delegate(
                        "#mgCalendarioBots_" + id + " input:nth-child(2)",
                        "click",
                        function() {
                            fecha(id);
                        }
                    );
                };

                var fecha = function(id) {
                    $("#mgCalendarioBack_" + id + ", " + "#mgCalendario_" + id).fadeOut(
                        "fast",
                        function() {
                            $(
                                "#mgCalendarioBack_" + id + ", " + "#mgCalendario_" + id
                            ).remove();
                        }
                    );
                };
                var mudaAno = function(
                    id,
                    ano,
                    mes,
                    anoSelecionado,
                    mesSelecionado,
                    diaSelecionado,
                    sentido
                ) {
                    var sentido1 = sentido === "maior" ? "-=50" : "+=50";
                    var topInter = sentido === "maior" ? "50px" : "-50px";
                    var elemento = $(
                        "#mgCalendario_" +
                        id +
                        " tbody:nth-child(1) tr:nth-child(1) td:nth-child(2)"
                    );
                    elemento.animate({
                        opacity: 0,
                        left: sentido1
                    }, 100, function() {
                        elemento.html(ano);
                        elemento.css("left", topInter);
                        elemento.animate({
                            opacity: 1,
                            left: 0
                        }, 100);
                    });

                    mudaMes(id, ano, mes, anoSelecionado, mesSelecionado, diaSelecionado);
                };
                var mudaMes = function(
                    id,
                    ano,
                    mes,
                    anoSelecionado,
                    mesSelecionado,
                    diaSelecionado
                ) {
                    $(
                        "#mgCalendario_" +
                        id +
                        " tbody:nth-child(1) tr:nth-child(2) td:nth-child(2)"
                    ).html(mesExtenso[mes]);
                    var html = montaMes(
                        id,
                        ano,
                        mes,
                        anoSelecionado,
                        mesSelecionado,
                        diaSelecionado
                    );
                    $("#mgCalendarioMesEx_" + id).html(html);
                };
                $("body").ready(function() {
                    $.each(lista, function() {
                        var el = this;
                        $(this).on("mouseup", function() {
                            abre(el);
                        });
                        if ($(this).attr("name") !== undefined) {
                            var label = $("label[for=" + $(this).attr("name") + "]");
                            label.on("mouseup", function() {
                                abre(el);
                            });
                        }
                    });
                });
            };
            $("body").ready(function() {
                $("input[type=date]").calendario();
            });
        </script>


    </body>

    </html>
@endsection
