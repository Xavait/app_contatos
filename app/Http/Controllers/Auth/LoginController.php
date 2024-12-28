<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibir o formulário de login
    public function showLoginForm()
    {
        return view('auth.login'); // View para o formulário de login
    }

    // Processar o login
    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentar fazer login com as credenciais fornecidas
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Se o login for bem-sucedido, redireciona o usuário para a página inicial
            return redirect()->intended('/contatos'); // Ou qualquer outra página que você deseja
        }

        // Se falhar, retorna ao formulário de login com uma mensagem de erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não são válidas.',
        ]);
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/contatos');
}


}
