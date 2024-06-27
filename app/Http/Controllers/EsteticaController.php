<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;

use App\Models\Funcionario;


// perfil do admin/atualizar
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class EsteticaController extends Controller
{
    public function index(){

        $idFuncionario = session('id');
        $func   = Funcionario::find($idFuncionario);

        if(!$func){
            abort(404,'Funcionario não encontrado');
        }else{

        return view('site.dashboard.funcionarios.estetica', compact('func'));
        }

    }


    // dash cris

      // Exibir/editar perfil do admin
      public function Fperfil()
      {
          Log::info('Perfil do esteticista acessado');
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

          return view('site.dashboard.funcionarios.fperfil', compact('func'));
      }



    //   public function FuncionarioUpdate(Request $request)
    //   {
    //       Log::info('Update profile request received', ['request' => $request->all()]);

    //       $idFuncionario = session('id');
    //       if (!$idFuncionario) {
    //           Log::error('ID do funcionário não encontrado na sessão');
    //           return redirect()->back()->with('error', 'ID do funcionário não encontrado na sessão.');
    //       }
    //       Log::info('ID do Funcionario: ' . $idFuncionario);

    //       $func = Funcionario::find($idFuncionario);

    //       if (!$func) {
    //           Log::error('Funcionário não encontrado com ID: ' . $idFuncionario);
    //           return redirect()->back()->with('error', 'Funcionário não encontrado.');
    //       }

    //       // Encontrar o usuário correspondente na tabela tblusuarios
    //       $user = Usuario::where('emailUsuario', $func->emailFuncionario)->first();

    //       if (!$user) {
    //           Log::error('Usuário não encontrado com o email: ' . $func->emailFuncionario);
    //           return redirect()->back()->with('error', 'Usuário não encontrado.');
    //       }

    //       $validatedData = $request->validate([
    //           'nomeFuncionario' => 'required|string|max:255',
    //           'dataNascFuncionario' => 'required|date',
    //           'emailFuncionario' => 'required|string|email|max:255',
    //           'telefoneFuncionario' => 'required|string|max:15',
    //           'enderecoFuncionario' => 'required|string|max:255',
    //           'senhaFuncionario' => 'nullable|string|confirmed|min:2',
    //           'salarioFuncionario' => 'required|numeric',
    //           'nivelFuncionario' => 'required|string|max:255',
    //           'statusFuncionario' => 'required|string|max:255',
    //           'cargoFuncionario' => 'required|string|max:255',
    //           'idEspecialidade' => 'required|integer',
    //           'fotoFuncionario' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Novo campo para foto
    //       ]);

    //       Log::info('Validation passed', ['validatedData' => $validatedData]);

    //       // Atualiza os dados na tabela tblfuncionarios
    //       $func->nomeFuncionario = $validatedData['nomeFuncionario'];
    //       $func->dataNascFuncionario = $validatedData['dataNascFuncionario'];
    //       $func->emailFuncionario = $validatedData['emailFuncionario'];
    //       $func->telefoneFuncionario = $validatedData['telefoneFuncionario'];
    //       $func->enderecoFuncionario = $validatedData['enderecoFuncionario'];
    //       $func->salarioFuncionario = $validatedData['salarioFuncionario'];
    //       $func->nivelFuncionario = $validatedData['nivelFuncionario'];
    //       $func->statusFuncionario = $validatedData['statusFuncionario'];
    //       $func->cargoFuncionario = $validatedData['cargoFuncionario'];
    //       $func->idEspecialidade = $validatedData['idEspecialidade'];

    //       // Se uma nova foto for enviada, salva-a
    //       if ($request->hasFile('fotoFuncionario')) {
    //           $image = $request->file('fotoFuncionario');
    //           $name = time() . '.' . $image->getClientOriginalExtension();
    //           $destinationPath = public_path('/assets/img-user');
    //           $image->move($destinationPath, $name);
    //           $func->fotoFuncionario = $name;
    //       }

    //       // Atualiza os dados na tabela tblusuarios
    //       $user->emailUsuario = $validatedData['emailFuncionario'];
    //       if (!empty($validatedData['senhaFuncionario'])) {
    //           Log::info('Password field is filled');
    //           $func->senhaFuncionario = $validatedData['senhaFuncionario'];
    //           $user->senhaUsuario = $func->senhaFuncionario;
    //           Log::info('Senha não criptografada: ' . $func->senhaFuncionario);
    //       } else {
    //           Log::info('Password field is not filled');
    //       }

    //       $func->save();
    //       $user->save();

    //       Log::info('Profile updated successfully for ID: ' . $idFuncionario);

    //       return redirect()->route('dashboard.funcionarios.fperfil')->with('success', 'Perfil atualizado com sucesso!');
    //   }




    public function FuncionarioUpdate(Request $request)
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
        'fotoFuncionario' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Novo campo para foto
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

    // Se uma nova foto for enviada, salva-a
    if ($request->hasFile('fotoFuncionario')) {
        $image = $request->file('fotoFuncionario');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/assets/img-user');
        $image->move($destinationPath, $name);
        $func->fotoFuncionario = $name;
    }

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

    return redirect()->route('dashboard.funcionarios.fperfil')->with('success', 'Perfil atualizado com sucesso!');
}



        // Exibir agendamentos do funcionário
          // Exibir agendamentos do funcionário
           // Exibir agendamentos do funcionário
    public function meusAgendamentos()
    {
        $idFuncionario = session('id');
        if (!$idFuncionario) {
            Log::error('ID do funcionário não encontrado na sessão');
            return redirect()->back()->with('error', 'ID do funcionário não encontrado na sessão.');
        }

        // Buscar o funcionário e seus agendamentos
        $func = Funcionario::find($idFuncionario);
        if (!$func) {
            Log::error('Funcionário não encontrado com ID: ' . $idFuncionario);
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        $agendamentos = $func->agendamentos; // Supondo que há uma relação definida
        Log::info('Funcionário: ' . $func);
        Log::info('Agendamentos: ' . $agendamentos);

        return view('site.dashboard.funcionarios.funcagenda', compact('func', 'agendamentos'));
    }

    // Exibir formulário de edição do agendamento
    public function editarH($id)
    {
        $agendamento = Agendamento::find($id);
        if (!$agendamento) {
            return redirect()->back()->with('error', 'Agendamento não encontrado.');
        }

        return view('site.dashboard.funcionarios.heditar', compact('agendamento'));
    }

    // Atualizar horário inicial do agendamento
    public function updateH(Request $request, $id)
    {
        $request->validate([
            'data_hora_inicial' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $agendamento = Agendamento::find($id);
        if (!$agendamento) {
            return redirect()->back()->with('error', 'Agendamento não encontrado.');
        }

        $agendamento->data_hora_inicial = $request->input('data_hora_inicial');
        $agendamento->save();

        return redirect()->route('dashboard.funcionarios.funcagenda')->with('success', 'Horário inicial atualizado com sucesso.');
    }

}
