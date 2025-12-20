<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function update(AccountRequest $request)
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return redirect()->route('jardinier.myaccount')->with('succes','Profile modifié avec succès');
    }

    public function password(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'password'=>['required','current_password'],
            'new_password'=>['required','confirmed']
        ]);
        
        $request->user()->update([
             'password' => Hash::make($validated['new_password']),
        ]);

         return redirect()->back()->with('update','Mot de passe modifié avec succès');
    }
}
