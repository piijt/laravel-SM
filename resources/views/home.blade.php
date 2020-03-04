@extends('layouts.app')

@section('content')
@include('includes.message-block')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form  action="{{ route('post.create') }}" method="post">
                        <textarea class="form-control" name="body" rows="8" cols="180" placeholder="write something cool...."></textarea>
                        <button class="btn btn-primary" type="submit" name="button">Post</button>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </form>
                </div>
                <section class="row posts">
                    <div class="col-md-6 col-md-3-offset-3">
                      <h3>Some Posts</h3>
                      @foreach ($posts as $post)
                        <article class="post" data-postid="{{ $post->id }}">
                            <p>{{ $post->body }}</p>
                            <div class="info">
                              Posted by {{ $post->user->name }} on {{ $post->created_at }}
                            </div>
                            <div class="interaction">
                              <a href="#">Like</a> |
                              <a href="">Dislike</a>
                              @if (Auth::user() == $post->user)
                                  |
                                <a href="" class="edit btn" data-toggle="modal">Edit</a> |
                                <a id="delete" href="{{ route('delete.post', ['post_id' => $post->id]) }}">Delete</a>
                              @endif

                            </div>
                        </article>
                      @endforeach
                    </div>
                </section>

                <!-- Modal -->
                <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <label for="post-body">Edit Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>



            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var token = '{{ Session::token() }}';
  var urlEdit = '{{ route('edit') }}';
</script>
@endsection
