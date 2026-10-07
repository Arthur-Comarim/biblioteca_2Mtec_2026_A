<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    // não consegui testar nenhuma das models por falta das outras migrations, mas acredito que vai funcionar, pois a sintaxe está correta e o diagrama do banco de dados está correto

    protected $table = 'EMPRESTIMOS'; // nome da tabela no banco de dados
    protected $primaryKey = 'EMPCODIGO'; // nome da chave primária no banco de dados
    public $timestamps = false;  // o diagrama não tem created_at/updated_at
    protected $fillable = [
        'EMPLIVRO','EMPUSUARIO','EMPCLIENTE',
        'EMPDTEMPR','EMPDTDEVOL' // campos que podem ser preenchidos em massa
    ];

    protected $casts = [
        'EMPDTEMPR'=> 'date', // define o tipo de dado para as datas
        'EMPDTDEVOL'=>'date'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'EMPCLIENTE', 'CLICODIGO'); //um empréstimo pertence a um cliente
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'EMPUSUARIO', 'USRCODIGO'); //um empréstimo pertence a um usuário
    }
    public function livro(){
        return $this->belongsTo(Livro::class, 'EMPLIVRO', 'LVRCODIGO'); //um empréstimo pertence a um livro
    }

    public function scopeAtivos($query){
    return $query->whereNull('EMPDTDEVOL'); // retorna apenas os empréstimos que ainda não foram devolvidos
    }

    public function scopeDevolvidos($query){
    return $query->whereNotNull('EMPDTDEVOL'); // retorna apenas os empréstimos que já foram devolvidos
    }
}
Emprestimo::ativos()->get(); //exemplo de uso do escopo para obter todos os empréstimos ativos
Emprestimo::ativos()->count(); //exemplo de uso do escopo para contar todos os empréstimos ativos
Emprestimo::devolvidos()->get(); //exemplo de uso do escopo para obter todos os empréstimos devolvidos
Emprestimo::devolvidos()->count(); //exemplo de uso do escopo para contar todos os empréstimos devolvidos
