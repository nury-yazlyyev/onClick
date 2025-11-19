@extends('client.layout.app')

@section('content')

<div class="container-xxl">

    @include('client.alert.app')

    {{-- MOBILDE FİLTRE BUTONU --}}
    <div class="d-lg-none my-3">
        <button class="btn btn-warning text-white fw-semibold w-100"
                data-bs-toggle="collapse"
                data-bs-target="#mobileFilters">
            Filtreleri Göster
        </button>
    </div>

    <div class="row mt-4">

        {{-- SOL FİLTRE (Desktop: sabit | Mobile: collapse) --}}
        <div class="col-lg-2">

            <div id="mobileFilters"
                 class="collapse d-lg-block">

                <div class="border-end pe-3">

                    <form action="{{ route('home') }}" method="get">

                        <select class="form-select mt-2" name="VendorId">
                            <option value="">Dükkanlar</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>

                        <select class="form-select mt-3" name="CategoryId">
                            <option value="">Kategoriya</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <div class="my-3">
                            <button type="submit" class="btn btn-warning text-white w-100 mb-2">Gönder</button>
                            <a href="{{ route('home') }}" class="btn btn-outline-warning w-100">Reset</a>
                        </div>
                    </form>

                    {{-- AUTH --}}
                    <div class="mt-3">

                        @if ($is_auth)

                            @if ($is_auth->is_seller)
                                <a href="{{ route('vendor.dashboard') }}"
                                   class="btn btn-outline-success w-100 fw-semibold text-start mb-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('seller') }}"
                                   class="btn btn-outline-success w-100 fw-semibold text-start mb-2">
                                    Create Store
                                </a>
                            @endif

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-outline-danger fw-semibold w-100 text-start">
                                    Log Out
                                </button>
                            </form>

                        @else

                            <a href="{{ route('signin') }}"
                               class="btn btn-outline-success fw-semibold w-100 text-start mb-2">
                                Sign In
                            </a>

                            <a href="{{ route('login') }}"
                               class="btn btn-outline-secondary fw-semibold w-100 text-start">
                                Log In
                            </a>

                        @endif
                    </div>

                </div>

            </div>
        </div>

        {{-- ANA İÇERİK --}}
        <div class="col-lg-10">

            {{-- Banner 1 --}}
            <section class="splide mb-4" id="banner">
                <h3 class="fw-bold mb-3">🆕 Taze Gelenler</h3>
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($products as $product)
                        <li class="splide__slide">
                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <a href="{{ route('show', $product->id) }}">
                                    <img src="{{ asset('storage/'.$product->img_path) }}"
                                         class="card-img-top object-fit-cover"
                                         style="height:200px;">
                                </a>
                                <div class="card-body">
                                    <h6 class="fw-bold text-truncate">{{ $product->name }}</h6>
                                    <p class="text-muted small mb-1">Satıcı: {{ $product->vendor->name }}</p>
                                    <p class="text-muted small mb-2">Kategori: {{ $product->category->name }}</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-danger">{{ $product->price }} TMT</span>
                                        <a href="{{ route('show', $product->id) }}"
                                           class="btn btn-warning btn-sm text-white fw-semibold">
                                           İncele
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            {{-- Banner 2 --}}
            <section class="splide mb-4" id="banner-2">
                <h3 class="fw-bold mb-3">🔥 En Çok Görüntülenenler</h3>
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($products as $product)
                        <li class="splide__slide">
                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <a href="{{ route('show', $product->id) }}">
                                    <img src="{{ asset('storage/'.$product->img_path) }}"
                                         class="card-img-top object-fit-cover"
                                         style="height:200px;">
                                </a>
                                <div class="card-body">
                                    <h6 class="fw-bold text-truncate">{{ $product->name }}</h6>

                                    <p class="text-muted small mb-1">Satıcı: {{ $product->vendor->name }}</p>
                                    <p class="text-muted small mb-2">Kategori: {{ $product->category->name }}</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-danger">{{ $product->price }} TMT</span>
                                        <a href="{{ route('show', $product->id) }}"
                                           class="btn btn-warning btn-sm text-white fw-semibold">
                                           İncele
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
</div>

    <script src="./js/splide.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const banners = ['#banner', '#banner-2'];
            banners.forEach(id => {
                new Splide(id, {
                    type: 'loop',
                    autoplay: true,
                    interval: 2500,
                    pauseOnHover: true,
                    arrows: true,
                    gap: '1rem',
                    perPage: 6,
                    breakpoints: {
                        1400: {
                            perPage: 5
                        },
                        1200: {
                            perPage: 5
                        },
                        992: {
                            perPage: 4
                        },
                        768: {
                            perPage: 3
                        },
                        576: {
                            perPage: 2
                        }
                    }
                }).mount();
            });
        });
    </script>
</div>

@endsection