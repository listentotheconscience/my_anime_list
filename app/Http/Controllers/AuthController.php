<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function signup(SignUpRequest $request)
    {
        $image = file_get_contents($request->image);
        Storage::disk('s3')->put('users/' . basename($request->image), $image);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => 'users/' . basename($request->image)
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function login(LogInRequest $request)
    {
        if (!Auth::attempt($request->input())) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function me()
    {
        return $this->success(UserResource::make(auth()->user()));
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

}
