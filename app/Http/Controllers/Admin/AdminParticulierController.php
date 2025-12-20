<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ParticulierRequest;
use App\Http\Requests\Admin\UpdateParticulierRequest;
use App\Mail\AdminParticulierCreation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminParticulierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $particuliers = User::where('role','user')->paginate(10);
        return view('admin.particulier.index',['particuliers'=>$particuliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $particulier = new User();
        return view('admin.particulier.form',['particulier'=>$particulier]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticulierRequest $request)
    {
        $data = $request->validated();
        $password = $data['password'];
        $data['password'] = Hash::make($password);
        if($request->hasFile('profile_photo_path')){
            $originalName = $request->file('profile_photo_path')->getClientOriginalName();
            $data['profile_photo_path'] = $request->file('profile_photo_path')->storeAs('Particulier',$originalName,'public');
        }
        $particulier = User::create($data);
        Mail::to($particulier->email)->send(new AdminParticulierCreation($particulier,$password));
        return redirect()->route('admin.particulier.index')->with('succes','Particulier créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $particulier)
    {
        return view('admin.particulier.show',[
            'particulier'=>$particulier,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $particulier)
    {
         return view('admin.particulier.form',['particulier'=>$particulier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticulierRequest $request, User $particulier)
    {
        $data = $request->validated();
        $password = $data['password'];
        $data['password'] = Hash::make($password);
        if ($request->hasFile('profile_photo_path')) {
            if ($particulier->image && Storage::disk('public')->exists($particulier->image)) {
                Storage::disk('public')->delete($particulier->image);
            }
            $originalName = $request->file('profile_photo_path')->getClientOriginalName();
            $data['profile_photo_path'] = $request->file('profile_photo_path')->storeAs('Particulier',$originalName,'public');
        } 
        $particulier->update($data);
        Mail::to($particulier->email)->send(new AdminParticulierCreation($particulier,$password));
        return redirect()->route('admin.particulier.index')->with('update','Information particulier mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $particulier)
    {
        $particulier->delete();
        return redirect()->route('admin.particulier.index')->with('delete','Particulier supprimée avec succès');
    }
}
