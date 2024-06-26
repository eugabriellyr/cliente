@extends('site.dashboard.dashboardLayout.layout')

@section('dashboard')
<div class="container">
    <h2>Editar Agendamento</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.funcionarios.updateH', $agendamento->idAgendamento) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dataAgendamento">Data do Agendamento:</label>
            <input type="date" name="dataAgendamento" class="form-control" value="{{ $agendamento->dataAgendamento }}">
        </div>
        <div class="form-group">
            <label for="categoriaAgendamento">Categoria:</label>
            <input type="text" name="categoriaAgendamento" class="form-control" value="{{ $agendamento->categoriaAgendamento }}">
        </div>
        <div class="form-group">
            <label for="data_hora_inicial">Data e Hora Inicial:</label>
            <input type="text" name="data_hora_inicial" class="form-control" value="{{ $agendamento->data_hora_inicial }}">
        </div>
        <div class="form-group">
            <label for="data_hora_final">Data e Hora Final:</label>
            <input type="text" name="data_hora_final" class="form-control" value="{{ $agendamento->data_hora_final }}">
        </div>
        <div class="form-group">
            <label for="statusAgendamento">Status:</label>
            <input type="text" name="statusAgendamento" class="form-control" value="{{ $agendamento->statusAgendamento }}">
        </div>
        <div class="form-group">
            <label for="idCliente">ID do Cliente:</label>
            <input type="text" name="idCliente" class="form-control" value="{{ $agendamento->idCliente }}">
        </div>
        <div class="form-group">
            <label for="idFuncionario">ID do Funcionário:</label>
            <input type="text" name="idFuncionario" class="form-control" value="{{ $agendamento->idFuncionario }}">
        </div>
        <div class="form-group">
            <label for="idServico">ID do Serviço:</label>
            <input type="text" name="idServico" class="form-control" value="{{ $agendamento->idServico }}">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
