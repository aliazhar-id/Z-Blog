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
          <a class="nav-link {{ Request::is('/') || (isset($isHome) ?: false) ? 'active' : '' }}"
            href="{{ route('home') }}" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('trends') ? 'active' : '' }}" href="{{ route('trends') }}">Trends</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('posts*') ? 'about' : '' }}" href="{{ route('about') }}">About</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
        @auth
          <li class="nav-item dropdown">
            <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span class="mx-2">{{ auth()->user()->name }}</span>
              <div class="profile-pic">
                <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : '/assets/guest.jpeg' }}"
                  alt="Profile Picture">
              </div>
            </div>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-card-list"></i> Dashboard</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('posts.create') }}"><i class="bi bi-file-earmark-plus"></i>
                  Create Post
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person-gear"></i></i>
                  Account
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log Out</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('login') }}"
              class="nav-link btn btn-secondary lh-base{{ Request::is('login') ? 'about' : '' }}">
              <i class="bi bi-box-arrow-in-right"></i> Log In
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
