<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

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
                return response('Successfully registered',201);
            } catch(Exception $e) {
                return response($e,400);
            }
        } else {
            return response('Duplicate email',200);
        }
    }

    public function loginAction(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $hashPassword = md5($password);

        $checkIfUserExists = User::where('username', $username)->first(); //TODO make username unique
        if($checkIfUserExists) {
            $checkCredentials = $checkIfUserExists->password == $hashPassword ? true : false;
            if($checkCredentials) {
                return  response("Welcome " . $checkIfUserExists->username, 200);
            } else {
                return response('Wrong password', 200);
            }
        }
        else {
            return response('User does not exists, please create an account!', 200);
        }
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
