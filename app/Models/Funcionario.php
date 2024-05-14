<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'tblfuncionarios';
    protected $primaryKey = 'idFuncionario';

    protected $fillable = [
        'nomeFuncionario',
        'dataNascFuncionario',
        'emailFuncionario',
        'telefoneFuncionario',
        'senhaFuncionario',
        'salarioFuncionario',
        'enderecoFuncionario',
        'nivelFuncionario',
        'statusFuncionario',
        'cargoFuncionario',
        'created_at',
        'updated_at',
        'idEspecialidade ',
    ];


    public function usuario(){
        return $this->morphOne(Usuario::class, 'tipo_usuario');
    }
}

