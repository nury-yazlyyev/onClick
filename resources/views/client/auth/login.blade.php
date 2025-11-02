@extends('client.layout.app')

@section('content')
@include('client.alert.app')
<div class="container-xxl">
    <div class="card">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <label for="username">Username</label>
            <div>
                <input type="text" name="username" id="username" class="" value="{{ old('username') }}">
                @error('username')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <label for="password">Password</label>
            <div>
                <input type="text" name="password" id="password" class="my-2" value="{{ old('username') }}">
                @error('password')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection