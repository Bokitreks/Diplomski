<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
class UserController extends HomeController
{
    public function registerAction(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');

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
