<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\PersonalAccessTokens;
use Carbon\Carbon;
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
        $currentDateTime = Carbon::now();
        $expiresAt = $currentDateTime->addMonth();

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $admin = Admin::where('email', $request->email)->first();
            $token = $admin->createToken('auth_token')->accessToken;
            $token->admin_id = $admin->id;
            $token->expires_at = $expiresAt;
            $token->user_id = null;

            $token->save();

            $response = ['admin' => $admin, 'token' => $token];
            return response()->json($response, 200);
        }

        return redirect()->route('admin.login')->with('message', 'Credenciais inválidas');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
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

    public function logout(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        $tokens = PersonalAccessTokens::where('user_id', $admin->id)->get();

        foreach ($tokens as $token) {
            $token->delete();
        }
        
        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }
}
