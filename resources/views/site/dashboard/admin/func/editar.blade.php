@extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
<div class="container">
    <h1>Editar Funcionário</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('dashboard.admin.func.updateFuncionario', $func->idFuncionario) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nomeFuncionario">Nome</label>
            <input type="text" name="nomeFuncionario" id="nomeFuncionario" class="form-control" value="{{ $func->nomeFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="dataNascFuncionario">Data de Nascimento</label>
            <input type="date" name="dataNascFuncionario" id="dataNascFuncionario" class="form-control" value="{{ $func->dataNascFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="emailFuncionario">Email</label>
            <input type="email" name="emailFuncionario" id="emailFuncionario" class="form-control" value="{{ $func->emailFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="telefoneFuncionario">Telefone</label>
            <input type="text" name="telefoneFuncionario" id="telefoneFuncionario" class="form-control" value="{{ $func->telefoneFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="enderecoFuncionario">Endereço</label>
            <input type="text" name="enderecoFuncionario" id="enderecoFuncionario" class="form-control" value="{{ $func->enderecoFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="salarioFuncionario">Salário</label>
            <input type="number" name="salarioFuncionario" id="salarioFuncionario" class="form-control" value="{{ $func->salarioFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="cargoFuncionario">Cargo</label>
            <input type="text" name="cargoFuncionario" id="cargoFuncionario" class="form-control" value="{{ $func->cargoFuncionario }}" required>
        </div>
        <div class="form-group">
            <label for="fotoFuncionario">Foto</label>
            <input type="file" name="fotoFuncionario" id="fotoFuncionario" class="form-control">
            @if ($func->fotoFuncionario)
                <img src="{{ asset('assets/img-user/' . $func->fotoFuncionario) }}" alt="Foto do Funcionário" width="100" height="100" class="rounded-circle mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
