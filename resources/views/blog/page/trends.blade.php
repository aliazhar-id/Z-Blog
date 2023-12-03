@extends('blog.layouts.main')

@section('header')
  @include('blog.partials.header')
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-9 mx-auto">
      @if ($posts->count())
        <div class="card mb-4">
          <a href="/posts/{{ $posts[0]->slug }}"><img class="card-img-top" height="400"
              src="{{ $posts[0]->image ?? '/assets/default-banner.jpg' }}" alt="..." fetchpriority="high" /></a>
          <div class="card-body">
            {{-- Author Info --}}
            <div class="container d-flex mb-2 px-0 align-items-center">
              <div class="profile-pic me-1" style="height: 50px; width:50px">
                <img src="{{ $posts[0]->author->image ?? '/assets/guest.jpeg' }}" alt="Profile Picture">
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
      @else
        <div class="h2 text-center text-secondary">There are no posts that are trending</div>
      @endif

      @foreach ($posts->skip(1) as $post)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{ $post->image ?? '/assets/default-banner.jpg' }}" style="height: 100%;"
                class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{!! $post->excerpt !!}</p>
                {{-- Author Info --}}
                <div class="container d-flex mb-2 px-0 align-items-center">
                  <div class="profile-pic me-1" style="height: 50px; width:50px">
                    <img src="{{ $post->author->image ?? '/assets/guest.jpeg' }}" alt="Profile Picture">
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
                <a class="btn btn-primary mt-2" href="/posts/{{ $post->slug }}">Read more</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach

      <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
    </div>
  </div>
@endsection
