@extends('dashboard.layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Post</h1>
    <form action="/dashboard/posts"
      class="d-none d-sm-inline-block form-inline mr-auto ml-md-4 my-2 my-md-0 mw-100 navbar-search">
      @if (request('title'))
        <input type="hidden" name="title" value="{{ request('title') }}">
      @endif

      <div class="input-group">
        <input type="text" name="searchx" value="{{ request('searchx') }}" class="form-control bg-white border-1 small"
          placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div>

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

  <div class="col-lg-12">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3 mx-">Create new Post</a>
  </div>

  @if ($posts->count())
    <div class="table-responsive col-lg-12">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Click</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->category->name }}</td>
              <td>{{ $post->click }}</td>
              <td>
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-primary"><span
                    data-feather="eye"></span></a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span
                    data-feather="edit"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center mt-4">{{ $posts->links() }}</div>
    </div>
  @else
    <p class="text-center fs-4 mt-5">You Don't Have Any Post Yet.</p>
  @endif


@endsection
