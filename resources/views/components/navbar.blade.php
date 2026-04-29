<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ $title }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}"> <i class="fa-solid fa-house"></i> Home</a>
            <a class="nav-link" href="{{ route('map') }}"> <i class="fa-solid fa-earth-americas"></i> Peta</a>
            <a class="nav-link" href="{{ route('tabel') }}"> <i class="fa-solid fa-table"></i> Tabel</a>
            <a class="nav-link disabled" aria-disabled="true"> <i class="fa-solid fa-pen"></i> Tentang</a>
          </div>
        </div>
      </div>
    </nav>
