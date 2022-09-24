<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
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
                    'password' => $password,
                    'email' => $email,
                    'role_id' => 2
                ]);
                return response('Successfully registered',201);
            } catch(Exception $e) {
                return response($e,400);     
            }
        } else {
            return response('Duplicate email',200);
        }
    }

    public function loginAction(Request $request) {

    }

    public function checkDuplicateEmail($emailToCheck)
    {
        $allUsers= User::all();
        foreach($allUsers as $user) {
            if($user['email'] == $emailToCheck) {
                return;
            }
        }
        return true;
    }
}
