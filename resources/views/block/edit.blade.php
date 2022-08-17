@extends('layouts.app')
@section('menu')
@parent
@endsection
@section('content')
{{-- атрибут 'files'=>true --}}
{!!Form::model($block, array('route'=>array('block.update',$block->id),'method'=>'PUT','files'=>true))!!}
    <div class='form-group'>
        {!! Form::label('topicid','Select Topic')!!}
        {!! Form::select('topicid',$topics,$block->topicid,array('class'=>'form-control'))!!}
    </div>
    <div class='form-group'>
        {!! Form::label('title','Edit title')!!}
        {!! Form::text('title', $block->title,array('class'=>'form-control'))!!}
    </div>
    <div class='form-group'>
        {!! Form::label('content','Edit Content')!!}
        {!! Form::textarea('content', $block->content,array('class'=>'form-control'))!!}
    </div>
    <div class='form-group'>
        {!! Form::label('imagesPath','Edit Image')!!}
        {!! Form::file('imagesPath',array('class'=>'form-control'))!!}
    </div>
    {!! Form::submit('Save edit block',array('class'=>'btn btn-primary'))!!}
{!!Form::close()!!}
@endsection
