@extends('layouts.app')
@section('title', 'Page Title')
@section('menu')
@parent
@endsection
@section('content')

<div class="row">
    <div class="label label-info" style="display:inline-block;width:100%;">
        {{$page}}
   </div>
   {{-- проверка ошибок --}}
    @if(count($errors) > 0)
        <div class="alert alert-danger">
                @foreach(session('errors')->all() as $er)
                    {{$er}}<br/>
                @endforeach
        </div>
    @endif
    {{-- сообщение об успехе --}}
    @if(session('message'))
        <div class="alert alert-success" >
            {{session('message')}}
        </div>
    @endif
</div>
<div class="row">
    {{-- создает форму, работающую с объектом модели Topic, переданным в метод
    model() в переменной $topic. Значение атрибута action
    у созданной формы указано как метод store() контроллера Topic. Это значит, что именно метод store() будет
    обработчиком данных этой формы. --}}

    {!! Form::model($topic,array('action'=>'TopicController@store')) !!}
    <div class='form-group'>
         {!! Form::label('topicname','Topicname')!!}  {{--создает метку --}}
        {!! Form::text('topicname', '', array('class'=>'form-control'))!!}
    </div>
    <button class="btn btn-success" type="submit">Add Topic</button>
    {!! Form::close() !!}{{--– закрывает форму, типизированную или не типизированную. --}}
</div>
@endsection
