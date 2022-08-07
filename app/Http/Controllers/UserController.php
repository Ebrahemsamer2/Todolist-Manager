<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Tokens\UserTokenRequest;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function getTokens(){
        return view('user.dashboard', [
            'tokens' => request()->user()->tokens,
        ]);
    }

    public function store(UserTokenRequest $request)
    {
        $token = User::createNewToken( $request );
        return view('user.token', [
            'token' => $token
        ]);
    }

    public function delete(PersonalAccessToken $token)
    {
        $token->delete();
        return redirect()->back()->with('message', 'Token has been deleted.');
    }
}
