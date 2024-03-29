@extends('layouts.master')

@section('title', 'Login Page')

@section('content')
    <div class="login-form">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <div class="form-group ">
                    <span class=" mb-3 text-danger">{{ $message }}</span>
                </div>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <span class=" text-danger">{{ $message }}</span>
            @enderror
            <button class="au-btn au-btn--block au-btn--green mt-3  m-b-20" type="submit">log in
            </button>
        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
