<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createUser(Request $request){
        $array['error'] = '';
//validando
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' =>'required'
    ];
        //validando dados:
        $validator = validator::make($request->all(), $rules);
        if($validator->fails()){
            $array['error'] = $validator->messages();
            return $array;
        }
        //pegando dados
        $email = $request->input('email');
        $password = $request->input('password');

        //criando novo usuário
        $newUser = new User();
        $newUser->email = $email;
        $newUser->password = password_hash($password, PASSWORD_DEFAULT);
        $newUser->token = '';
        $newUser->save();

        return $array;
    }

    public function login(Request $request){

        $array['error'] = '';

        //processo de credenciais
        $creds = $request->only('email', 'password');

        if(Auth::attempt($creds)){

            $user = User::where('email',$creds['email'])->first();


            $item = time().rand(0,9999);
            $token = $user->createToken($item)->plainTextToken;

            $array['token'] = $token;

        }else{

            $array['error'] = 'email e/ou senha incorretos';

        };


        return $array;

    }

    public function logout(Request $request){

        $array['error'] = '';

        $user = $request->user();

        $user->tokens()->delete();

        return $array;

    }
}
