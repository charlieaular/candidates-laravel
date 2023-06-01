<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Types\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller {

    public function auth(Request $request) {
        // $username = $request->username;
        // $password = $request->password;
        $username = "username";
        $password = "password";

        $key = "key";

        $data = Cache::remember($key, 10, function() {
            return [
                "uno" => "uno",
                "dos" => "dos",
                "ters" => "ters",
            ];
        });

        
        $casos = Role::Manager;

        $users = User::all();

        return [
            "username" => $username,
            "password" => $password,
            "data" => $data,
            "casos" => $casos,
            "users" => $users,
            "d" => Role::cases()
        ];
    }
}
