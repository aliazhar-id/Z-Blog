@extends('dashboard.layouts.main')

@section('content')
  <div class="row my-3">
    <div class="col-lg-8">
      <h1 class="mb-3">{{ $post->title }}</h1>
      <img src="{{ $post->image ? asset('storage/' . $post->image) : '/assets/default-banner.jpg' }}" class="img-fluid mb-3"
        alt="{{ $post->category->name }}">

      <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"> <span data-feather="edit"></span> Edit</a>
      <button class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal"
        data-post="{{ $post->slug }}"><span data-feather="x-circle"></span> Delete
      </button>

      <article class="my-3 fs-5">{!! $post->body !!}</article>
    </div>
  </div>

  <!-- Delete Post Modal-->
  <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "DELETE" below if you are ready to delete this post.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="POST" id='deleteForm'>
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">
              <i class="far fa-trash-alt"></i> DELETE
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-script')
  <script>
    $('#deletePostModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const post = button.data('post');
      const modal = $(this);
      modal.find('form').attr('action', `/dashboard/posts/${post}`);
    })
  </script>
@endsection
