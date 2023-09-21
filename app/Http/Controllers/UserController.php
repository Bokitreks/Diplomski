<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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
                $request->session()->put('user', ['id' => $user->id, 'username' => $user->username, 'role_id' => $user->role_id]);
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

    public function getAllUsersAction() {
        $users = User::all();
        return $users;
    }

    public function editUserAction(Request $request) {

        $id = $request->input('userId');
        $username = $request->input('username');
        $email = $request->input('email');
        $role_id = $request->input('role_id');

        $user = User::find($id);

        if (!$user) {
            // Handle the case where the user doesn't exist
            return response()->json('Korisnik nije pronadjen', 404);
        }

        // Check if the password input is provided and not empty
        if ($request->has('newPassword') && !empty($request->input('newPassword'))) {
            $password = md5($request->input('newPassword'));
            $user->password = $password; // Update the password
        }

        // Update the user's other attributes
        $user->username = $username;
        $user->email = $email;
        $user->role_id = $role_id;
        $user->save();

        // Return a response indicating success
        return response()->json('Korsinik uspesno izmenjen', 200);
    }

    public function deleteUserAction(Request $request) {
        $userId = $request->input('userId');
        $user = User::find($userId);

        if (!$user) {
            return response()->json('Korisnik nije pronadjen', 404);
        }

        try {
            $user->delete();
            return response()->json('Korisnik uspesno obrisan', 200);
        } catch (Exception $e) {
            return response()->json('Greska prilikom brisanja korisnika' . $e, 500);
        }
    }

    public function addUserAction(Request $request) {
        $username = $request->input('username');
        $password = md5($request->input('password'));
        $email = $request->input('email');
        $role_id = $request->input('role_id');

        try {
            User::create([
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'role_id' => $role_id,
            ]);

            return response()->json('Novi korisnik uspesno dodat', 201);
        } catch (Exception $e) {
            return response()->json('Greska prilikom dodavanja novog korisnika', 400);
        }
    }


}
