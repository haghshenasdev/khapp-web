<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class AuthController extends baseApiAuth
{
    public function login(Request $request)
    {
        $validator =  validator($request->all(),[
            'phone' => ['required','regex:/(09)[0-9]{9}/','digits:11','numeric'],
            'password' => ['required'],
            'device_name' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
            ]);
        }
        if (Auth::attempt(['phone' => $request->input('phone'),'password' => $request->input('password')])){
            $user = Auth::user();
            $token = $user->createToken($request->device_name)->plainTextToken;

            return response()->json([
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token,
                ],
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'errors' => [
                    'massage' => 'رمز عبور یا نام کاربری درست نیست'
                ],
                'status' => 'error'
            ]);
        }

    }

    public function register(Request $request,$charity): \Illuminate\Http\JsonResponse
    {
        $validator =  validator($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','regex:/(09)[0-9]{9}/','digits:11','numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'device_name' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
        ]);
        }

        $inputs = $request->all();
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['charity'] = $charity;
        $user = User::query()->create($inputs);
        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ],
            'status' => 'success'
        ]);
    }
}
