<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Models\Funcionario;
// use Illuminate\Http\Request;

// class AdminController extends Controller
// {
//     public function index(){

//         $idFuncionario = session('id');
//         $func   = Funcionario::find($idFuncionario);

//         if(!$func){
//             abort(404,'Funcionario não encontrado');
//         }else{

//         return view('site.dashboard.funcionarios.admin', compact('func'));
//         }

//     }



// }


// dash da cris

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;

// perfil do admin/atualizar
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;


// servico
use Illuminate\Support\Facades\DB; //teste sem o model
use App\Models\ServicosModel;
use App\Models\Cliente;

class AdminController extends Controller
{
    public function index()
    {
        $idFuncionario = session('id');
        $func = Funcionario::find($idFuncionario);

        if (!$func) {
            abort(404, 'Funcionario não encontrado');
        }

        return view('site.dashboard.admin.func.admin', compact('func'));
    }


    // CLIENTES
    // public function indexFuncCliente()
    // {
    //     $idCliente = session('id');
    //     $clientes = Cliente::find($idCliente);
    //     $listaCliente = Cliente::all();

    //     return view('site.dashboard.admin.func.cliente', compact('listaCliente'));
    // }






    // FUNCIONARIOS

    // listar os funcionarios
    public function indexFunc()
    {
        $idFuncionario = session('id');
        $func = Funcionario::find($idFuncionario);
        $listaFunc = Funcionario::where('statusFuncionario', 'ATIVO')->get();

        return view('site.dashboard.admin.func.index', compact('func', 'listaFunc'));
    }



