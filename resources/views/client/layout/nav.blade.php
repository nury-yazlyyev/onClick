<nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}"><span class="text-black">on</span><span style="color: orange;">Click</span><span>.</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('shops') }}">Shops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{  route('locale', 'ru') }}">RU</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{  route('locale', 'en') }}">EN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{  route('locale', 'tm') }}">TM</a>
        </li>
        <button class="btn btn-warning text-white mx-3">
          Jemi:
          <span id="totalPrice" class="">0</span>
          TMT
        </button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-warning fw-semibold position-relative">
          <i class="bi bi-basket"></i> Sebet <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill" id="totalAmount">0</span>
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sebedim</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <ol id="list">

                </ol>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yap</button>
                <button type="button" onclick="Order()" class="btn btn-primary">Sarga</button>
              </div>
            </div>
          </div>
        </div>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control border-warning me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $f_search ?? ''}}">
        <button class="btn btn-warning text-white" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>
</nav>