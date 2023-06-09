<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time extends Model
{
    use HasFactory;

    protected $fillable = [	
        'id_usuario',
        'sigla',
        'nome',
        
        'Eexcluido',
        'endereco',
        'cidade',
        'bairro',
        'complemento',
        'cep',
        'estado'

    ];

    public function time()
    {
        return $this->belongsTo(time::class);
    }

    public function lstTimes($arrayTimes)
    {
        return time::select('id', 'nome', 'sigla','Eexcluido','endereco','cidade','bairro','complemento','cep','estado')
            ->whereIn('id', $arrayTimes)
            ->get()->toArray();
    }

    public function sltTimes()
    {
        return time::select('id', 'sigla', 'nome', 'Eexcluido')
            ->where('Eexcluido', '=', '0')
            ->orderby('nome')
            ->get()->toArray();
    }

    public function lstTimesPorIdUsuario($idUsurio)
    {
        return time::select('id', 'sigla', 'nome', 'Eexcluido')
            ->where('id_usuario', '=', $idUsurio)
            ->get()->toArray();
    }

    public function listaTodosTimes()
    {
        return time::select('id', 'sigla', 'nome', 'Eexcluido')
            ->orderby('nome')
            ->get()->toArray();
    }
}


