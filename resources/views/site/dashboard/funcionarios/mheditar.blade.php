@extends('site.dashboard.dashboardLayout.layout')

@section('dashboard')
<div class="container">
    <h2>Editar Horário</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.funcionarios.atualizarHorario', $horario->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="data_hora_inicial">Hora Inicial:</label>
            <input type="time" name="data_hora_inicial" class="form-control" value="{{ \Carbon\Carbon::parse($horario->data_hora_inicial)->format('H:i') }}">
        </div>
        <div class="form-group">
            <label for="data_hora_final">Hora Final:</label>
            <input type="time" name="data_hora_final" class="form-control" value="{{ \Carbon\Carbon::parse($horario->data_hora_final)->format('H:i') }}">
        </div>
       
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
