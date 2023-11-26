<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function login()
    {
        $title = 'User - Login';

        return view('users.login', ['title' => $title]);
    }

    public function auth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'login' => 'Email ou senha incorreto!'
        ]);
    }


    public function create()
    {
        $title = 'User - Cadastro';

        return view('users.create', ['title' => $title]);
    }


    public function store(Request $request)
    {
        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->tel,
        ]);

        return redirect()->route('user.login');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'User - Conta';

        return view('users.edit', ['title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $cep = urlencode($request->cep);
        $url = "https://viacep.com.br/ws/$cep/json/";

        $data = json_decode(file_get_contents($url), true);

        User::findOrFail(Auth::user()->id)->update([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'cep' => $request->cep,
            'logradouro' => $data['logradouro'],
            'bairro' => $data['bairro'],
            'cidade' => $data['localidade'],
            'uf' => $data['uf'],
            'numero' => $request->numero,
        ]);

        return redirect()->route('user.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('user.login');
    }
}
