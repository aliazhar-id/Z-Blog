<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Z-Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('posts*') ? 'active' : '' }}" href="{{ route('blog') }}"
            href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('posts*') ? 'about' : '' }}" href="{{ route('about') }}"
            href="#">About</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
        <li class="nav-item">
          <a href="{{ route('login') }}"
            class="nav-link btn btn-secondary lh-base{{ Request::is('login') ? 'about' : '' }}">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
