<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top py-2">
  <div class="container-xxl">
    {{-- Logo --}}
    <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
      <span class="text-dark">on</span><span class="text-warning">Click</span><span class="text-dark">.</span>
    </a>

    {{-- Mobil Toggle --}}
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- İçerik --}}
    <div class="collapse navbar-collapse" id="navbarContent">
      {{-- Sol Menü --}}
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-semibold {{ request()->routeIs('home') ? 'text-warning' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold {{ request()->routeIs('shops') ? 'text-warning' : '' }}" href="{{ route('shops') }}">Shops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold {{ request()->routeIs('liked') ? 'text-warning' : '' }}" href="{{ route('liked') }}">Likes</a>
        </li>
      </ul>

      {{-- Orta - Diller & Sepet --}}
      <div class="d-flex align-items-center flex-wrap gap-2">
        {{-- Dil Seçimi --}}
        <div class="d-flex align-items-center">
          <a class="nav-link px-2 small {{ app()->getLocale() == 'ru' ? 'fw-bold text-warning' : 'text-secondary' }}" href="{{ route('locale', 'ru') }}">RU</a>
          <a class="nav-link px-2 small {{ app()->getLocale() == 'en' ? 'fw-bold text-warning' : 'text-secondary' }}" href="{{ route('locale', 'en') }}">EN</a>
          <a class="nav-link px-2 small {{ app()->getLocale() == 'tm' ? 'fw-bold text-warning' : 'text-secondary' }}" href="{{ route('locale', 'tm') }}">TM</a>
        </div>

        {{-- Sepet --}}
        <button type="button" data-bs-toggle="modal" data-bs-target="#cartModal" class="btn btn-outline-warning fw-semibold position-relative">
          <i class="bi bi-basket me-1"></i> Sebet
          <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill" id="totalAmount">0</span>
        </button>
      </div>

      {{-- Sağ Taraf - Arama --}}
      <form class="d-flex mt-2 mt-lg-0 ms-lg-3" role="search">
        <input class="form-control border-warning me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $f_search ?? '' }}">
        <button class="btn btn-warning text-white" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>
</nav>

{{-- Sepet Modal --}}
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title fw-semibold" id="cartModalLabel">
          <i class="bi bi-basket me-1"></i> Sebedim
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <ol id="list" class="list-group list-group-numbered small">
          {{-- JS ile doldurulacak --}}
          @if (auth()->check() && isset(auth()->user()->cart->items))
          @foreach (auth()->user()->cart->items as $cartItem)
          <li>
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex">
                <div>
                  {{$cartItem->variation->product->name}} <span class="mx-1">-</span>
                </div>
                <div>
                  {{$cartItem->variation->size->name}} <span class="mx-1">-</span>
                </div>
                <div>
                  {{$cartItem->variation->color->name}} <span class="mx-1">-</span>
                </div>
                <div>
                  {{$cartItem->variation->price}}
                </div>
              </div>
              <div>
                <div class="d-flex align-items-center">
                  <div class="me-1">
                    - {{$cartItem->quantity}} st
                  </div>
                  <button class="btn btn-link btn-sm"><i class="bi bi-trash"></i></button>
                </div>
              </div>
            </div>
          </li>
          @endforeach
          @else
          <li>
            Cart is Empty
          </li>
          @endif
        </ol>
        <div class="text-white text-end fw-semibold d-flex align-items-center">
          Jemi:
          <span id="totalPrice" class="ms-1">0</span>
          <span class="ms-1">TMT</span>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kapat</button>
        <a href="{{ route('cart.index') }}"><button type="button" class="btn btn-warning text-white fw-semibold">Sargyt Et</button></a>
      </div>
    </div>
  </div>
</div>

{{-- Ekstra UI stilleri --}}
<style>
  .nav-link {
    transition: color .2s ease;
  }

  .nav-link:hover {
    color: #ff8800 !important;
  }

  .btn-warning {
    background-color: #ff8800 !important;
    border-color: #ff8800 !important;
  }

  .btn-outline-warning:hover {
    color: #fff !important;
    background-color: #ff8800 !important;
    border-color: #ff8800 !important;
  }
</style>