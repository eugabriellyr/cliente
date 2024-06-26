 @extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
<div class="container">
    <h1>Editar Serviço</h1>


    <form action="{{ route('dashboard.admin.func.updateServico', $servicos->idServico) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tipoServico">Tipo de Serviço</label>
            <input type="text" name="tipoServico" id="tipoServico" class="form-control" value="{{ $servicos->tipoServico }}" required>
        </div>
        <div class="form-group">
            <label for="nomeServico">Nome do Serviço</label>
            <input type="text" name="nomeServico" id="nomeServico" class="form-control" value="{{ $servicos->nomeServico }}" required>
        </div>
         <div class="form-group">
            <label for="duracaoServico">Duração do Serviço</label>
            <input type="time" name="duracaoServico" id="duracaoServico" class="form-control" value="{{ $servicos->duracaoServico }}" required>
        </div>
        <div class="form-group">
            <label for="descricaoServico">Descrição do Serviço</label>
            <input type="text" name="descricaoServico" id="descricaoServico" class="form-control" value="{{ $servicos->descricaoServico }}" required>
        </div>
        <div class="form-group">
            <label for="valorServico">Valor do Serviço</label>
            <input type="number" name="valorServico" id="valorServico" class="form-control" value="{{ $servicos->valorServico }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>



</div>
@endsection

