@extends('main')
@section('title','|Edit Post')
@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'link',
        menubar: false
      });
    </script>
@endsection
@section('content')
    <div class="row">
        {!! Form::model($post,['route' => ['posts.update',$post->id],'method'=>'PUT', 'files' => true]) !!}
        <div class="col-md-8">
            {{Form::label('title','Title:')}}
            {{Form::text('title',null,['class' => 'form-control input-lg'])}}
            <br>
            {{Form::label('slug','Slug:')}}
            {{Form::text('slug',null,['class' => 'form-control input-lg'])}}
            <br>
            {{Form::label('category_id','Category:')}}
            {{Form::select('category_id',$categories,null,['class' => 'form-control'])}}
            <br>
            {{Form::label('tags','Tags:')}}
            {{Form::select('tags[]',$tags,null,['class' => 'form-control select2-multi','multiple'=>'multiple'])}}
            <br>
            {{Form::label('featured_image','Upload Featured Image:')}}
            {{Form::file('featured_image')}}

            {{Form::label('body','Body:')}}
            {{Form::textarea('body',null,['class' => 'form-control'])}}
        </div>

        <div class="col-md-3 col-sm-offset-1">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>url:</label>
                    <p><a href="{{route('blog.single',$post->slug)}}">{{url('blog/'.$post->slug)}}</a> </p>
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
                        {!! Html::linkRoute('posts.show','Cancel',[$post->id],['class'=>'btn btn-danger btn-block']) !!}
                    </div>
                    <div class="row col-sm-5 col-sm-offset-1">
                        {{Form::submit('Save',['class'=>  "btn btn-warning btn-block" ])}}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}
    <script type="text/javascript">
        $('.select2-multi').select2();
        $('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
    </script>
@endsection
