<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Profile extends Controller
{
    public function index()
    {
        return view('dashboard.profile',[
            'data' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validData = $request->validate([
            'name' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'phone' => ['regex:/(09)[0-9]{9}/','digits:11','numeric',Rule::unique('users')->ignore($user->id)],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validData);
        $user->save();

        return back()->with('success','پروفایل باموفقیت به روزرسانی شد.');
    }
}
