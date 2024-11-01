@extends('layouts.auth')
@section('title', 'Halaman Login')
@section('masuk')
    <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Login</h2>
        <div class="input-field">
            <input type="text" name="email" id="email" required>
            <label>Enter your email</label>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" required>
            <label>Enter your password</label>
        </div>
        <div class="forget">
            <label for="remember">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <p>Remember me</p>
            </label>
            <a href="#" style="color: black;">Forgot password?</a>
        </div>
        <button type="submit">Log In</button>
    </form>
@endsection
