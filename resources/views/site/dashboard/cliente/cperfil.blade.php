@extends('site.dashboard.dashboardLayout.layout')

@section('dash-cliente')

<style>
    .profile-container {
        background-color: #f8f9fa; /* Mude esta cor conforme necessário */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="profile-container">
    <h1>Perfil do Cliente</h1>

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

    <form action="{{ route('cliente.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nomeCliente">Nome</label>
            <input type="text" name="nomeCliente" id="nomeCliente" class="form-control" value="{{ $cliente->nomeCliente }}" required>
        </div>

        <div class="form-group">
            <label for="telefoneCliente">Telefone</label>
            <input type="text" name="telefoneCliente" id="telefoneCliente" class="form-control" value="{{ $cliente->telefoneCliente }}" required>
        </div>

        <div class="form-group">
            <label for="emailCliente">Email</label>
            <input type="email" name="emailCliente" id="emailCliente" class="form-control" value="{{ $cliente->emailCliente }}" required>
        </div>

        <div class="form-group">
            <label for="senhaCliente">Senha</label>
            <input type="password" name="senhaCliente" id="senhaCliente" class="form-control">
        </div>

        <div class="form-group">
            <label for="senhaCliente_confirmation">Confirmar Senha</label>
            <input type="password" name="senhaCliente_confirmation" id="senhaCliente_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="fotoCliente">Foto</label>
            <input type="file" name="fotoCliente" id="fotoCliente" class="form-control">
            @if ($cliente->fotoCliente)
                <img src="{{ asset('assets/img-client/' . $cliente->fotoCliente) }}" alt="Foto do Cliente" width="100" height="100" class="rounded-circle mt-2">
            @else
                <img src="{{ asset('assets/img-client/default.jpg') }}" alt="Foto padrão" width="100" height="100" class="rounded-circle mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
    </form>
</div>

@endsection
