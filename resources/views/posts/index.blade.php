@extends('main')

@section('title','|All Posts')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>All posts</h1>
        </div>

        <div class="col-md-2">
            <a href="{{route('posts.create')}}" class="btn btn-primary btn-lg btn-block"> Create New Post</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                @if($posts)
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th>{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{substr($post->body,0,50)}}{{strlen($post->body) > 50 ? "...":""}}</td>
                            <td>{{date('M,j,Y',strtotime($post->created_at))}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('posts.show',$post->id)}}">View</a> <a class="btn btn-primary btn-sm" href="{{route('posts.edit',$post->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@stop