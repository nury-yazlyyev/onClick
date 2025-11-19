@extends('client.layout.app')

@section('content')
<div class="container py-4">

    {{-- Alert messages --}}
    @include('client.alert.app')

    <div class="row g-4 align-items-start">

        {{-- Ürün görseli --}}
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->name }}" class="img-fluid rounded-3">
            </div>
        </div>

        {{-- Ürün detayları --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2 text-warning">{{ $product->name }}</h4>
                    </div>
                    @if ($is_auth && !auth()->user()->is_seller)
                    <div>
                        <form action="{{ route('like', $product->id) }}" method="post" class="w-100">
                            @csrf
                            <input type="hidden">
                            <button type="submit" class="interaction-btn bg-white border-0 {{ $product->LikedBy(auth()->user()) ? 'liked' : '' }}">
                                <i class="bi bi-heart{{ $product->LikedBy(auth()->user()) ? '-fill' : '' }} text-danger"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="mb-2">
                    <span class="fw-semibold text-secondary">{{ __('app.category') }}:</span>
                    <span class="fw-bold">{{ $product->category->name ?? 'N/A' }}</span>
                </div>

                <div class="mb-2">
                    <span class="fw-semibold text-secondary">{{ __('app.price') }}:</span>
                    <span class="fw-bold text-warning" style="font-size: 1.2rem;">{{ $product->price }} TMT</span>
                </div>
                <div class="mb-2">
                    <span class="fw-semibold text-secondary">{{ __('app.size') }}:</span>
                    <span class="fw-bold text-warning" style="font-size: 1.2rem;">{{ $product->size->name }}</span>
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
                <div>
                    <div class="mt-4">

                        <h5 class="mb-3 fw-bold">Comments ({{ $product->comments->count() }})</h5>

                        @foreach ($product->comments as $comment)
                        @if ( !isset($comment->parent_id) )
                        <div class="card mb-3 shadow-sm border-0 comment-item">
                            <div class="card-body d-flex">
                                {{-- Avatar --}}
                                <div class="me-3">
                                    <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . $comment->user->username }}" alt="avatar" class="rounded-circle" width="45" height="45">
                                </div>

                                {{-- Content --}}
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="fw-semibold mb-1">{{ $comment->user->username }}</h6>
                                        <div class="d-flex align-items-center">
                                            <small class="text-muted me-2">{{ $comment->created_at->diffForHumans() }}</small>
                                            @if ($is_auth && $user->id == $comment->user_id)
                                            <div>
                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link p-0"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="mb-0 text-secondary" style="font-size: 0.85rem;">
                                        {{ $comment->comment }}
                                    </p>
                                    <div class="">
                                        <div class="mb-2">
                                            <div class="d-flex flex-wrap">
                                                <div onclick="addSubcomment(this)" class="me-2">
                                                    Reply
                                                </div>
                                                @if (count($comment->childrens) > 0)
                                                <div onclick="showSubcomment(this)">
                                                    Show
                                                </div>
                                                @endif
                                            </div>
                                            <div class="d-none">
                                                <form action="{{ route('comment.store', $product->id) }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea name="comment" class="form-control mt-1 @error('comment') is-invalid @enderror" rows="1" placeholder="Add your comment here..."></textarea>
                                                        @error('comment')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" value="{{ $comment->id }}" name="parentId" class="btn btn-warning btn-sm text-white fw-semibold">
                                                        Add Comment
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="d-none">
                                                <div class="w-100 ms-3">
                                                    @foreach ($comment->childrens as $child)
                                                    <div class="d-flex justify-content-between flex-wrap">
                                                        <div class="d-flex flex-wrap align-items-center">
                                                            {{-- Avatar --}}
                                                            <div class="me-2">
                                                                <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . $comment->user->username }}" alt="avatar" class="rounded-circle" width="25" height="25">
                                                            </div>
                                                            <h6 class="fw-semibold mb-1">{{ $child->user->username }}</h6>
                                                        </div>
                                                        <div class="d-flex my-2">
                                                            <small class="text-muted">{{ $child->created_at->diffForHumans() }}</small>
                                                            @if ($is_auth && $user->id == $comment->user_id)
                                                            <div>
                                                                <form action="{{ route('comment.destroy', $child->id) }}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-link p-0"><i class="bi bi-trash"></i></button>
                                                                </form>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 text-secondary" style="font-size: 0.85rem;">
                                                        {{ $child->comment }}
                                                    </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        @endif
                        @endforeach

                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-bold mb-3">Add Comment</h5>
                                </div>
                            </div>
                            <form action="{{ route('comment.store', $product->id) }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="3" placeholder="Add your comment here..."></textarea>

                                    @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-warning text-white fw-semibold">
                                    Add Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Satici bilgisi --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <div class="mb-2">
                    <span class="fw-semibold text-secondary">Seller:</span>
                    <span class="fw-bold text-dark">{{ $product->vendor->name ?? 'Unknown' }}</span>
                </div>

                <div class="mb-2">
                    <span class="fw-semibold text-secondary">Followers:</span>
                    <span class="fw-bold">{{ $vendor->followers->count() ?? 0 }}</span>
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
                <form action="{{ route('follow', $vendorId) }}" method="post">
                    @csrf
                    @if ($is_auth && $user->isFollow($vendorId))
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
{{-- JS to toggle comments --}}
<script>
    function addSubcomment(btn) {
        let subcomment = btn.parentElement.nextElementSibling;
        subcomment.classList.toggle('d-none');

        let btnText = btn.textContent;

        if (btnText == 'Hide') {
            btn.textContent = 'Reply';
        } else {
            btn.textContent = 'Hide';
        }
    };

    function showSubcomment(btn) {
        let subcomment = btn.parentElement.nextElementSibling.nextElementSibling;
        subcomment.classList.toggle('d-none');

        let btnText = btn.textContent;

        if (btnText == 'Hide') {
            btn.textContent = 'Show';
        } else {
            btn.textContent = 'Hide';
        }
    };
</script>
@endsection