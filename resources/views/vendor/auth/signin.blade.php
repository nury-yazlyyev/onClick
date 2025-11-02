@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-center vh-100 w-100">
        <div>
            <div class="text-center mb-3">
                <span class="fw-bold display-3">on</span><span class="fw-bold display-3" style="color: orange;">Click</span><span class="fw-bold display-3">.</span>
                <div class="fw-semibold">
                    Bu yerde ahli mesele bir <span class="fw-semibold" style="color: orange;">Click-de</span> cozulyar.
                </div>
            </div>
            <div>
                <form action="{{ route('seller') }}" method="post">
                    @csrf
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
                    <label for="shop_name">Shop Name</label>
                    <div>
                        <input type="text" id="shop_name" name="shop_name" class="w-100" value="{{ old('shop_name') }}">
                        @error('shop_name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-center mt-2">
                        <button type="submit" class="btn w-50 text-white fw-semibold" style="background-color: orange;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection