@extends('main')

@section('title','|View Post')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{$post->title}}</h1>
            <p class="lead">{{$post->body}}</p>
            <hr>
            <div class="tags">
                @foreach($post->tags as $tag)
                    <span class="label label-default">{{$tag->name}}</span>
                @endforeach
            </div>
        </div>

        <div class="col-md-3 col-sm-offset-1">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>url:</label>
                    <p><a href="{{route('blog.single',$post->slug)}}">{{url('blog/'.$post->slug)}}</a> </p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Category:</label>
                    <p>{{$post->category->name}} </p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Created at:</label>
                    <p>{{date('M,j,Y h:ia',strtotime($post->created_at))}}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p>{{date('M,j,Y h:ia',strtotime($post->updated_at))}}</p>
                </dl>
                <hr>
                <div class="row">
                    <div class="row col-sm-5 col-sm-offset-1">
                        {!! Html::linkRoute('posts.edit','Edit',[$post->id],['class'=>'btn btn-success btn-block']) !!}
                    </div>
                    <div class="row col-sm-5 col-sm-offset-1">
                        {!! Form::open(array('route' => ['posts.destroy',$post->id],'method'=>'DELETE')) !!}
                            {{Form::submit('Delete',['class'=>  "btn btn-danger btn-block" ])}}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="row">
                    <hr>
                    <div class="col-md-12">
                        {!! Html::linkRoute('posts.index','<<See All Posts',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection