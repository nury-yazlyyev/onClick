@extends('client.layout.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">
        <i class="bi bi-heart-fill text-danger me-2"></i>Beğendiğin Ürünler
    </h2>

    @if($liked->isEmpty())
    <div class="text-center text-muted mt-5">
        <i class="bi bi-heart fs-1 text-danger"></i>
        <p class="mt-3 fs-5">Henüz hiçbir ürünü beğenmedin.</p>
    </div>
    @else
    <div class="row g-4">
        @foreach ($liked as $like)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden product-card">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $like->product->img_path) }}" alt="{{ $like->product->name }}" class="card-img-top object-fit-cover" style="height: 230px; width: 100%;">

                    <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 rounded-start-pill small">
                        {{ $like->product->category->name }}
                    </span>
                </div>

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold mb-1">{{ $like->product->name }}</h5>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-person-circle me-1"></i>Satıcı: {{ $like->product->vendor->name }}
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="fw-bold text-primary fs-5">
                            {{ number_format($like->product->price, 2) }} TMT
                        </span>
                        <button class="btn btn-outline-danger btn-sm rounded-pill border-0">
                            <i class="bi bi-heart-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- Hover ve geçiş efektleri --}}
<style>
    .product-card {
        transition: all 0.25s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection