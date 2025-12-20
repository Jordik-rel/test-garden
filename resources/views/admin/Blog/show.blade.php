@extends('admin.admin')
@section('title')
    <title>{{ $blog->title }} - Green Connect</title>
@endsection

@section('adminContent')

    <div class="flex flex-col">
        <div class="mb-1">
            <a href="{{route('admin.invalidate')}}"><i class="fa-solid fa-arrow-left text-green-700 font-extralight"></i></a>
        </div>
        <div class="mb-3 h-[40vh] w-full border-slate-100 border-1 hover:border-green-600 hover:border-2 rounded-md">
            <img src="{{$blog->image ? asset('storage/' . $blog->image) : asset('logo.png')}}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="mb-2 flex flex-col justify-center items-center">
            <h2>{{$blog->title}}</h2>
            <p>{{$blog->subtitle}}</p>
        </div>
        <div class="border-slate-100 border-1 hover:border-green-600 hover:border-2 rounded-md p-4">
            {{ $blog->description }}
        </div>
    </div>

@endsection