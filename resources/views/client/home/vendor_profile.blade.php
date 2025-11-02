@extends('client.layout.app')

@section('content')
<div class="container-xxl">
    <div class="d-flex">
        {{-- SOL PROFİL PANELİ --}}
        <div class="col-md-3 border-end pe-0">
            <div class="d-flex flex-column align-items-center position-sticky top-0 vh-100 bg-white shadow-sm" style="width: 100%;">
                <div class="text-center py-4 w-100 border-bottom">
                    <h5 class="fw-bolder text-dark mb-1">{{ $vendor->name }}</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">@vendor</p>
                </div>

                <div class="d-flex justify-content-around text-center w-100 py-3 border-bottom">
                    <div>
                        <div class="fw-bold">{{ $vendor->products_count }}</div>
                        <div class="text-secondary small">Products</div>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $vendor->followers_count }}</div>
                        <div class="text-secondary small">Followers</div>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $vendor->followings_count }}</div>
                        <div class="text-secondary small">Followings</div>
                    </div>
                </div>

                <div class="p-3 w-100">
                    <form action="{{ route('follow', $vendor->id) }}" method="post">
                        @csrf
                        @if (auth()->check() && auth()->user()->isFollow($vendor->user_id))
                        <button type="submit" class="btn btn-warning w-100 fw-semibold text-white">
                            <i class="bi bi-person-check me-1"></i> Following
                        </button>
                        @else
                        <button type="submit" class="btn btn-outline-warning w-100 fw-semibold">
                            <i class="bi bi-person-plus me-1"></i> Follow
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9 ps-2">
            <div class="row row-cols-5 g-3 mt-2">
                @forelse($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('show', $product->id ) }}" class="text-decoration-none">
                            <img src="{{ asset($product->img_path) }}" alt="" class="img-fluid">
                        </a>
                        <div class="p-2 d-flex flex-column">
                            <div class="fw-bold">{{ $product->name }}</div>
                            <div id="stars-2" style="font-size: 12px;">
                                <i onclick="addPoint(this, 1)" class="bi bi-star text-warning"></i>
                                <i onclick="addPoint(this, 2)" class="bi bi-star text-warning"></i>
                                <i onclick="addPoint(this, 3)" class="bi bi-star text-warning"></i>
                                <i onclick="addPoint(this, 4)" class="bi bi-star text-warning"></i>
                                <i onclick="addPoint(this, 5)" class="bi bi-star text-warning"></i>
                                <span class="text-secondary" id="starsNum">(0)</span>
                            </div>
                            <div class="mt-1" style="font-size: 13px;">
                                <span class="fw-semibold">Satyjy: </span>{{ $product->vendor->name ?? 'Nabelli' }}
                            </div>
                            <div class="my-1" style="font-size: 13px;">
                                <span class="fw-semibold">{{ __('app.category') }}: </span>{{ $product->category->name ?? 'Nabelli' }}
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bolder" style="font-size: 13px; color: #FF6620;">{{ __('app.price') }}: </span>
                                <span class="text-success fw-bold ms-1" style="color: #FF6620;">{{$product->price}} TMT</span>
                            </div>
                            <a href="{{ route('show', $product->id ) }}" class="btn w-100 mt-auto fw-semibold text-white" style="background-color: #FF6620;">
                                {{ __('app.view_product') }} <i class="bi bi-basket text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="h1 fw-bold">Haryt Tapylmady...</div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@endsection