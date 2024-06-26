@extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
{{-- <title>Cadastro de Serviço</title> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            width: 93%;
            margin: auto;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="datetime-local"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .invalid-feedback {
            color: #ff0000;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

    <!-- Parte do formulário -->
    <form action="{{ route('dashboard.admin.func.cadservico') }}" method="POST">
        @csrf
        <div>
            <label for="tipoServico">Tipo de Serviço:</label>
            <input type="text" id="tipoServico" name="tipoServico" required maxlength="40">
            @error('tipoServico')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="nomeServico">Nome do Serviço:</label>
            <input type="text" id="nomeServico" name="nomeServico" required maxlength="50">
            @error('nomeServico')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="duracaoServico">Duração do Serviço:</label>
            <input type="time" id="duracaoServico" name="duracaoServico" required>
            @error('duracaoServico')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="descricaoServico">Descrição do Serviço:</label>
            <input type="text" id="descricaoServico" name="descricaoServico" required>
            @error('descricaoServico')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="valorServico">Valor do Serviço:</label>
            <input type="number" id="valorServico" name="valorServico" required maxlength="40">
            @error('valorServico')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="statusServico">Status do Serviço:</label>
            <select id="statusServico" name="statusServico" required>
                <option value="ATIVO">Ativo</option>
                <option value="INATIVO">Inativo</option>
            </select>
            @error('statusServico')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Salvar</button>
    </form>
@endsection
