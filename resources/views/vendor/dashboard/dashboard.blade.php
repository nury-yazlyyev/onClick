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
                <span class="fw-bold text-dark">{{ $user->followers_count }}</span>
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
                        <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="card shadow-lg border-0 rounded-4 flex-fill">
                    <div class="card-header bg-warning text-white py-3 rounded-top-4">
                        <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Haryt Üýtget</h4>
                    </div>
                    <div class="card-body p-4">
                        Harytlary görkez
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

</div>
@endsection