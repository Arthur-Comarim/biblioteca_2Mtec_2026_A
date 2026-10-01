<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{



    protected $table = 'CLIENTE';
    protected $primaryKey = 'CLICODIGO';
    public $timestamps = false;  // o diagrama não tem created_at/updated_at
    protected $fillable = [
        'CLINOME','CLICPF','CLITELEFONE',
        'CLIEMAIL','CLIDTNASC','CLIDTCAD'
    ];

    protected $casts = [
        'CLIDTNASC'=> 'date',
        'CLIDTCAD'=>'date'
    ];


    public function emprestimo(){
    return $this->hasMany(Emprestimo::class, 'EMPCLIENTE','CLICODIGO');
    }
}
