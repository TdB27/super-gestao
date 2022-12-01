<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // instanciando o OBJ
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Forncedor 100';
        $fornecedor->site = 'forncedor100.com.br';
        $fornecedor->uf = 'SP';
        $fornecedor->email = 'contato@forncedor100.com';
        $fornecedor->save();

        // o método create (atenção para o atributo fillabe da classe da model)
        Fornecedor::create([
            'nome' => 'Forncedor 200',
            'site' => 'forncedor200.com.br',
            'uf' => 'DF',
            'email' => 'contato@forncedor200.com',
        ]);

        // pelo insert do DB
        DB::table('fornecedores')->insert([
            'nome' => 'Forncedor 300',
            'site' => 'forncedor300.com.br',
            'uf' => 'AM',
            'email' => 'contato@forncedor300.com',
        ]);
    }
}
