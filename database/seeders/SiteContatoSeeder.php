<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $contato = new SiteContato();
        // $contato->nome = 'Sistema SG';
        // $contato->telefone = '(61) 99999-0000';
        // $contato->email = 'contato@sg.com';
        // $contato->motivo_contato = 1;
        // $contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão';
        // $contato->save();

        \App\Models\SiteContato::factory()->count(100)->create();
    }
}
