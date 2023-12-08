@extends('blog.layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 mt-4">
        <h1 class="mb-3">{{ $post->title }}</h1>
        <img src="{{ $post->image ? asset('storage/' . $post->image) : '/assets/default-banner.jpg' }}" class="img-fluid"
          alt="{{ $post->category->name }}" fetchpriority="high">

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

        @if (auth()->user()?->id_user === $post->id_user)
          <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit
          </a>

          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal"
            data-post="{{ $post->slug }}">
            <i class="bi bi-trash3"></i> Delete
          </button>
        @endif

        <article class="my-3 fs-5">{!! $post->body !!}</article>

        <a href="{{ route('home') }}" class="d-block mt-3 mb-5">Back to Home</a>

        <div id="disqus_thread"></div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deletePostModalLabel">Are you sure want to delete?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Select "DELETE" below if you are ready to delete this post.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form method="POST" id='deleteForm'>
              @method('DELETE')
              @csrf
              <input type="hidden" value="1" name="isPost">
              <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash3"></i> DELETE
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-script')
  <script>
    const deletePostModal = document.querySelector('#deletePostModal');

    deletePostModal.addEventListener('shown.bs.modal', function(e) {
      const post = e.relatedTarget.dataset.post;
      document.querySelector('#deleteForm').setAttribute('action', `/dashboard/posts/${post}`);
    });
  </script>

  <script>
    var disqus_config = function() {
      this.page.url = "{{ $canonicalURL }}";

      this.page.identifier =
        {{ $post->id_post }};
    };

    (function() {
      var d = document,
        s = d.createElement('script');
      s.src = 'https://z-blog-2.disqus.com/embed.js';
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
    })();
  </script>
  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
      Disqus.</a></noscript>
@endsection
