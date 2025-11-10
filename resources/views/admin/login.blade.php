@extends('admin.partials.app')

@section('content')
@include('client.alert.app')
<div class="container-xxl">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div>
            <div>
                <form action="{{ route('admin.login') }}" method="post">
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
                    <label for="phone">Phone</label>
                    <div>
                        <input type="text" id="phone" name="phone" class="w-100">
                        @error('phone')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <label for="email">Email</label>
                    <div>
                        <input type="text" id="email" name="email" class="w-100">
                        @error('email')
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