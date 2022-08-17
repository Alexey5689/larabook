@extends('layouts.app')
@section('menu')
@parent
@endsection
@section('content')
<div class="label lable-info">
    {{$page}}
</div>
@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach(session('errors')->all() as $er)
        {{$er}}<br/>
        @endforeach
    </div>
@endif
@if(session('message'))
    <div class="alert alert-success" >
        {{session('message')}}
    </div>
@endif

{{-- 'files'=>true. Этот атрибут метода Form::model() добавляет в создаваемый тег form атрибут enctype=’multipart/form – data’, что необходимо, если форма предназначена для выполнения upload.  --}}
{!! Form::model($block,array('action'=>'BlockController@store','files'=>true,'class'=>'form')) !!}
<div class='form-group'>
    {!! Form::label('topicid','Select Topic', array('class'=>'col-md-2'))!!}
    {{-- переменная $topics, созданная в контроллере и инициализированная методом pluck(). --}}
    {!! Form::select('topicid', $topics,'',array('class'=>'col-md-8'))!!}
    <a href="{{url('topic/create')}}" class="btn btn-sm btn-info col-md-2"type="submit">Add new Topic</a>
</div>

<div class='form-group'>
    {!! Form::label('title','Block Title',array('class'=>'col-md-2'))!!}
    {!! Form::text('title','',array('class'=>'col-md-10'))!!}
</div>

<div class='form – group'>
    {!! Form::label('content','Add Content',array('class'=>'col-md-2'))!!}
    {!! Form::textarea('content','',array('class'=>'col-md-10','cols'=>'','rows'=>''))!!}
</div>

<div class='form-group'>
    {!! Form::label('imagesPath','Add Image',array('class'=>'col-md-2'))!!}
    {{-- элемент для выбора картинки, созданный вызовом метода Form::file(). --}}
    {!! Form::file('imagesPath',array('class'=>'col-md-10'))!!}
</div>
<button class="btn btn-success"type="submit">Add Block</button>
{!! Form::close() !!}
@endsection
