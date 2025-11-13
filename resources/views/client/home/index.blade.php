@extends('client.layout.app')

@section('content')
<div class="container-xxl">
    @include('client.alert.app')
    <div class="d-flex mt-4">
        <div class="col-2">
            <div class="d-flex flex-column position-fixed vh-100 border-end z-10 pe-2" style="width: 210px;">
                <form action="{{ route('home') }}" method="get">
                    <select class="form-select mt-2" name="VendorId" aria-label="Default select example">
                        <option value="">Dukanlar</option>
                        @foreach ($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-select mt-3" name="CategoryId" aria-label="Default select example">
                        <option value="">Kategoriya</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        <button type="submit" class="btn btn-warning text-white my-3">Submit</button>
                        <button class="btn btn-outline-warning" value="{{ route('home') }}">Reset</button>
                    </div>
                </form>
                <div class="mt-auto mb-5 pb-5">
                    @if ($is_auth)
                    @if ($is_auth->is_seller)
                    <a href="{{ route('vendor.dashboard') }}" class="btn btn-outline-success w-100 fw-semibold text-start mb-1">View Dashboard</a>
                    @else
                    <a href="{{ route('seller') }}" class="btn btn-outline-success w-100 fw-semibold text-start mb-1">Create Store</a>
                    @endif
                    <div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type="hidden">
                            <button type="submit" class="btn btn-outline-danger fw-semibold w-100 text-start mb-3">Log Out <i class="bi bi-box-arrow-right ms-1"></i></button>
                        </form>
                    </div>
                    @else
                    <div>
                        <a class="btn btn-outline-success fw-semibold w-100 text-start mb-1" href="{{  route('signin') }}">Sign In <i class="bi bi-person-plus ms-1"></i></a>
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-outline-secondary fw-semibold w-100 text-start" href="{{  route('login') }}">Log In <i class="bi bi-box-arrow-in-right ms-1"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            {{-- Banner 1 --}}
            <section class="splide mb-4" id="banner" aria-label="Taze Gelenler">
                <div class="splide__track">
                    <h3 class="fw-bold mb-3">🆕 Taze Gelenler</h3>
                    <ul class="splide__list">
                        @foreach ($products as $product)
                        <li class="splide__slide">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                <a href="{{ route('show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->img_path) }}" class="card-img-top object-fit-cover" style="height: 200px;">
                                </a>
                                <div class="card-body">
                                    <h6 class="fw-bold text-truncate">{{ $product->name }}</h6>
                                    <p class="text-muted small mb-1">Satıcı: {{ $product->vendor->name ?? 'Bilinmiyor' }}</p>
                                    <p class="text-muted small mb-2">Kategori: {{ $product->category->name ?? 'Belirsiz' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-danger">{{ $product->price }} TMT</span>
                                        <a href="{{ route('show', $product->id) }}" class="btn btn-sm btn-warning text-white fw-semibold">
                                            İncele <i class="bi bi-basket ms-1"></i>
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
            <section class="splide mb-4" id="banner-2" aria-label="En Çok Görüntülenenler">
                <div class="splide__track">
                    <h3 class="fw-bold mb-3">🔥 En Çok Görüntülenenler</h3>
                    <ul class="splide__list">
                        @forelse ($products as $product)
                        <li class="splide__slide">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                <a href="{{ route('show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->img_path) }}" class="card-img-top object-fit-cover" style="height: 200px;">
                                </a>
                                <div class="card-body">
                                    <h6 class="fw-bold text-truncate">{{ $product->name }}</h6>
                                    <p class="text-muted small mb-1">Satıcı: {{ $product->vendor->name ?? 'Bilinmiyor' }}</p>
                                    <p class="text-muted small mb-2">Kategori: {{ $product->category->name ?? 'Belirsiz' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-danger">{{ $product->price }} TMT</span>
                                        <a href="{{ route('show', $product->id) }}" class="btn btn-sm btn-warning text-white fw-semibold">
                                            İncele <i class="bi bi-basket ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <div class="text-center py-5 fw-bold fs-4">Ürün Bulunamadı 😔</div>
                        @endforelse
                    </ul>
                </div>
            </section>

            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
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
                            perPage: 4
                        },
                        992: {
                            perPage: 3
                        },
                        768: {
                            perPage: 2
                        },
                        576: {
                            perPage: 1
                        }
                    }
                }).mount();
            });
        });
    </script>
</div>

@endsection