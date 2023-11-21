@extends('layouts.master');

@section('body')

  <body class="bg-gradient-primary">
    <div class="container">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form action="{{ route('actionRegister') }}" class="user" method="POST">
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" name="firstName" value="{{ old('firstName') }}"
                        class="form-control form-control-user @error('firstName') is-invalid @enderror"
                        id="exampleFirstName" placeholder="First Name">

                      @error('firstName')
                        <div class="invalid-feedback pl-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="lastName" value="{{ old('lastName') }}"
                        class="form-control form-control-user @error('lastName') is-invalid @enderror"
                        id="exampleLastName" placeholder="Last Name">

                      @error('lastName')
                        <div class="invalid-feedback pl-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}"
                      class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                      placeholder="Email Address">

                    @error('email')
                      <div class="invalid-feedback pl-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" name="password"
                        class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="exampleInputPassword" placeholder="Password">

                      @error('password')
                        <div class="invalid-feedback pl-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="col-sm-6">
                      <input type="password" name="password_confirmation"
                        class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                        id="exampleRepeatPassword" placeholder="Repeat Password">

                      @error('password_confirmation')
                        <div class="invalid-feedback pl-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  @if (session('error'))
                    <div class="alert alert-danger">
                      <b>Opps!</b> {{ session('error') }}
                    </div>
                  @endif

                  <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>

                  {{-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </a>
                                    <hr> --}}
                  {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                    </a> --}}
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="{{ route('forgot-password') }}">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

  </body>
@endsection
