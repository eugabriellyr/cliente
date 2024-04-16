<!-- resources/views/agendamento/listar_categorias.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Categorias</title>
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

        <!-- Input para exibir o Datepicker -->
        <input type="text" id="datepicker" name="data_agendamento">

        <button type="submit">Avançar</button>
    </form>
</body>



</html>


