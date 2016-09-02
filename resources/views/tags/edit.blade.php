@extends('main')
@section('title', "| Edit Tag")
@section('content')
    {!! Form::model($tag,['route' => ['tags.update',$tag->id],'method'=>'PUT']) !!}
    <div class="col-md-6 col-md-offset-3">
        {{Form::label('name','Name:')}}
        {{Form::text('name',null,['class' => 'form-control input-lg'])}}
        <br>
        {{Form::submit('Save',['class'=>  "btn btn-warning btn-block" ])}}
    {!! Form::close() !!}
    </div>
@endsection