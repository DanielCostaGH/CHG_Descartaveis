<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::get();
        return view('admin.index', compact('admins'));
        
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string',
        //     'password' => 'required|string'
        // ]);

        // $admin = Admin::where('email', '=', $request->email)->first();
        // if (!$admin || !Hash::check($request->password, $admin->password)) {
        //     return response([
        //         'message' => 'Credenciais inválidas'
        //     ], 401);
        // }

        // if (!hash_equals($request->session()->token(), $request->input('_token'))) {
        //     return response([
        //         'message' => 'Token CSRF inválido'
        //     ], 401);
        // }

        // dd(Auth::attempt($request->only(['email', 'password'])));

        // Auth::login($admin);
        // if (Auth::check()) {
        //     // O admin está autenticado com sucesso
        //     $token = $admin->createToken('auth_token');
        //     $response = [
        //         'admin' => $admin,
        //         'token' => $token
        //     ];
        //     // return redirect()->route('dashboard.index');
        //     return response($response)
        //         ->header('X-CSRF-TOKEN', $request->session()->token());

        // } else {
        //     // Autenticação falhou
        //     return response([
        //         'message' => 'Autenticação falhou'
        //     ], 401);
        // }
        // $admin = Admin::where('email', $request->email)->first();
        // // dd(Hash::check($request->password, $admin->password));
        // $credentials = [
        //     'email' => $admin->email,
        //     'password' => $admin->password,
        // ];

        // // dd(Hash::check($request->password, $admin->password));
        // Auth::login($admin);
        // dd(Auth::check());    

        // // if (!Hash::check($request->password, $admin->password)) {
        // //     return redirect()->back()->withErrors('Usuário ou senha inválidos');
        // // }
        // // if (!Auth::attempt($credentials) ){
        // //     dd($request->only(['email', 'password']));
        // //     return redirect()->back()->withErrors('Usuário ou senha inválidos');
        // // }

        // return to_route('dashboard.index');
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect()->back()->withErrors('Usuário ou senha inválidos');
        }

        Auth::login($admin);

        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Admin::class);
        
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request) {
        $request->validate([
            'name' => ['required|string|max:100|min:5'],
            'email' => ['required|string|unique:admin, email|min:15max:100'],
            'password' => ['required','string','min:4', 'confirmed'],
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $admin->createToken('auth_token')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token
        ];

        return redirect()->route('admin.index')->with('response', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return redirect()->route('admin.login');
    }
}
