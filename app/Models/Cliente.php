<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'tblclientes';
    protected $primaryKey = 'idCliente';

    protected $fillable = [
        'nomeCliente', 'emailCliente', 'senhaCliente'
    ];

    public function usuario()
    {
        return $this->morphOne(Usuario::class, 'tipo_usuario');
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'idCliente', 'idCliente');
    }

}

