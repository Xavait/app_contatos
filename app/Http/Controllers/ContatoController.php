<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
     
        $contatos = Contato::whereNull('deleted_at')->get();  // Pega apenas os contatos não excluídos
        $contatos = Contato::orderBy('id', 'desc')->get();
        return view('contatos.index', compact('contatos'));
    }

    public function create()
    {
        return view('contatos.create');
    }

    public function store(Request $request)
    {
        // Definindo as regras de validação com mensagens personalizadas
        $validatedData = $request->validate([
            'nome' => 'required|string|min:5|regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // Aceita apenas letras e espaços
            'contato' => 'required|unique:contatos,contato|digits:9',  // A regra que valida 9 dígitos
            'email' => 'required|email|unique:contatos,email',
        ], [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.string' => 'O campo Nome deve ser uma string.',
            'nome.min' => 'O campo Nome deve ter pelo menos 5 caracteres.',
            'nome.regex' => 'O campo Nome não pode conter números.', // Mensagem personalizada para o nome
            'contato.unique' => 'Este contato já existe.', // Mensagem personalizada para unicidade
            'contato.digits' => 'O campo Contato deve ter 9 dígitos.',
            'contato.required' => 'O Campo contato é obrigatório.',
            'email.unique' => 'Este email já existe.', // Mensagem personalizada para unicidade
        ]);
    
        Contato::create([
            'nome' => $validatedData['nome'],
            'contato' => $validatedData['contato'],
            'email' => $validatedData['email']
        ]);
    
        return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso!');
    }
    
    
    


    public function show($id)
    {
        $contato = Contato::findOrFail($id);
        return view('contatos.show', compact('contato'));
    }

    public function edit($id)
    {
        $contato = Contato::findOrFail($id);
        return view('contatos.edit', compact('contato'));
    }


    public function update(Request $request, $id)
    {
        $contato = Contato::findOrFail($id);
        $validatedData = $request->validate([
            'nome' => 'required|string|min:5|regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // Aceita apenas letras e espaços
            'contato' => 'required|digits:9',  // A regra que valida 9 dígitos
            'email' => 'required|email',
        ]
        , [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.string' => 'O campo Nome deve ser uma string.',
            'nome.min' => 'O campo Nome deve ter pelo menos 5 caracteres.',
            'nome.regex' => 'O campo Nome não pode conter números.', // Mensagem personalizada para o nome
            'contato.digits' => 'O campo Contato deve ter 9 dígitos.',
            'contato.required' => 'O Campo contato é obrigatório.'
        ]);

        $contato->update([
            'nome' => $validatedData['nome'],
            'contato' => $validatedData['contato'],
            'email' => $validatedData['email']
        ]);

        return redirect()->route('contatos.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy($id)
{
    // Encontrar o contato ou falhar
    $contato = Contato::findOrFail($id);

    // Verificar se o contato pertence ao usuário autenticado
    if (auth()->id()) {
        // Excluir suavemente (soft delete)
        $contato->delete();

        // Retornar resposta JSON de sucesso
        return response()->json(['success' => true, 'message' => 'Contato excluído com sucesso!']);
    }

    // Caso não tenha permissão para excluir, retornar erro
    return response()->json(['success' => false, 'message' => 'Você não tem permissão para excluir este contato.'], 403);
}
    
}
