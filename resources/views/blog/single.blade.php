@extends('main')
<?php $titleTag =  htmlspecialchars($post->title); ?>
@section('title',"| $titleTag")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <img src="{{asset('images/'. $post->image)}}" height="400" width="800">
            <h1>{{$post->title}}</h1>
            <p> {!!$post->body!!}</p>
            <hr>
            <p>Posted In: {{$post->category->name}}</p>
        </div>

        <div class="col-md-12 col-lg-12">
          <div class="col-md-2">
            <button type="button" class="col-md-2 btn btn-info btn-block" data-toggle="modal" data-target="#myModal"> Add Comment </button>
          </div>
        </div>

        <div id="myModal" class="modal fade col-md-6 col-md-offset-3" role="dialog">
          <div class="modal-dialog">
              <div class = "modal-content">
                <div class="modal-header">
                  <h3> Post New Comment </h3>
                </div>

                <div class="modal-body">
                  {!! Form::open (['route' => ['comments.store',$post->id], 'method' => 'POST']) !!}
                      <div class="form-group">
                          <label name="email">Email:</label>
                          <input id="email" name="email" class="form-control">
                      </div>

                      <div class="form-group">
                          <label name="name">Name:</label>
                          <input id="name" name="name" class="form-control">
                      </div>

                      <div class="form-group">
                          <label name="comment">Comment:</label>
                          <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Type your comment here"></textarea>
                      </div>

                      <input type="submit" class="btn btn-success" value="submit">
                  {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <h3 class="comments-title"> <span class="glyphicon glyphicon-comment"></span>{{ $post-> comments()-> count()}} Comments</h3>
            @foreach($post->comments as $comment)
              <hr>
              <div class="comment">
                <div class="author-info">
                  <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=mm"}}" class="author-image">
                  <div class="author-name">
                      <h4> {{$comment->name}} </h4>
                      <p class="author-time"> {{date('F nS, Y - g:iA',strtotime($comment->created_at))}} </p>
                  </div>
                </div>
                <div class="comment-content">
                  {{$comment->comment}}
                </div>
              </div>
            @endforeach
          </div>
        </div>
    </div>
@stop
