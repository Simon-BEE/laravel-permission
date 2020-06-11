@extends('layouts.app')

@section('content')
    <div class="text-center mb-5 border p-8 bg-white">
        <h1 class="text-5xl font-semibold tracking-widest">@yield('code')</h1>
    </div>
    @yield('message')
    <div class="mt-10 text-center">
        <a href="{{ route('home') }}" class="text-purple-400">Back to home</a>
    </div>
@endsection
