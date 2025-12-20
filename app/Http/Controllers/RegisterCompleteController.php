<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterCompleteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterCompleteController extends Controller
{
    public function create(){
        return view('auth.register-complete');
    }

     public function store(RegisterCompleteRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = Auth::user()
        ->update($data);
        // dd(Auth::user());
        return redirect()->route('register.finish');
    }
}
