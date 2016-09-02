@extends('main')

@section('title',"| $tag->name Tag")

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{$tag->name}} Tag <small>{{$tag->posts()->count()}} Posts</small></h1>
            <hr>
        </div>

        <div class="col-md-3 col-sm-offset-1">
            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-lg btn-primary pull-right">Edit</a>
        </div>

        <hr>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Tags</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tag->posts as $post)
                    <tr>
                        <th>{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>@foreach($post->tags as $tag)
                            <span class="label label-default">{{$tag->name}}</span>
                        @endforeach
                        </td>
                        <td><a href="{{route('posts.show',$post->id)}}" class="btn btn-sm btn-primary" >View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection