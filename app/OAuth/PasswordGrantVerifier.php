<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 02/12/2016
 * Time: 13:16
 */

namespace CodeProject\OAuth;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}