<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosDispo extends Model
{
    use HasFactory;

    protected $table = 'tblhorarios_disponiveis';

    protected $primaryKey = 'id ';

    protected $fillable = [
        'idFuncionario ',
        'data_hora_inicial ',
        'data_hora_final ',
    ];

}
