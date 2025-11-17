@extends('client.layout.app')

@section('content')

{{-- Alert messages --}}
@include('client.alert.app')

<div class="container">
    <div>
        @foreach ($vendors as $vendor)
        <div class="d-flex justify-content-between pt-2">
            <div class="fw-bolder h5">
                {{ $vendor->name }}
            </div>
            <div class="text-center">
                <form action="{{ route('follow', $vendor->id) }}" method="post">
                    @csrf
                    @if ($user_me && $user_me->isFollow($vendor->id))
                    <button type="submit" class="btn btn-warning w-100 fw-semibold text-white">{{ __('app.following') }}</button>
                    @else
                    <button type="submit" class="btn btn-outline-warning w-100 fw-semibold">{{ __('app.follow') }}</button>
                    @endif
                </form>
            </div>
        </div>
        <div class="border-bottom pb-1 text-secondary" style="font-size: 13px;">
            <span class="fw-semibold ">Followers: </span><span class="fw-bolder">{{ $vendor->followers()->count() }}</span>
            <span class="fw-semibold ms-2">Products: </span><span class="fw-bolder">{{ $vendor->products()->count() }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection