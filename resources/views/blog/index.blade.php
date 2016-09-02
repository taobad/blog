@extends('main')

@section('title',"| Blog")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Blog</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($posts as $post)
                <div class="post">
                    <h2>{{$post->title}}</h2>
                    <h5>Published: {{date('M,j,Y h:ia',strtotime($post->created_at))}}</h5>
                    <p>{{substr($post->body,0,300)}}{{strlen($post->body) > 300 ? "...":""}}</p>
                    <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary"> Read more</a>
                </div>
                <hr>
                <div class="text-center">
                    {!! $posts->links() !!}
                </div>

            @endforeach
        </div>
    </div>

@stop