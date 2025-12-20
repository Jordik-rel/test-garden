<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\BlogRequest;
use App\Mail\AdminBlogCreation;
use App\Mail\AdminBlogStatus;
use App\Mail\JardinierBlogCreation;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('status',true)->paginate(10);
        // return view('admin.Blog.index',['blog',$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog = new Blog();
        return view('jardinier.profile.blog.form',['blog'=>$blog]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $originalName = $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs('Blog/Post',$originalName,'public');
        }
        // dd($request->user()->email);
        $blog = Blog::create($data);
        // Envoie de mail à l'administrateur
        $admin = User::where('role','admin')->first();
        Mail::to($admin->email)->send(new AdminBlogCreation());
        //Envoie de mail au créateur du post
        // Mail::to($request->user()->email)->send(new JardinierBlogCreation($blog));
        return redirect()->route('jardinier.myaccount')->with('succes','Un nouvel article vient d\'être créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.Blog.show',['blog'=>$blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('jardinier.profile.blog.form',['blog'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $originalName = $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs('Blog/Post',$originalName,'public');
        }
        $data['status'] = 2;
        $blog->update($data);
        return redirect()->route('jardinier.myaccount')->with('update','Votre article vient d\'être modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('jardinier.myaccount')->with('delete','Votre article vient d\'être supprimé');
    }

    /**
     * Affichage des demandes de publication d'article
     */
    public function invalidate()
    {
        $blogs = Blog::where('status',2)->paginate(15);
        // dd($blogs);
        return view('admin.Blog.index',['blogs'=>$blogs]);
    }

    // public function viewblog(Blog $blog)
    // {
    //     return view('admin.Blog.show',['blog'=>$blog]);
    // }

    /**
     * Analyse de status de publication ou non d'un article
     */
    public function analyse(Request $request,Blog $blog)
    {
        // dd($blog->jardinier->user->email);
        $blog->update($request->validate([
            'status'=>['required','integer','in:0,1,2']
        ]));
        Mail::to($blog->jardinier->user->email)->send(new AdminBlogStatus($blog));
        return redirect()->back()->with('message', 'Analyse fait effectué avec succès');
    }
}
