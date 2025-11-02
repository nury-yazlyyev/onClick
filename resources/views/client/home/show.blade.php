@extends('client.layout.app')

@section('content')
<div class="container py-4">

    {{-- Alert messages --}}
    @include('client.alert.app')

    <div class="row g-4 align-items-start">

        {{-- Ürün görseli --}}
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset($product->img_path) }}" alt="{{ $product->name }}" class="img-fluid rounded-3">
            </div>
        </div>

        {{-- Ürün detayları --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h4 class="fw-bold mb-2 text-warning">{{ $product->name }}</h4>

                <div class="mb-2">
                    <span class="fw-semibold text-secondary">{{ __('app.category') }}:</span>
                    <span class="fw-bold">{{ $product->category->name ?? 'N/A' }}</span>
                </div>

                <div class="mb-2">
                    <span class="fw-semibold text-secondary">{{ __('app.price') }}:</span>
                    <span class="fw-bold text-warning" style="font-size: 1.2rem;">{{ $product->price }} TMT</span>
                </div>

                <div class="mb-3">
                    <span class="fw-semibold text-secondary">{{ __('app.description') }}:</span>
                    <p class="mb-0 mt-1">{{ $product->description }}</p>
                </div>

                <div class="d-flex gap-3 mt-auto">
                    <button class="btn btn-warning text-white fw-semibold flex-grow-1">
                        <i class="bi bi-lightning-charge-fill me-1"></i> Quick Buy
                    </button>

                    <button class="btn btn-outline-warning fw-semibold flex-grow-1" onclick="Orders2(this)">
                        <i class="bi bi-basket me-1"></i> {{ __('app.add_to_cart') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- Satıcı bilgisi --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <div class="mb-2">
                    <span class="fw-semibold text-secondary">Seller:</span>
                    <span class="fw-bold text-dark">{{ $product->vendor->name ?? 'Unknown' }}</span>
                </div>

                <div class="mb-2">
                    <span class="fw-semibold text-secondary">Followers:</span>
                    <span class="fw-bold">{{ $user->followers_count ?? 0 }}</span>
                </div>

                <div class="mb-2">
                    <span class="fw-semibold text-secondary">Followings:</span>
                    <span class="fw-bold">{{ $user->followings_count ?? 0 }}</span>
                </div>

                {{-- Rating --}}
                <div class="d-flex align-items-center text-warning my-2">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                    <span class="text-secondary ms-1" style="font-size: 13px;">(237)</span>
                </div>

                {{-- View Store --}}
                <form action="{{ route('vendor.profile', $product->vendor->id) }}" class="mb-2">
                    <button class="btn btn-outline-warning w-100 fw-semibold">
                        <i class="bi bi-shop me-1"></i> {{ __('app.view_store') }}
                    </button>
                </form>

                {{-- Follow / Unfollow --}}
                <form action="{{ route('follow', $vendor ?? $product->vendor->id) }}" method="post">
                    @csrf
                    @if (auth()->check() && auth()->user()->isFollow($user->id))
                        <button type="submit" class="btn btn-warning w-100 fw-semibold text-white">
                            <i class="bi bi-person-check-fill me-1"></i> {{ __('app.following') }}
                        </button>
                    @else
                        <button type="submit" class="btn btn-outline-warning w-100 fw-semibold">
                            <i class="bi bi-person-plus me-1"></i> {{ __('app.follow') }}
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
