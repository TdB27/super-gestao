<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuario e ou senha não existe!';
        } else if ($request->get('erro') == 2) {
            $erro = 'Necessário realizar login para ter acesso a página!';
        }

        return view('site.login', [
            'titulo' => "Login",
            'erro' => $erro
        ]);
    }

    public function autenticar(Request $request)
    {
        // regras da validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required',
        ];

        // mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo usuario (email) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        // Iniciar o Model User
        $user = new User();

        $user = $user->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        if (isset($user->name)) {

            session_start();
            $_SESSION['nome'] = $user->name;
            $_SESSION['email'] = $user->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', [
                'erro' => 1
            ]);
        }
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');
    }
}
