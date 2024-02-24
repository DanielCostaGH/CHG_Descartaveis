<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserAddAdressRequest;
use App\Models\PersonalAccessTokens;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('user')->user();
        $addresses = UserAddress::where('user_id', $user->id)->get();
        return view('user.index', [
            'userData' => $user,
            'userAddresses' => $addresses,
        ]);
    }

    public function basicInfo(){
        $user = auth('user')->user();
        return view('user.basic-info', [
            'userData' => $user,
        ]);
    }

    public function adresses(){
        $user = auth('user')->user();
        $addresses = UserAddress::where('user_id', $user->id)->get();
        return view('user.adresses', [
            'userData' => $user,
            'userAddresses' => $addresses,
        ]);
    }

    public function favorites(){
        return view('user.favorites');
    }

    public function orders(){
        return view('user.orders');
    }


    public function showLoginForm()
    {

        return view('user.login');
    }

    public function login(Request $request)
    {
        $currentDateTime = Carbon::now();
        $expiresAt = $currentDateTime->addMonth();

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('user')->attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token_user')->accessToken;
            $token->user_id = $user->id;
            $token->expires_at = $expiresAt;
            $token->admin_id = null;
            
            $token->save();

            $response = ['user' => $user, 'token' => $token];
            return response()->json($response, 200);
        } else {
            return redirect()->route('user.login')->with('message', 'Credenciais inválidas');
        }
    }

    public function addAddress(Request $request, $id)
    {
        try {
            $endereco = [
                'zipcode'          => $request->input('zipcode'),
                'city'             => $request->input('city'),
                'state'            => $request->input('state'),
                'number'           => $request->input('number'),
                'street'           => $request->input('street'),
                'neighborhood'     => $request->input('neighborhood'),
                'user_id'          => $id,
            ];

            UserAddress::create($endereco);

            return response()->json(['message' => 'Endereço adicionado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao adicionar endereço'], 500);
        }
    }

    public function getUserAddresses()
    {
        $user = auth('user')->user();

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $addresses = UserAddress::where('user_id', $user->id)->get();
        $mainAddress = $addresses->where('is_main', true)->first();

        return response()->json(['addresses' => $addresses, 'main_address' => $mainAddress]);
    }


    public function setMainAddress(Request $request)
    {
        $user = auth('user')->user();
        $addressId = $request->input('addressId');


        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        UserAddress::where('user_id', $user->id)->update(['is_main' => false]);

        $address = UserAddress::find($addressId);

        if ($address) {
            $address->is_main = true;
            $address->save();

            return response()->json(['message' => 'Endereço principal atualizado com sucesso']);
        } else {
            return response()->json(['error' => 'Endereço não encontrado'], 404);
        }
    }

    public function updateAddress(Request $request)
    {
        $user = auth('user')->user();
        $addressId = $request->input('id');

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $address = UserAddress::where('id', $addressId)
            ->where('user_id', $user->id)
            ->first();

        if (!$address) {
            return response()->json(['error' => 'Endereço não encontrado'], 404);
        }

        $updatedFields = $request->only([
            'zipcode',
            'city',
            'state',
            'number',
            'street',
            'neighborhood',
            'user_id',
        ]);

        $address->update($updatedFields);

        return response()->json(['message' => 'Endereço atualizado com sucesso', 'address' => $address]);
    }



    public function deleteAddress($addressId)
    {
        $user = auth('user')->user();

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $address = UserAddress::where('user_id', $user->id)->where('id', $addressId)->first();

        if ($address) {
            $address->delete();
            return response()->json(['message' => 'Endereço deletado com sucesso']);
        } else {
            return response()->json(['error' => 'Endereço não encontrado'], 404);
        }
    }





    public function updateBasic(UserUpdateRequest $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        if (password_verify($request->senhaAtual, $user->password)) {
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->phone = $request->telefone;
            $user->document = $request->cpf;
            $user->password = bcrypt($request->novaSenha);
            $user->save();
            return response()->json(['message' => 'Perfil atualizado com sucesso']);
        }
        return response()->json(['message' => 'senha atual incorreta']);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('name');
        $user->phone = $request->input('tell');
        $user->document = $request->input('document');
        $user->save();

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'user' => $user->makeHidden('password')
        ], 201);
    }

    public function getUser() {
        $user = auth()->user();
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(null);
        }
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
        $user = User::where('email', $request->email)->first();

        $tokens = PersonalAccessTokens::where('user_id', $user->id)->get();

        foreach ($tokens as $token) {
            $token->delete();
        }
        
        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }
}
