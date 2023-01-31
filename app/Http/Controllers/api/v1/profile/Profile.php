<?php

namespace App\Http\Controllers\api\v1\profile;

use App\Models\Darkhast;
use App\Models\Faktoor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Profile
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'address' => $user->address,
                'charity' => $user->charity,
            ],
        ]);
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'phone' => ['regex:/(09)[0-9]{9}/','digits:11','numeric'],
            'email' => ['string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['confirmed', Password::defaults()],
            'old_password' => Rule::requiredIf($request->has('password')),
        ]);

        $data = [];
        if ($request->has('name')){
            $data['name'] = $request->input('name');
        }
        if ($request->has('phone')){
            $data['phone'] = $request->input('phone');
        }
        if ($request->has('email')){
            $data['email'] = $request->input('email');
        }
        if ($request->has('address')){
            $data['address'] = $request->input('address');
        }
        if ($request->has('password')){
            if (Hash::check($request->input('old_password'),Auth::user()->password)){
                $data['password'] = Hash::make($request->input('password'));
            }else{
                return response()->json([
                    'message' => 'بروزرسانی انجام نشد!',
                    'errors' => ['old_password' => 'پسورد قدیمی به درستی وارد نشده است'],
                    'status' => 'error'
                ]);
            }
        }

        try {
            \App\Models\User::query()->where('id',Auth::id())->update($data);

            return response()->json([
                'message' => 'اطلاعات کاربری شما با موفقیت بروزرسانی شد.',
                'status' => 'success'
            ]);
        }catch (Exception $exception){
            return response()->json([
                'message' => 'بروزرسانی انجام نشد!',
                'error' => $exception->getMessage(),
                'status' => 'error'
            ]);
        }
    }

}
