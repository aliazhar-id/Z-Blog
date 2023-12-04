@extends('blog.layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 mt-4">
        <h1 class="mb-3">{{ $post->title }}</h1>
        <img src="{{ $post->image ?? '/assets/default-banner.jpg' }}" class="img-fluid" alt="{{ $post->category->name }}"
          fetchpriority="high">

        {{-- Author Info --}}
        <div class="container d-flex my-2 px-0 align-items-center">
          <div class="profile-pic me-1" style="height: 50px; width:50px">
            <img src="{{ $post->author->image ? asset('storage/' . $post->author->image) : '/assets/guest.jpeg' }}"
              alt="Profile Picture">
          </div>
          <div>
            <small class="text-muted text-break">{{ $post->author->name }}</small class="text-muted">
            <div class="text-muted small text-break d-block">{{ $post->category->name }}</div class="text-muted">
            <div class="small text-muted">
              {{ $post->created_at->diffForHumans() }}
              @if ($post->updated_at != $post->created_at)
                | Last Edited {{ $post->updated_at->diffForHumans() }}
              @endif
            </div>
          </div>
        </div>

        <article class="my-3 fs-5">{!! $post->body !!}</article>

        <a href="/posts" class="d-block mt-3">Back to Posts</a>
      </div>
    </div>
  </div>
@endsection
