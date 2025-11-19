@extends('vendor.layouts.app')

@section('content')
<div class="container py-5">
    {{-- Alert Messages --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Ýalňyşlyk!</strong> Aşakdaky maglumatlary barlaň:
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Vendor Info Section --}}
    <div class="card shadow-sm border-0 rounded-4 mb-3">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="text-center flex-fill">
                <i class="bi bi-shop text-warning fs-3"></i>
                <h6 class="mt-2 mb-0">Shop Name</h6>
                <span class="fw-bold text-dark">{{ $vendor->name }}</span>
            </div>
            <div class="text-center flex-fill">
                <i class="bi bi-person-lines-fill text-success fs-3"></i>
                <h6 class="mt-2 mb-0">Products</h6>
                <span class="fw-bold text-dark">{{ $vendor->products_count }}</span>
            </div>
            <div class="text-center flex-fill">
                <i class="bi bi-people-fill text-primary fs-3"></i>
                <h6 class="mt-2 mb-0">Followers</h6>
                <span class="fw-bold text-dark">{{ $vendor->followers->count() }}</span>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row g-4">
            <!-- Sol Taraf: Täze Haryt Goş -->
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-header bg-warning text-white py-3 rounded-top-4">
                        <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i> Täze Haryt Goş</h4>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Product Name --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ady</label>
                                <input type="text" name="name" class="form-control" placeholder="Haryt adyny giriziň..." value="{{ old('name') }}">
                            </div>

                            {{-- Price --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bahasy</label>
                                <input type="number" name="price" class="form-control" placeholder="Bahany giriziň..." value="{{ old('price') }}">
                            </div>
                            {{-- Size --}}
                            <div class="mb-3">
                                <label for="size" class="form-label fw-semibold">Razmer</label>
                                <select name="size_id" id="size" class="form-select">
                                    <option value="" selected disabled>Razmer saylan...</option>
                                    @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Category --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategoriýa</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Kategoriýa saýlaň...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Düşündiriş</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Haryt barada maglumat...">{{ old('description') }}</textarea>
                            </div>

                            {{-- Image --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Surat</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            {{-- Submit --}}
                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4 fw-semibold">
                                    <i class="bi bi-plus-circle me-2"></i>Haryt goş
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sağ Taraf: Haryt Üýtget & Ähli Harytlary Gör -->
            <div class="col-lg-4 d-flex flex-column justify-content-between gap-4">
                <div class="card shadow-lg border-0 rounded-4 ">
                    <div class="card-header bg-warning text-white py-3 rounded-top-4">
                        <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Haryt Üýtget</h4>
                    </div>
                    <div class="card-body p-4">
                        <section id="banner" class="splide mt-1 overflow-hidden" aria-label="meals">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($products as $product)
                                    <li class="splide__slide">
                                        <div class="card d-flex flex-row align-items-center p-2 shadow-sm border-0 rounded-4">
                                            {{-- Ürün Görseli --}}
                                            <div class="me-3" style="width: 100px; height: 100px; flex-shrink: 0;">
                                                <a href="{{ route('show', $product->id) }}" class="text-decoration-none">
                                                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->name }}" class="img-fluid rounded-3 w-100 h-100 object-fit-cover">
                                                </a>
                                            </div>

                                            {{-- Ürün Bilgileri --}}
                                            <div class="flex-grow-1">
                                                <a href="{{ route('show', $product->id) }}" class="text-decoration-none text-dark">
                                                    <h6 class="fw-bold mb-1 text-truncate" style="max-width: 200px;">{{ $product->name }}</h6>
                                                </a>
                                                <p class="mb-1" style="font-size: 13px;">
                                                    <span class="fw-semibold text-secondary">{{ __('app.category') }}:</span>
                                                    {{ $product->category->name ?? 'Nabelli' }}
                                                </p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="fw-bold" style="font-size: 14px; color: #FF6620;">
                                                        {{ __('app.price') }}:
                                                    </span>
                                                    <span class="fw-bold text-success" style="font-size: 15px;">
                                                        {{ $product->price }} TMT
                                                    </span>
                                                </div>
                                                <a href="{{ route('show', $product->id) }}" class="btn btn-sm fw-semibold mt-2 text-white" style="background-color: #FF6620;">
                                                    {{ __('app.edit_product') }} <i class="bi bi-basket ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                        <div class="mt-3">
                            <a href="#" class="btn btn-outline-warning w-100">View All</a>
                        </div>
                    </div>
                </div>


                <div class="card shadow-lg border-0 rounded-4 flex-fill">
                    <div class="card-header bg-warning text-white py-3 rounded-top-4">
                        <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i> Ähli Harytlary Gör</h4>
                    </div>
                    <div class="card-body p-4">
                        Harytlary görkez
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/splide.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('#banner', {
                type: 'loop',
                autoplay: 1, // Awtomat ozi gecip duran etmegi [0, 1]
                arrows: 1,
                pagination: false, // gapdaldaky strelka  [0, 1]
                interval: 2000, // nace millisekunt wagtdan gecmelidigi  
                pauseOnHover: 1, // ustune baranynda pause bolyar  [0, 1]
                perMove: 1, // nace slide yygylykda gecmeli
                perPage: 1, // her sahypada nace slide gorkezmeli
                gap: "1rem",
                breakpoints: {
                    640: {
                        perPage: 1,
                    },
                    990: {
                        perPage: 1,
                    },
                    1420: {
                        perPage: 1,
                    }
                }

            });
            splide.mount();
        });
    </script>
</div>
@endsection