@extends('layouts.app')
@section('menu')
@parent
@endsection
@section('content')
<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 dleft">
        {{-- поиск --}}
        {!! Form::open(array('action'=>'TopicController@search','class'=>'form')) !!}
        <div class="input-group">
            {!! Form::text('searchform','',array('class'=>'form-control','placeholder'=>'Enter topic'))!!}
            <span class="input-group-btn">
                <button class="btn btn-success btn-secondary" type="submit">Search</button>
            </span>
        </div>
        {!! Form::close() !!}
        <ul style="list-style-type:none">
            {{-- В левой части мы обрабатываем массив $topics, переданный в представление из контроллера --}}
            @foreach($topics as $t)
                <li>
                    <a href="{{url('topic/'.$t->id)}}">{{$t->topicname}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9 dright">
        @if($id != 0)
            @foreach($blocks as $b)
                <div>
                    <div>
                        {{-- <! – – Block's title – – > --}}
                        <h2>{{$b->title}}</h2>
                    </div>
                        {{-- <! – – Check if an image exisis and show it if it exists – – > --}}
                    @if($b->imagesPath !=" ")
                        <a href="{{url($b->imagesPath)}}" style="float:left;margin-right:20px" target="_blank" class="wrap-image">
                            <img src="{{asset($b->imagesPath)}}" height="150px" width="500px"alt=""/>
                        </a>
                    @endif
                        {{-- <! – – Check if a text content exisis andshow it if it exists – – > --}}
                    <pre class="pre__text">{{$b->content}}</pre>
                        {{-- <! – – Form for Delete button – – > --}}
                    {!! Form::open(array('route'=>array('block.destroy',$b->id))) !!}
                        {{-- <! – – set HTTP method DELETE for the form – – > --}}
                        {{ Form::hidden('_method','DELETE')}}
                        <button class="btn btn-xs btn-danger glyphicon glyphicon-remove" style="float:right" type="submit">DELETE</button>
                    {!! Form::close() !!}
                        {{-- <! – – Form for Edit button – – > --}}
                        {{-- данные нашего текущего блока --}}
                    {!! Form::model($b,array('route'=>array('block.update',$b->id))) !!}
                        {{-- <! – – set HTTP method PUT for the form – – >    --}}
                        {{ Form::hidden('_method','PUT')}}
                        <a class="btn btn-xs btn-info glyphicon glyphicon-pencil" style="float:right" href="{{url('block/'.$b->id.'/edit')}}">EDIT</a>
                    {!! Form::close() !!}
                    <br><br>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
