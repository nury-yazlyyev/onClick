@extends('client.layout.app')

@section('content')
@include('client.alert.app')
<div class="container-xxl">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div>
            <div class="text-center">
                <div class="display-3 fw-bold" style="color: #FFA500;">
                    Sebedim.com
                </div>
                <div class="h4">
                    Log In
                </div>
            </div>
            <div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
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
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary w-50">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection