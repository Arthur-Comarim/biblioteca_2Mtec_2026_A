<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'EMPRESTIMOS';
    protected $primaryKey = 'EMPCODIGO';
    public $timestamps = false;  // o diagrama não tem created_at/updated_at
    protected $fillable = [
        'EMPLIVRO','EMPUSUARIO','EMPCLIENTE',
        'EMPDTEMPR','EMPDTDEVOL'
    ];

    protected $casts = [
        'EMPDTEMPR'=> 'date',
        'EMPDTDEVOL'=>'date'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'EMPCLIENTE', 'CLICODIGO');
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'EMPUSUARIO', 'USRCODIGO');
    }
    public function livro(){
        return $this->belongsTo(Livro::class, 'EMPLIVRO', 'LVRCODIGO');
    }

    public function scopeAtivos($query){
    return $query->whereNull('EMPDTDEVOL');
    }

   Emprestimo::ativos()->get();
    
}
