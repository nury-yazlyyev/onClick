@extends('client.layout.app')

@section('content')
@include('client.alert.app')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div>
        <div class="text-center">
            <div class="display-3 fw-bold" style="color: #FFA500;">
                Sebedim.com
            </div>
            <div class="h4">
                Sign In
            </div>
        </div>
        <div>
            <form action="{{ route('signin') }}" method="post">
                @csrf
                <label for="email">Email</label>
                <div>
                    <input type="text" id="email" name="email" class="w-100" value="{{ old('email') }}">
                    @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="phone">Phone</label>
                <div>
                    <input type="text" id="phone" name="phone" class="w-100" value="{{ old('phone') }}">
                    @error('phone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="username">Username</label>
                <div>
                    <input type="text" id="username" name="username" class="w-100" value="{{ old('username') }}">
                    @error('username')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="password">Password</label>
                <div>
                    <input type="text" id="password" name="password" class="w-100">
                    @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="password_confirmation">Password_confirmation</label>
                <div>
                    <input type="text" id="password_confirmation" name="password_confirmation" class="w-100">
                    @error('password_confirmation')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary w-50">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection