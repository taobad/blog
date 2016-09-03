@extends('main')
@section('title', '| DELETE COMMENT?')
@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1> DELETE THIS COMMENT? </h1>
      <p>
        <strong> Name: </strong> {{$comment->name}} <br>
        <strong> Email: </strong> {{$comment->email}} <br>
        <strong> Comment: </strong> {{$comment->comment}}
      </p>
     <p><a href="{{route('posts.show',$comment->post->id)}}" class='btn btn-lg btn-block btn-primary'>BACK TO POST</a></p>
      {!! Form::open(['route'=>['comments.destroy', $comment->id], 'method' => 'DELETE'])!!}
        {{Form::submit('YES DELETE THIS COMMENT', ['class' => 'btn btn-lg btn-block btn-danger'])}}
      {!! Form::close()!!}


    </div>
  </div>


@endsection
