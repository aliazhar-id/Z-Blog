@extends('blog.layouts.main')

@section('content')
  <div class="col-12 col-md-6 col-xl-5 shadow-lg mx-auto my-5 rounded-4">
    <div class="card border-0">
      <div class="card-body p-3 p-md-4 p-xl-5">
        <div class="row">
          <div class="col-12">
            <div class="mb-4">
              <h3>Sign in</h3>
              <p>Don't have an account? <a href="#!">Sign up</a></p>
            </div>
          </div>
        </div>
        <form action="{{ route('actionLogin') }}" method="POST">
          @csrf
          <div class="row gy-3 overflow-hidden">
            <div class="col-12">
              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                  required>
                <label for="email" class="form-label">Email</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" value=""
                  placeholder="Password" required>
                <label for="password" class="form-label">Password</label>
              </div>
            </div>
            @if (session()->has('error'))
              <div class="col-12">
                <div class="d-grid">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            @endif
            <div class="col-12">
              <div class="d-grid">
                <button class="btn btn-secondary btn-lg" type="submit">Log in Now</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
