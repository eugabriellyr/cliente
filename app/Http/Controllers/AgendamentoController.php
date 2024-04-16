<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServicosModel;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    //

    public function index()
    {

        return view('site.agendamento');
    }
    public function ListarCategorias(){
        $categorias = ServicosModel::select('tipoServico')->distinct()->get();

        return view('site.agendamento', compact('categorias'));
    }
}
