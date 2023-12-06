@extends('blog.layouts.main')

@section('header')
  @include('blog.partials.header')
@endsection

@section('content')
  <div class="row">
    <!-- Blog entries-->
    <div class="col-lg-9">
      <!-- Featured blog post-->
      @if ($posts->count())
        <div class="card mb-4">
          <a href="{{ route('home') . '/' . $posts[0]->slug . '/read' }}"><img height="400" class="card-img-top"
              src="{{ $posts[0]->image ? asset('storage/' . $posts[0]->image) : '/assets/default-banner.jpg' }}"
              alt="..." fetchpriority="high" /></a>
          <div class="card-body">
            {{-- Author Info --}}
            <div class="container d-flex mb-2 px-0 align-items-center">
              <div class="profile-pic me-1" style="height: 50px; width:50px">
                <img
                  src="{{ $posts[0]->author->image ? asset('storage/' . $posts[0]->author->image) : '/assets/guest.jpeg' }}"
                  alt="Profile Picture">
              </div>
              <div>
                <small class="text-muted text-break">{{ $posts[0]->author->name }}</small class="text-muted">
                <div class="text-muted small text-break d-block">{{ $posts[0]->category->name }}</div class="text-muted">
                <div class="small text-muted">
                  {{ $posts[0]->created_at->diffForHumans() . ' [' }}
                  <i class="bi bi-eye-fill"></i> {{ $posts[0]->click . ' ]' }}
                </div>
              </div>
            </div>
            <h2 class="card-title">{{ $posts[0]->title }}</h2>
            <p class="card-text">{!! $posts[0]->excerpt !!}</p>
            <a class="btn btn-primary" href="{{ route('home') . '/' . $posts[0]->slug . '/read' }}">Read more</a>
          </div>
        </div>
      @else
        <div class="d-flex justify-content-center align-items-center" style="height: 100%">
          <h1 class="text-secondary">No Posts Found :(</h1>
        </div>
      @endif

      <!-- Nested row for non-featured blog posts-->
      <div class="row">
        @foreach ($posts->skip(1) as $post)
          <div class="col-lg-4">
            <!-- Blog post-->
            <div class="card mb-4">
              <a href="{{ route('home') . '/' . $post->slug . '/read' }}"><img class="card-img-top"
                  src="{{ $post->image ? asset('storage/' . $post->image) : '/assets/default-banner.jpg' }}"
                  alt="..." /></a>
              <div class="card-body">
                {{-- Author Info --}}
                <div class="container d-flex mb-2 px-0 align-items-center">
                  <div class="profile-pic me-1" style="height: 50px; width:50px">
                    <img
                      src="{{ $post->author->image ? asset('storage/' . $post->author->image) : '/assets/guest.jpeg' }}"
                      alt="Profile Picture">
                  </div>
                  <div>
                    <small class="text-muted text-break">{{ $post->author->name }}</small class="text-muted">
                    <div class="text-muted small text-break d-block">{{ $post->category->name }}</div class="text-muted">
                    <div class="small text-muted">
                      {{ $post->created_at->diffForHumans() . ' [' }}
                      <i class="bi bi-eye-fill"></i> {{ $post->click . ' ]' }}
                    </div>
                  </div>
                </div>
                <h2 class="card-title h4">{{ $post->title }}</h2>
                <p class="card-text">{!! $post->excerpt !!}</p>
                <a class="btn btn-primary" href="{{ route('home') . '/' . $post->slug . '/read' }}">Read more</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination-->
      <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
    </div>
    <!-- Side widgets-->
    <div class="col-lg-3">
      <!-- Search widget-->
      <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
          <form action="{{ route('home') }}">
            <div class="input-group">
              <input class="form-control" type="text" name="search" value="{{ request('search') }}"
                placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
              <input type="hidden" name="body" value="1">
              <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Categories widget-->
      <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
          <div class="row">

            @foreach ($categories->chunk(ceil($categories->count() / 2)) as $group)
              <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                  @foreach ($group as $category)
                    <li>>{{ $category->name }}</li>
                  @endforeach
                </ul>
              </div>
            @endforeach

          </div>
        </div>
      </div>
      <!-- Side widget-->
      <div class="card mb-4">
        <div class="card-header">Ads</div>
        <div class="card-body d-flex justify-content-center align-items-center" style="height: 150px">Space Available!
        </div>
      </div>
    </div>
  </div>
@endsection
