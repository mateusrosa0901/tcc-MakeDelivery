<?php

namespace App\Http\Controllers;

use App\Models\Motoboy;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MotoboyController extends Controller
{
    public function login()
    {
        $title = 'Motoboy - Login';

        return view('motoboys.login', ['title' => $title]);
    }

    public function auth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('motoboys')->attempt($credentials)) {
            config()->set('auth.defaults.guard', 'motoboys');
            auth()->shouldUse('motoboys');
            $request->session()->regenerate();
            //dd(Auth()->user());

            return redirect()->intended(route('motoboy.dashboard'));
        }

        return back()->withErrors([
            'login' => 'Deu ruim!'
        ]);
    }

    public function create()
    {
        $title = 'Motoboy - Cadastro';

        return view('motoboys.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $motoboy = Motoboy::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->tel,
            'cpf' => $request->cpf,
            'placa' => $request->placa,
        ]);
        
        try {
            $motoboy->save();

            return redirect()->route('motoboy.login');

        } catch (QueryException $exception)  {
            return back()->withErrors([
                'cadastro' => $exception->errorInfo[2],
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Motoboy $motoboy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motoboy $motoboy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motoboy $motoboy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motoboy $motoboy)
    {
        //
    }
}
