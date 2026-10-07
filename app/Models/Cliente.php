<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

// criação da model Cliente, que representa a tabela CLIENTES no banco de dados
class Cliente extends Model
{
    // acho que agora essa bomba funciona

    // nome da tabela no banco de dados
    protected $table = 'CLIENTES';
    // nome da chave primária no banco de dados
    protected $primaryKey = 'CLICODIGO';
    // o diagrama não tem created_at/updated_at
    public $timestamps = false;
    // campos que podem ser preenchidos em massa
    protected $fillable = [
        'CLINOME','CLICPF','CLITELEFONE',
        'CLIEMAIL','CLIDTNASC','CLIDTCAD'
    ];

    // define o tipo de dado para as datas
    protected $casts = [
        'CLIDTNASC'=> 'date',
        'CLIDTCAD'=>'date'
    ];

    // um cliente pode ter muitos empréstimos
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class, 'EMPCLIENTE','CLICODIGO');
    }

    // acessor para calcular a idade do cliente com base na data de nascimento
    public function getIdadeAttribute()
    {
        if ($this->CLIDTNASC) {
            $birthDate = new \DateTime($this->CLIDTNASC);
            $today = new \DateTime();
            return $today->diff($birthDate)->y;
        }
        return null;
    }
}

