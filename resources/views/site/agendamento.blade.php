<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Categorias</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #form {
            position: absolute;
            box-sizing: border-box;
            top: 50%;
            left: 50%;
            padding: 50px;
            margin: 0;
            text-align: center;
            transform: translate(-50%, -50%);
        }

        #form h1 {
            font-size: 45px;
            font-family: Verdana, Arial;
            margin-bottom: 20px;
        }

        input[type=date] {
            padding: 20px;
            font-size: 24px;
            text-align: center;
            border-style: none;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.3);
        }

        ::-webkit-inner-spin-button {
            display: none;
        }

        ::-webkit-calendar-picker-indicator {
            display: none;
        }
    </style>


    <style>
        .mgCalendarioBack {
            /* position: fixed; */
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 9999;
        }

        .mgCalendario {
            position: fixed;
            display: block;
            top: 50%;
            left: 50%;
            width: 100%;
            max-width: 350px;
            height: 430px;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            margin: 0;
            font-family: Verdana, Arial;
            padding: 5px;
            background-color: #fff;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.7);
            z-index: 10000;
        }

        .mgCalendario * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .mgCalendario table {
            width: 100%;
            text-align: center;
            border-spacing: 0;
        }

        .mgCalendario tbody:nth-child(1) td {
            position: relative;
            padding: 5px;
            text-align: center;
        }

        .mgCalendario tbody:nth-child(1) td:nth-child(1n) {
            cursor: pointer;
        }

        .mgCalendario tbody:nth-child(1) td:nth-child(2) {
            cursor: default;
        }

        .mgCalendario tbody:nth-child(2) td {
            width: 14.2%;
            padding: 10px 5px;
            text-align: center;
            cursor: default;
        }

        .mgCalendario tbody:nth-child(3) td {
            height: 45px;
            border: 0 none;
            text-align: center;
        }

        .mgVazio {
            background-color: #f3f3f3;
            color: #aaa;
        }

        .mgDia {
            border-radius: 50%;
            cursor: pointer;
        }

        .mgDia:hover {
            background-color: #8aaad5;
            transform: scale(1.2, 1.2);
            transition: transform 0.2s;
        }

        .mgDia:nth-child(6n+1):hover {
            background-color: orange;
        }

        .mgDiaHoje {
            background-color: #ecea78;
        }

        .mgDiaSelecionado {
            background-color: #8aaad5;
        }

        .mgCalendario>div button {
            display: inline-block;
            width: 33.33%;
            height: 50px;
            line-height: 50px;
            margin: 6px 0;
            font-size: 1.1em;
            border: 0 none transparent;
            background-color: transparent;
            background-image: none;
            cursor: pointer;
        }

        .mgCalendario>div button:hover {
            background-color: #8aaad5;
        }

        .mgCalendario>div:nth-child(2) {
            margin: 0 auto;
            padding: 5px;
            text-align: center;
        }

        .mgCalendario>div:nth-child(2) input[type=button] {
            width: 35%;
            min-width: 110px;
            padding: 10px;
            margin: 5px 5%;
            background-color: #8aaad5;
            background-image: none;
            text-shadow: none;
            border: 0 none transparent;
            border-radius: 2px;
            cursor: pointer;
        }

        .mgCalendario>div:nth-child(2) input[type=button]:hover {
            transform: scale(1.1, 1.1);
            transition: transform 0.2s;
        }

        .mgCalendario>div:nth-child(2) input[type=button]:focus {
            outline: 0 none;
        }
        /*# sourceMappingURL=style.css.map */
    </style>
