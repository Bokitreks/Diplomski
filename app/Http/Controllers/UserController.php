<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{

    public function login(){
        return view('pages.login',$this->data);
    }

    public function register(){
        return view('pages.register',$this->data);
    }

    public function registerAction(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|max:50|unique:users',
            'password' => 'required|min:6|max:50',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hashPassword = md5($password);
        $checkDuplicateEmail = self::checkDuplicateEmail($email);
        if($checkDuplicateEmail) {
            try {
                User::create([
                    'username' => $username,
                    'password' => $hashPassword,
                    'email' => $email,
                    'role_id' => 2
                ]);
                return Response()->json('Uspesna registracija', 201);
            } catch(Exception $e) {
                return Response()->json($e, 400);
            }
        } else {
            return Response()->json('Email vec zauzet', 200);
        }
    }

    public function loginAction(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $hashPassword = md5($password);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors(), 400);
        }

        $user = User::where('username', $username)->first(); //TODO make username unique
        if($user) {
            $checkCredentials = $user->password == $hashPassword ? true : false;
            if($checkCredentials) {
                $request->session()->put('user', ['id' => $user->id, 'username' => $user->username]);
                return Response()->json('Dobrodosli ' . $user->username, 202);
            } else {
                return Response()->json('Pogresna sifra!', 200);
            }
        }
        else {
            return Response()->json('Korisnik ne postoji, kreirajte nalog!', 200);
        }
    }

    public function logoutAction(Request $request) {
        $request->session()->forget('user');
        return Response()->json('Odjavili ste se', 200);
    }

    public function checkDuplicateEmail($emailToCheck) {
        $allUsers= User::all();
        foreach($allUsers as $user) {
            if($user['email'] == $emailToCheck) {
                return;
            }
        }
        return true;
    }
}
