@extends('dashboard.layouts.main')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Profile</h1>

  @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @elseif(session('error'))
    <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="row">

    <div class="col-lg-4 order-lg-2">

      <div class="card shadow mb-4">
        <div class="card-profile-image mt-4 text-center">
          <img width="180px" class="img-profile rounded-circle"
            src="{{ isset(auth()->user()->image) ? auth()->user()->image : '/assets/guest.jpeg' }}">
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-lg-12">
              <div class="text-center">
                <h5 class="font-weight-bold">{{ auth()->user()->name }}</h5>
                <p>Member</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="card-profile-stats">
                <span class="heading">22</span>
                <span class="description">Friends</span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-profile-stats">
                <span class="heading">10</span>
                <span class="description">Photos</span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-profile-stats">
                <span class="heading">89</span>
                <span class="description">Comments</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-8 order-lg-1">

      <div class="card shadow mb-4">

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
        </div>

        <div class="card-body">

          <form action="/profile/{{ auth()->user()->username }}" method="POST" autocomplete="off">
            @csrf
            @method('PATCH')

            <h6 class="heading-small text-muted mb-4">User information</h6>

            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="username">Username<span
                        class="small text-danger">*</span></label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                      name="username" placeholder="Username" value="{{ old('username', auth()->user()->username) }}">

                    @error('username')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="name">Name</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                      name="name" placeholder="Name" value="{{ old('name', auth()->user()->name) }}">

                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="email">Email address<span
                        class="small text-danger">*</span></label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                      name="email" placeholder="example@example.com" value="{{ old('email', auth()->user()->email) }}">

                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="current_password">Current password</label>
                    <input type="password" id="current_password"
                      class="form-control @error('password') is-invalid @enderror" name="password"
                      placeholder="Current password">

                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="new_password">New password</label>
                    <input type="password" id="new_password"
                      class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                      placeholder="New password">

                    @error('new_password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="confirm_password">Confirm password</label>
                    <input type="password" id="confirm_password"
                      class="form-control @error('new_password_confirmation') is-invalid @enderror"
                      name="new_password_confirmation" placeholder="Confirm password">
                    @error('new_password_confirmation')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="pl-lg-4">
              <div class="row">
                <div class="col text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>

    </div>

  </div>
@endsection