</head>
<body>
        <h1>Selecione a Categoria do Serviço</h1>
        <form action="/agendamento/agendar" method="POST">
            @csrf
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria">
                <option value="">Selecione...</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->tipoServico }}">{{ $categoria->tipoServico }}</option>
                @endforeach
            </select>

            {{-- <div id='form'><h1>Input Date</h1> --}}
            <input type="date" />
            {{-- </div> --}}

            <!-- Input para exibir o Datepicker -->
            <input type="text" id="datepicker" name="data_agendamento">

            <button type="submit">Avançar</button>
        </form>

    <script>
        $.fn.serializeObject = function() {

            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
        $.fn.confirmaobrigatorio = function() {
            var status = 1;
            $.each(this, function() {
                if ($(this).hasClass('obrigatorio')) {
                    if ($(this).val() === '') {
                        $(this).addClass('erro');
                        status = 0;
                    } else {
                        $(this).removeClass('erro');
                    }
                }
            });

            return status;

        };

        $.fn.calendario = function() {
            var userLang = String(navigator.language || navigator.userLanguage);
            console.log(userLang);
            var mesEX = {
                'pt-BR': ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ],
                'eng-US': ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                    'September', 'October', 'November', 'December'
                ]
            };
            var mesExtenso = mesEX[String(userLang)];
            var diasDaSemanaAbreviaturas = ['dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab'];
            var lista = this;
            var nInstancias = 0;
            var montaCabecalho = function(id, ano, mes) {
                var html = '<tbody id="mgCalendarioCabecalho_' + id + '">';
                html += '<tr><td>&#9668;</td><td colspan="5" id="mgCalendarioAno_' + id + '" >' + ano +
                    '</td><td>&#9658;</td></tr>';
                html += '<tr><td>&#9668;</td><td colspan="5" id="mgCalendarioMes_' + id + '" >' + mesExtenso[mes] +
                    '</td><td>&#9658;</td></tr>';
                html += '</tbody>';
                html += '<tbody><tr>';
                $.each(diasDaSemanaAbreviaturas, function() {
                    html += '<td>' + this + '</td>';
                });
                html += '</tr></tbody>';

                return html;
            };
            var montaMes = function(id, anoExibir, mesExibir, anoSelecionado, mesSelecionado, diaSelecionado) {
                var dp = new Date(anoExibir, mesExibir - 1, 1);
                var du = new Date(anoExibir, mesExibir, 0);
                var da = new Date(anoExibir, mesExibir - 1, 0);
                var mesSel = (anoExibir === anoSelecionado && mesExibir === mesSelecionado) ? true : false;
                var pMes = (mesExibir < 10) ? '0' + mesExibir : mesExibir;
                var pDate = anoExibir + '-' + pMes;

                var ultimoDiaMesAnterior = da.getDate();
                var primeiroDiaDeSemana = dp.getDay();
                var ultimoDia = du.getDate();
                var html = '';
                html += '<tr>';
                var i = 0;
                var col = 0;
                var primeiroMostrado = ultimoDiaMesAnterior - primeiroDiaDeSemana + 1;
                for (i = 0; i < primeiroDiaDeSemana; i++) {
                    html += '<td class="mgVazio">' + primeiroMostrado + '</td>';
                    primeiroMostrado++;
                    if (i === 6) {
                        html += '</tr>';
                        i = 0;
                    }
                }
                var diaMes = 1;
                while (diaMes <= ultimoDia) {
                    if (i === 0) {
                        html += '<tr>';

                    }
                    var extraClass = (mesSel && diaMes === diaSelecionado) ? 'mgDiaSelecionado' : '';

                    var mDia = (diaMes < 10) ? '0' + diaMes : diaMes;
                    var mDate = pDate + '-' + mDia;
                    html += '<td class="mgDia ' + extraClass + '" data-date="' + mDate + '">' + mDia + '</td>';
                    if (i === 6) {
                        html += '</tr>';
                        i = 0;
                        col++;
                    } else {
                        i++;
                    }
                    diaMes++;
                }
                var iComp = 1;
                while (col <= 5) {
                    if (i === 0) {
                        html += '<tr>';

                    }
                    var mDia = (iComp < 10) ? '0' + iComp : iComp;

                    html += '<td class="mgVazio">' + mDia + '</td>';
                    if (i === 6) {
                        html += '</tr>';
                        i = 0;
                        col++;
                    } else {
                        i++;
                    }
                    iComp++;
                }
                html += '';

                return html;
            };
            var abre = function(el) {
                nInstancias++;
                var id = (el.id === undefined || el.id === '') ? nInstancias : el.id;
                var d = new Date(),
                    diaAtual = d.getDate(),
                    mesAtual = d.getMonth() + 1,
                    anoAtual = d.getFullYear();
                var diaSelecionado = '',
                    mesSelecionado = '',
                    anoSelecionado = '';

                if (el.value !== '') {
                    var daa = el.value.split('-');
                    var diaSelecionado = Number(daa[2]),
                        mesSelecionado = Number(daa[1]),
                        anoSelecionado = Number(daa[0]);
                    var mesExibir = mesSelecionado,
                        anoExibir = anoSelecionado;
                } else {
                    var mesExibir = mesAtual,
                        anoExibir = anoAtual;
                }
                var html = '';
                html += '<div id = "mgCalendarioBack_' + id + '" class="mgCalendarioBack"></div>';
                html += '<div id = "mgCalendario_' + id + '" class="mgCalendario"><table>';
                html += montaCabecalho(id, anoExibir, mesExibir);
                html += '<tbody id="mgCalendarioMesEx_' + id + '">';
                html += montaMes(id, anoExibir, mesExibir, anoSelecionado, mesSelecionado, diaSelecionado);
                html += '</tbody>';
                html += '</table>';
                html += '<div id="mgCalendarioBots_' + id + '">';
                html += '<input type="button" value="ANULAR"/><input type="button" value="FECHAR"/>';
                html += '</div>';
                html += '</div>';
                $('body').append(html);

                $("#mgCalendarioBack_" + id).on("click", function() {
                    fecha(id);
                });

                $("#mgCalendarioCabecalho_" + id + ' tr:nth-child(1) td:nth-child(1)').on('click', function() {
                    anoExibir--;
                    mudaAno(id, anoExibir, mesExibir, anoSelecionado, mesSelecionado, diaSelecionado,
                        'menor');
                });
                $("#mgCalendarioCabecalho_" + id + ' tr:nth-child(1) td:nth-child(3)').on('click', function() {
                    anoExibir++;
                    mudaAno(id, anoExibir, mesExibir, anoSelecionado, mesSelecionado, diaSelecionado,
                        'maior');
                });
                $("#mgCalendarioCabecalho_" + id + ' tr:nth-child(2) td:nth-child(1)').on('click', function() {
                    if (mesExibir === 1) {
                        mesExibir = 12;
                        anoExibir--;
                    } else {
                        mesExibir--;
                    }
                    mudaAno(id, anoExibir, mesExibir, anoSelecionado, mesSelecionado, diaSelecionado,
                        'menor');
                });
                $("#mgCalendarioCabecalho_" + id + ' tr:nth-child(2) td:nth-child(3)').on('click', function() {
                    if (mesExibir === 12) {
                        mesExibir = 1;
                        anoExibir++;
                    } else {
                        mesExibir++;
                    }
                    mudaAno(id, anoExibir, mesExibir, anoSelecionado, mesSelecionado, diaSelecionado,
                        'maior');
                });
                $('body').delegate(".mgDia", "click", function() {
                    el.value = $(this).data('date');
                    fecha(id);
                });
                $('body').delegate("#mgCalendarioBots_" + id + " input:nth-child(1)", "click", function() {
                    el.value = '';
                    fecha(id);
                });
                $('body').delegate("#mgCalendarioBots_" + id + " input:nth-child(2)", "click", function() {
                    fecha(id);
                });

            };
            var fecha = function(id) {
                $("#mgCalendarioBack_" + id + ', ' + "#mgCalendario_" + id).fadeOut("fast", function() {
                    $("#mgCalendarioBack_" + id + ', ' + "#mgCalendario_" + id).remove();
                });
            };
            var mudaAno = function(id, ano, mes, anoSelecionado, mesSelecionado, diaSelecionado, sentido) {
                var sentido1 = (sentido === 'maior') ? '-=50' : '+=50';
                var topInter = (sentido === 'maior') ? '50px' : '-50px';
                var elemento = $("#mgCalendario_" + id + ' tbody:nth-child(1) tr:nth-child(1) td:nth-child(2)');
                elemento.animate({
                    opacity: 0,
                    left: sentido1
                }, 100, function() {
                    elemento.html(ano);
                    elemento.css('left', topInter);
                    elemento.animate({
                        opacity: 1,
                        left: 0
                    }, 100);
                });

                mudaMes(id, ano, mes, anoSelecionado, mesSelecionado, diaSelecionado);
            };
            var mudaMes = function(id, ano, mes, anoSelecionado, mesSelecionado, diaSelecionado) {
                $("#mgCalendario_" + id + ' tbody:nth-child(1) tr:nth-child(2) td:nth-child(2)').html(mesExtenso[
                    mes]);
                var html = montaMes(id, ano, mes, anoSelecionado, mesSelecionado, diaSelecionado);
                $("#mgCalendarioMesEx_" + id).html(html);
            };
            $('body').ready(function() {
                $.each(lista, function() {
                    var el = this;
                    $(this).on("mouseup", function() {
                        abre(el);
                    });
                    if ($(this).attr('name') !== undefined) {
                        var label = $('label[for=' + $(this).attr('name') + ']');
                        label.on("mouseup", function() {
                            abre(el);
                        });
                    }
                });

            });
        };
        $("body").ready(function() {
            $("input[type=date]").calendario();
        })
    </script>
</body>

</html>
