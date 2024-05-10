<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Usuario extends Model
class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    protected $table = 'tblusuarios';
    protected $primaryKey = 'idUsuario';

    public function tipo_usuario()
    {
        return $this->morphTo('tipo_usuario','tipoUsuario_type','tipoUsuario_id');
    }
}
