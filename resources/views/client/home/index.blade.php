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
        <div class="col-10">
            <section id="banner" class="splide mt-1 overflow-hidden" aria-label="meals">
                <div class="splide__track">
                    <label for="banner" class="fw-bold h1">Taze Gelenler</label>
                    <ul class="splide__list" id="banner">
                        @foreach ($products as $product)
                        <li class="splide__slide">
                            <div class="card h-100 d-flex flex-column">
                                <div>
                                    <a href="{{ route('show', $product->id ) }}" class="text-decoration-none">
                                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="p-2">
                                    <div class="fw-bold text-truncate" style="font-size: 14px; max-width: 170px;">
                                        <span>{{$product->name}}</span>
                                    </div>
                                    <div>
                                        <div id="stars-2" style="font-size: 12px;">
                                            <i onclick="addPoint(this, 1)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 2)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 3)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 4)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 5)" class="bi bi-star text-warning"></i>
                                            <span class="text-secondary" id="starsNum">(0)</span>
                                        </div>
                                        <a href="{{ route('show', $product->id ) }}" class="text-decoration-none text-black">
                                            <div class="mt-1 text-truncate" style="font-size: 13px; max-width: 170px;">
                                                <span class="fw-semibold">Satyjy: </span>{{$product->vendor->name ?? 'Nabelli'}}
                                            </div>
                                            <div class="my-1" style="font-size: 13px;">
                                                <span class="fw-semibold">{{ __('app.category') }}: </span>{{ $product->category->name ?? 'Nabelli' }}
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-bolder" style="font-size: 13px; color: #FF6620;">{{ __('app.price') }}: </span><span><span class="text-success fw-bold" style="color: #FF6620; font-size: 15px;">{{$product->price}}</span><span class="text-success fw-bold ms-1" style="font-size: 15px;">TMT</span></span>
                                            </div>
                                            <button class="btn w-100 mt-2 fw-semibold card-footer mt-auto" style="background-color: #FF6620;" onclick="Orders2(this)"><a href="{{ route('show', $product->id ) }}" class="text-decoration-none text-white" style="font-size: 14px;">{{ __('app.view_product') . ' '}}</a><i class="bi bi-basket text-white" style="font-size: 14px;"></i></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <section id="banner-2" class="splide mt-1 overflow-hidden" aria-label="meals">
                <div class="splide__track">
                    <label for="banner-2" class="fw-bold h1">In Kan Halananlar</label>
                    <ul class="splide__list" id="banner-2">
                        @forelse($products as $product)
                        <li class="splide__slide">
                            <div class="card h-100 d-flex flex-column">
                                <div>
                                    <a href="{{ route('show', $product->id ) }}" class="text-decoration-none">
                                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="p-2">
                                    <div class="fw-bold text-truncate" style="font-size: 14px; max-width: 170px;">
                                        <span>{{$product->name}}</span>
                                    </div>
                                    <div>
                                        <div id="stars-2" style="font-size: 12px;">
                                            <i onclick="addPoint(this, 1)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 2)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 3)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 4)" class="bi bi-star text-warning"></i>
                                            <i onclick="addPoint(this, 5)" class="bi bi-star text-warning"></i>
                                            <span class="text-secondary" id="starsNum">(0)</span>
                                        </div>
                                        <a href="{{ route('show', $product->id ) }}" class="text-decoration-none text-black">
                                            <div class="mt-1 text-truncate" style="font-size: 13px; max-width: 170px;">
                                                <span class="fw-semibold">Satyjy: </span>{{$product->vendor->name ?? 'Nabelli'}}
                                            </div>
                                            <div class="my-1" style="font-size: 13px;">
                                                <span class="fw-semibold">{{ __('app.category') }}: </span>{{ $product->category->name ?? 'Nabelli' }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bolder" style="font-size: 13px; color: #FF6620;">{{ __('app.price') }}: </span><span><span class="text-success fw-bold" style="color: #FF6620; font-size: 15px;">{{$product->price}}</span><span class="text-success fw-bold ms-1" style="font-size: 15px;">TMT</span></span>
                                            </div>
                                            <button class="btn w-100 mt-2 fw-semibold card-footer mt-auto" style="background-color: #FF6620;" onclick="Orders2(this)"><a href="{{ route('show', $product->id ) }}" class="text-decoration-none text-white" style="font-size: 14px;">{{ __('app.view_product') . ' '}}</a><i class="bi bi-basket text-white" style="font-size: 14px;"></i></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <div class="h1 fw-bold ">
                            Haryt Tapylmady...
                        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('#banner', {
                type: 'loop',
                autoplay: 1, // Awtomat ozi gecip duran etmegi [0, 1]
                arrows: 1, // gapdaldaky strelka  [0, 1]
                interval: 2000, // nace millisekunt wagtdan gecmelidigi  
                pauseOnHover: 1, // ustune baranynda pause bolyar  [0, 1]
                perMove: 1, // nace slide yygylykda gecmeli
                perPage: 6, // her sahypada nace slide gorkezmeli
                gap: "1rem",
                breakpoints: {
                    640: {
                        perPage: 2,
                    },
                    990: {
                        perPage: 4,
                    },
                    1420: {
                        perPage: 6,
                    }
                }

            });
            splide.mount();
        });
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('#banner-2', {
                type: 'loop',
                autoplay: 1, // Awtomat ozi gecip duran etmegi [0, 1]
                arrows: 1, // gapdaldaky strelka  [0, 1]
                interval: 2000, // nace millisekunt wagtdan gecmelidigi  
                pauseOnHover: 1, // ustune baranynda pause bolyar  [0, 1]
                perMove: 1, // nace slide yygylykda gecmeli
                perPage: 6, // her sahypada nace slide gorkezmeli
                gap: "1rem",
                breakpoints: {
                    640: {
                        perPage: 2,
                    },
                    990: {
                        perPage: 4,
                    },
                    1420: {
                        perPage: 6,
                    }
                }

            });
            splide.mount();
        });
    </script>
</div>

@endsection