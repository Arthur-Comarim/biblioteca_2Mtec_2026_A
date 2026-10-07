<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Cliente extends Model
{

// acho que agora essa bomba funciona

    protected $table = 'CLIENTES'; // nome da tabela no banco de dados
    protected $primaryKey = 'CLICODIGO'; // nome da chave primária no banco de dados
    public $timestamps = false;  // o diagrama não tem created_at/updated_at
    protected $fillable = [
        'CLINOME','CLICPF','CLITELEFONE',
        'CLIEMAIL','CLIDTNASC','CLIDTCAD']; // campos que podem ser preenchidos em massa

    protected $casts = [
        'CLIDTNASC'=> 'date',
        'CLIDTCAD'=>'date' // define o tipo de dado para as datas
    ];


    public function emprestimos(){
    return $this->hasMany(Emprestimo::class, 'EMPCLIENTE','CLICODIGO'); //um cliente pode ter muitos empréstimos
    }

public function getIdadeAttribute() //acessor para calcular a idade do cliente com base na data de nascimento
    {
        if ($this->CLIDTNASC) {
            $birthDate = new \DateTime($this->CLIDTNASC);
            $today = new \DateTime();
            return $today->diff($birthDate)->y;
        }
        return null;
    }
}

