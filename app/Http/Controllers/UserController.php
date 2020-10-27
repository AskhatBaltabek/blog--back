<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    public function users(Request $request) {
        $users = User::all();

        return $users;
    }

    public function user(Request $request) {
        $user = $request->user();
        $user->roles;
        return $user;
    }

    public function deleteUser(Request $request) {
        $user = User::find($request->id);
        $user->delete();
        return $user;
    }

    public function storeUser(Request $request) {
        $response = ['message' => ''];
        try {
            if(isset($request->id)) {
                $user = User::find($request->id);
            } else {
                $user = new User;
            }
            $user->name = $request->name;
            $user->email = $request->email;

            if(isset($request->password)) {
                $user->password = Hash::make($request->password);
                $user->password_show = $request->password;
            }

            $user->save();
            $response['message'] = 'Saved';
            return response()->json($response);
        } catch (Exception $e) {
            return respone()->json($e);
        }

    }

    public function test() {
        dd('test');
    }
}
