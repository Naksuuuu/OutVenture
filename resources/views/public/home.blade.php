@extends('layouts.app')

@section('title', 'home')

@section('content')
    <div class="container">
        <h1>Selamat Datang, {{ Auth::user()->nama_lengkap ?? 'Guest' }}!</h1>

        <hr>

        @auth
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" style="background-color: red; color: white;">Logout</button>
            </form>
        @endauth

    </div>
@endsection
