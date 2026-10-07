<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//criação da model Emprestimo, que representa a tabela EMPRESTIMOS no banco de dados
class Emprestimo extends Model
{
    // não consegui testar nenhuma das models por falta das outras migrations, mas acredito que vai funcionar, pois a sintaxe está correta e o diagrama do banco de dados está correto

// nome da tabela no banco de dados
    protected $table = 'EMPRESTIMOS';
// nome da chave primária no banco de dados
    protected $primaryKey = 'EMPCODIGO';
     // o diagrama não tem created_at/updated_at
    public $timestamps = false;
// campos que podem ser preenchidos em massa
    protected $fillable = [
        'EMPLIVRO','EMPUSUARIO','EMPCLIENTE',
        'EMPDTEMPR','EMPDTDEVOL'
    ];

    // define o tipo de dado para as datas
    protected $casts = [
        'EMPDTEMPR'=> 'date',
        'EMPDTDEVOL'=>'date'
    ];

//um empréstimo pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'EMPCLIENTE', 'CLICODIGO');
    }
    //um empréstimo pertence a um usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'EMPUSUARIO', 'USRCODIGO');
    }
    //um empréstimo pertence a um livro
    public function livro()
    {
        return $this->belongsTo(Livro::class, 'EMPLIVRO', 'LVRCODIGO');
    }
 // retorna apenas os empréstimos que ainda não foram devolvidos
    public function scopeAtivos($query)
    {
    return $query->whereNull('EMPDTDEVOL');
    }
// retorna apenas os empréstimos que já foram devolvidos
    public function scopeDevolvidos($query)
    {
    return $query->whereNotNull('EMPDTDEVOL');
    }
}
//exemplo de uso do escopo para obter todos os empréstimos ativos
Emprestimo::ativos()->get();

//exemplo de uso do escopo para contar todos os empréstimos ativos
Emprestimo::ativos()->count();

//exemplo de uso do escopo para obter todos os empréstimos devolvidos
Emprestimo::devolvidos()->get();

//exemplo de uso do escopo para contar todos os empréstimos devolvidos
Emprestimo::devolvidos()->count();