    // Exibir/editar perfil do admin
    public function perfilFunc()
    {
        Log::info('Perfil do admin acessado');
        $idFuncionario = session('id');
        if (!$idFuncionario) {
            Log::error('ID do funcionário não encontrado na sessão');
            return redirect()->back()->with('error', 'ID do funcionário não encontrado na sessão.');
        }
        Log::info('ID do Funcionario: ' . $idFuncionario);

        $func = Funcionario::find($idFuncionario);

        if (!$func) {
            Log::error('Funcionário não encontrado com ID: ' . $idFuncionario);
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        return view('site.dashboard.admin.func.perfil', compact('func'));
    }


    public function updateFunc(Request $request)
    {
        Log::info('Update profile request received', ['request' => $request->all()]);

        $idFuncionario = session('id');
        if (!$idFuncionario) {
            Log::error('ID do funcionário não encontrado na sessão');
            return redirect()->back()->with('error', 'ID do funcionário não encontrado na sessão.');
        }
        Log::info('ID do Funcionario: ' . $idFuncionario);

        $func = Funcionario::find($idFuncionario);

        if (!$func) {
            Log::error('Funcionário não encontrado com ID: ' . $idFuncionario);
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        // Encontrar o usuário correspondente na tabela tblusuarios
        $user = Usuario::where('emailUsuario', $func->emailFuncionario)->first();

        if (!$user) {
            Log::error('Usuário não encontrado com o email: ' . $func->emailFuncionario);
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $validatedData = $request->validate([
            'nomeFuncionario' => 'required|string|max:255',
            'dataNascFuncionario' => 'required|date',
            'emailFuncionario' => 'required|string|email|max:255',
            'telefoneFuncionario' => 'required|string|max:15',
            'enderecoFuncionario' => 'required|string|max:255',
            'senhaFuncionario' => 'nullable|string|confirmed|min:2',
            'salarioFuncionario' => 'required|numeric',
            'nivelFuncionario' => 'required|string|max:255',
            'statusFuncionario' => 'required|string|max:255',
            'cargoFuncionario' => 'required|string|max:255',
            'idEspecialidade' => 'required|integer',
        ]);

        Log::info('Validation passed', ['validatedData' => $validatedData]);

        // Atualiza os dados na tabela tblfuncionarios
        $func->nomeFuncionario = $validatedData['nomeFuncionario'];
        $func->dataNascFuncionario = $validatedData['dataNascFuncionario'];
        $func->emailFuncionario = $validatedData['emailFuncionario'];
        $func->telefoneFuncionario = $validatedData['telefoneFuncionario'];
        $func->enderecoFuncionario = $validatedData['enderecoFuncionario'];
        $func->salarioFuncionario = $validatedData['salarioFuncionario'];
        $func->nivelFuncionario = $validatedData['nivelFuncionario'];
        $func->statusFuncionario = $validatedData['statusFuncionario'];
        $func->cargoFuncionario = $validatedData['cargoFuncionario'];
        $func->idEspecialidade = $validatedData['idEspecialidade'];

        // Atualiza os dados na tabela tblusuarios
        $user->emailUsuario = $validatedData['emailFuncionario'];
        if (!empty($validatedData['senhaFuncionario'])) {
            Log::info('Password field is filled');
            $func->senhaFuncionario = $validatedData['senhaFuncionario'];
            $user->senhaUsuario = $func->senhaFuncionario;
            Log::info('Senha não criptografada: ' . $func->senhaFuncionario);
        } else {
            Log::info('Password field is not filled');
        }

        $func->save();
        $user->save();

        Log::info('Profile updated successfully for ID: ' . $idFuncionario);

        return redirect()->route('dashboard.admin.func.perfil')->with('success', 'Perfil atualizado com sucesso!');
    }







    // criar funcionario
  // criar funcionario
public function createFunc()
{
    // Verifica se o usuário está autenticado
    $idFuncionario = session('id');

    // Busca o funcionário no banco de dados
    $func = Funcionario::find($idFuncionario);

    // Se o funcionário não for encontrado, retorna erro 404
    if (!$func) {
        abort(404, 'Funcionario nao encontrado');
    }

    // Retorna a view com os dados do funcionário
    return view('site.dashboard.admin.func.create', compact('func'));
}

// CADASTRAR FUNCIONARIO NOVO// CADASTRAR FUNCIONARIO NOVO
public function cadFunc(Request $request)
{
    $request->validate([
        'nomeFuncionario' => 'required|string|max:100',
        'emailFuncionario' => 'required|string|max:100|unique:tblusuarios,emailUsuario', // Garantir que o email seja único
        'senhaFuncionario' => 'required|string|max:20',
        'telefoneFuncionario' => 'required|string|max:20',
        'salarioFuncionario' => 'required|numeric',
        'enderecoFuncionario' => 'required|string|max:100',
        'nivelFuncionario' => 'required|string|max:100',
        'cargoFuncionario' => 'required|string|max:30',
        'statusFuncionario' => 'required|string|max:20',
        'dataNascFuncionario' => 'required|date',
        'idEspecialidade' => 'required|integer',
        'fotoFuncionario' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Novo campo para foto
    ]);

    // Criação do funcionário
    $func = new Funcionario();
    $func->nomeFuncionario = $request->input('nomeFuncionario');
    $func->emailFuncionario = $request->input('emailFuncionario');
    $func->senhaFuncionario = $request->input('senhaFuncionario');
    $func->telefoneFuncionario = $request->input('telefoneFuncionario');
    $func->salarioFuncionario = $request->input('salarioFuncionario');
    $func->enderecoFuncionario = $request->input('enderecoFuncionario');
    $func->nivelFuncionario = $request->input('nivelFuncionario');
    $func->cargoFuncionario = $request->input('cargoFuncionario');
    $func->statusFuncionario = $request->input('statusFuncionario');
    $func->dataNascFuncionario = $request->input('dataNascFuncionario');
    $func->idEspecialidade = $request->input('idEspecialidade');

    // Se uma foto for enviada, salva-a
    if ($request->hasFile('fotoFuncionario')) {
        $image = $request->file('fotoFuncionario');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/assets/img-user');
        $image->move($destinationPath, $name);
        $func->fotoFuncionario = $name;
    } else {
        $func->fotoFuncionario = null;
    }

    $func->save();

    // Criação do usuário correspondente
    $usuario = new Usuario();
    $usuario->nomeUsuario = $request->input('nomeFuncionario');
    $usuario->senhaUsuario = $request->input('senhaFuncionario');
    $usuario->emailUsuario = $request->input('emailFuncionario');
    $usuario->tipoUsuario_id = $func->idFuncionario;
    $usuario->tipoUsuario_type = 'funcionario'; // Atribuindo o tipoUsuario corretamente
    $usuario->save();

    return redirect()->route('dashboard.admin.func.index')->with('success', 'Funcionário cadastrado com sucesso!');
}

// atualizar e desativar funcionario
public function editFuncionario($id)
{
    $func = Funcionario::findOrFail($id);
    return view('site.dashboard.admin.func.editar', compact('func'));
}

public function updateFuncionario(Request $request, $id)
{
    $request->validate([
        'nomeFuncionario' => 'required|string|max:255',
        'dataNascFuncionario' => 'required|date',
        'emailFuncionario' => 'required|string|email|max:255|unique:tblusuarios,emailUsuario,' . $id . ',idFuncionario', // Garantir que o email seja único, exceto para o funcionário atual
        'telefoneFuncionario' => 'required|string|max:15',
        'enderecoFuncionario' => 'required|string|max:255',
        'salarioFuncionario' => 'required|numeric',
        'cargoFuncionario' => 'required|string|max:255',
    ]);

    $func = Funcionario::findOrFail($id);
    $func->update($request->all());

    // Atualizar o usuário correspondente
    $usuario = Usuario::where('tipoUsuario_id', $func->idFuncionario)->where('tipoUsuario_type', 'funcionario')->first();
    if ($usuario) {
        $usuario->nomeUsuario = $request->input('nomeFuncionario');
        $usuario->emailUsuario = $request->input('emailFuncionario');
        $usuario->senhaUsuario = $request->input('senhaFuncionario'); // Atualizar a senha se necessário
        $usuario->save();
    }

    return redirect()->route('dashboard.admin.func.index')->with('success', 'Funcionário atualizado com sucesso!');
}

public function desativarFuncionario($id)
{
    $funcionario = Funcionario::findOrFail($id);
    $funcionario->statusFuncionario = 'INATIVO';
    $funcionario->save();

    return redirect()->route('dashboard.admin.func.index')->with('success', 'Funcionário desativado com sucesso!');
}







    // SERVIÇOS

    public function indexFuncServico()
    {
        $idServico = session('id');
        $servicos = ServicosModel::find($idServico);
        $listaServico = ServicosModel::all();

        $listaServico = ServicosModel::where('statusServico', 'ATIVO')->get();

        return view('site.dashboard.admin.func.servico', compact('listaServico'));
    }


    // atualizar e desativar serviços

    public function atualizarServico($id)
    {
        $servicos = ServicosModel::findOrFail($id);
        return view('site.dashboard.admin.func.atualizar', compact('servicos'));
    }


    public function updateServico(Request $request, $id)
    {
        $request->validate([
            'nomeServico' => 'required|string|max:255',
            'tipoServico' => 'required|string|max:255',
            'descricaoServico' => 'required|string|max:255',
            'valorServico' => 'required|string|max:15',
        ]);

        $servicos = ServicosModel::findOrFail($id);
        $servicos->update($request->all());

        return redirect()->route('dashboard.admin.func.servico')->with('success', 'Serviço atualizado com sucesso!');
    }


    public function desativarServico($id)
    {
        $servicos = ServicosModel::findOrFail($id);
        $servicos->statusServico = 'INATIVO';
        $servicos->save();

        return redirect()->route('dashboard.admin.func.servico')->with('success', 'Serviço desativado com sucesso!');
    }




    // CRIAR SERVICO

    // criar serviço
    public function createServico()
    {
        // Verifica se o usuário está autenticado
        $idServico = session('id');

        // Busca o serviço no banco de dados
        $servicos = ServicosModel::find($idServico);

        // Se o serviço não for encontrado, retorna erro 404
        if (!$servicos) {
            abort(404, 'Serviço não encontrado');
        }

        // Retorna a view com os dados do serviço
        return view('site.dashboard.admin.func.criar', compact('servicos'));
    }

    // CADASTRAR NOVO SERVIÇO
    public function cadServico(Request $request)
    {
        // Validação dos campos
        $validatedData = $request->validate([
            'tipoServico' => 'required|string|max:40',
            'nomeServico' => 'required|string|max:50',
            'duracaoServico' => 'required|date_format:H:i',
            'descricaoServico' => 'required|string',
            'valorServico' => 'required|string|max:40',
            'statusServico' => 'required|string|in:ATIVO,INATIVO', // Ajustado para enum
        ]);

        $servico = new ServicosModel();

        $servico->tipoServico = $validatedData['tipoServico'];
        $servico->nomeServico = $validatedData['nomeServico'];
        $servico->duracaoServico = $validatedData['duracaoServico'];
        $servico->descricaoServico = $validatedData['descricaoServico'];
        $servico->valorServico = $validatedData['valorServico'];
        $servico->statusServico = $validatedData['statusServico'];

        $servico->save();

        return redirect()->route('dashboard.admin.func.servico')->with('success', 'Serviço cadastrado com sucesso');
    }



}
