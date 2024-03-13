<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $idFuncionario = session('id');
        $func   = Funcionario::find($idFuncionario);

        if(!$func){
            abort(404,'Funcionario não encontrado');
        }else{

        return view('site.dashboard.funcionarios.admin', compact('func'));
        }

    }
}
