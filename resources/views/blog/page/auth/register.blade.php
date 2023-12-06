@extends('blog.layouts.main')

@section('content')
  <div class="col-12 col-md-6 col-xl-5 shadow-lg mx-auto my-5 rounded">
    <div class="card border-0">
      <div class="card-body p-3 p-md-4 p-xl-6">
        <div class="row">
          <div class="col-12">
            <div class="mb-4">
              <h3>Sign Up</h3>
              <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
          </div>
        </div>
        <form action="{{ route('actionRegister') }}" method="POST">
          @csrf
          <div class="row gy-3 overflow-hidden">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control rounded-4 @error('name') is-invalid @enderror" name="name"
                  id="name" placeholder="" value="{{ old('name') }}">
                <label for="name" class="form-label">Name</label>

                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control rounded-4 @error('username') is-invalid @enderror"
                  name="username" id="username" placeholder="" value="{{ old('username') }}">
                <label for="username" class="form-label">Username</label>

                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating">
                <input type="email" class="form-control rounded-4 @error('email') is-invalid @enderror" name="email"
                  id="email" placeholder="" value="{{ old('email') }}">
                <label for="email" class="form-label">Email</label>

                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12 d-flex justify-content-between mb-3">
              <div class="form-floating col-6 pe-1">
                <input type="password" class="form-control rounded-4 @error('password') is-invalid @enderror"
                  name="password" id="password" value="{{ old('password') }}" placeholder="">
                <label for="password" class="form-label">Password</label>

                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating col-6 ps-1">
                <input type="password" class="form-control rounded-4" name="password_confirmation"
                  id="password_confirmation" value="" placeholder="">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
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
            <div class="col-12 mb-3">
              <div class="d-grid">
                <button class="btn btn-secondary btn-lg rounded-4" type="submit">Register Now</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
