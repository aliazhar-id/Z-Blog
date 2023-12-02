@extends('dashboard.layouts.main')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-auto">Edit Post</h1>
  </div>

  <div class="row">
    <div class="col-lg-10 order-lg-1 mx-auto">

      <div class="card shadow mb-4">

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Post</h6>
        </div>

        <div class="card-body">

          <form action="/dashboard/posts/{{ $post->slug }}" method="POST" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="pl-lg-4">
              @if (session('error'))
                <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group focused">
                    <label class="form-control-label" for="title">Title<span class="small text-danger">*</span></label>
                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                      name="title" placeholder="ex: How to create blog with Laravel 10"
                      value="{{ old('title', $post->title) }}">

                    @error('title')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="category" class="form-label">Category<span class="small text-danger">*</span></label>
                    <select class="form-control" name="id_category">
                      @foreach ($categories as $category)
                        <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-12">
                  <textarea name="body">{{ old('body', $post->body) }}</textarea>

                  @error('body')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror

                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="pl-lg-4">
              <div class="row">
                <div class="col text-center">
                  <button type="submit" class="btn btn-primary">Update Post</button>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>

    </div>
  </div>
@endsection

@section('custom-script')
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('body', {
      language: 'en',
    });
  </script>
@endsection
