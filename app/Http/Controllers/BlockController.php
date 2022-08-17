<?php

namespace App\Http\Controllers;
use App\Block;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()){
            return redirect('login');
        }
        $block=new Block;
        //$topics, созданная в контроллере и инициализированная методом pluck().
        $topics = Topic::pluck('topicname','id');
        return view('block.create',['block'=>$block,'topics'=>$topics,'page'=>'AddBlock']);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        $block=new Block;
        //правила, по которым должны проверяться данные нашей формы
        $this->validate($request, ['title'=>'required|max:100',
                                    'topicid'=>'required',
                                    'content' =>'required']);
        $fname=$request->file('imagesPath');
        if($fname != null){
            $originalname=$request->file('imagesPath')->getClientOriginalName();
            $request->file('imagesPath')->move(public_path().'/images',$originalname);
            $block->imagesPath='/images/'.$originalname;
        }else{
            $block->imagesPath='';
        }
        $block->title=$request->title;
        $block->topicid=$request->topicid;
        $block->content=$request->content;
        $block->save();
        return redirect()->action('BlockController@create')->with('message','New block '.$block->id.'has been added!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //         Метод find() находит в БД объект модели Block по
        // заданному идентификатору и заносит его в переменную
        $block=Block::find($id);
        // метол pluck() создает массив
        // из всех разделов и заносит его в переменную $topics.
        $topics=Topic::pluck('topicname','id');
        return view('block.edit')->
                with('block',$block)->
                with('topics',$topics)->
                with('page','Main Page');

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // метод find() находит в БД объект модели Block по заданному идентификатору и заносит его в
        // переменную $block
        $block=Block::find($id);
        //Доступ к данным формы мы получаем через переменную $request
        $block->title=$request->title;
        $block->content=$request->content;
        $block->topicid=$request->topicid;
        //upload new image from edit form
        $fname=$request->file('imagesPath');
        if($fname != null){
            $originalname=$request->file('imagesPath')->getClientOriginalName();
            $request->file('imagesPath')->move(public_path().'/images',$originalname);
            $block->imagesPath='/images/'.$originalname;
        }
        $block->save();
        return redirect('topic/'.$block->topicid);

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $block=Block::find($id);
        $block->delete();
        return redirect('topic');
        //
    }
}
