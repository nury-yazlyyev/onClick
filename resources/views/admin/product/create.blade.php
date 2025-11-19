@extends('client.layout.app')

@section('content')
<div class="container-xxl">
    <div class="d-flex justify-content-center">
    <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-header bg-warning text-white py-3 rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i> Täze Haryt Goş</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.create.product') }}" method="POST" enctype="multipart/form-data">
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
    </div>
</div>
@endsection