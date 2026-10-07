<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model //criação da model Emprestimo, que representa a tabela EMPRESTIMOS no banco de dados
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

    public function cliente() //um empréstimo pertence a um cliente
    {
        return $this->belongsTo(Cliente::class, 'EMPCLIENTE', 'CLICODIGO');
    }
    public function usuario()//um empréstimo pertence a um usuário
    {
        return $this->belongsTo(Usuario::class, 'EMPUSUARIO', 'USRCODIGO');
    }
    public function livro()//um empréstimo pertence a um livro
    {
        return $this->belongsTo(Livro::class, 'EMPLIVRO', 'LVRCODIGO');
    }

    public function scopeAtivos($query) // retorna apenas os empréstimos que ainda não foram devolvidos
    {
    return $query->whereNull('EMPDTDEVOL');
    }

    public function scopeDevolvidos($query) // retorna apenas os empréstimos que já foram devolvidos
    {
    return $query->whereNotNull('EMPDTDEVOL');
    }
}
Emprestimo::ativos()->get(); //exemplo de uso do escopo para obter todos os empréstimos ativos
Emprestimo::ativos()->count(); //exemplo de uso do escopo para contar todos os empréstimos ativos
Emprestimo::devolvidos()->get(); //exemplo de uso do escopo para obter todos os empréstimos devolvidos
Emprestimo::devolvidos()->count(); //exemplo de uso do escopo para contar todos os empréstimos devolvidos
