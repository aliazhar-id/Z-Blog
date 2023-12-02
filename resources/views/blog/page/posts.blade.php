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
          <a href="/posts/{{ $posts[0]->slug }}"><img class="card-img-top" src="{{ $posts[0]->image }}" alt="..."
              fetchpriority="high" /></a>
          <div class="card-body">
            <div class="container d-flex mb-2 px-0 align-items-center">
              <div class="profile-pic me-1" style="height: 50px; width:50px">
                <img src="{{ isset($posts[0]->author->image) ? $posts[0]->author->image : '/assets/guest.jpeg' }}"
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
            <a class="btn btn-primary" href="/posts/{{ $posts[0]->slug }}">Read more</a>
          </div>
        </div>
      @endif

      <!-- Nested row for non-featured blog posts-->
      <div class="row">
        @foreach ($posts->skip(1) as $post)
          <div class="col-lg-4">
            <!-- Blog post-->
            <div class="card mb-4">
              <a href="/posts/{{ $post->slug }}"><img class="card-img-top" src="{{ $post->image }}"
                  alt="..." /></a>
              <div class="card-body">
                <div class="container d-flex mb-2 px-0 align-items-center">
                  <div class="profile-pic me-1" style="height: 50px; width:50px">
                    <img src="{{ isset($post->author->image) ? $post->author->image : '/assets/guest.jpeg' }}"
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
                <a class="btn btn-primary" href="/posts/{{ $post->slug }}">Read more</a>
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
          <div class="input-group">
            <input class="form-control" type="text" placeholder="Enter search term..."
              aria-label="Enter search term..." aria-describedby="button-search" />
            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
          </div>
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
                    <li><a href="#!">{{ $category->name }}</a></li>
                  @endforeach
                </ul>
              </div>
            @endforeach

          </div>
        </div>
      </div>
      <!-- Side widget-->
      <div class="card mb-4">
        <div class="card-header">Side Widget</div>
        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and
          feature the Bootstrap 5 card component!</div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  @include('blog.partials.footer')
@endsection
