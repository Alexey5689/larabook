<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Чтобы у нас была возможность создать объект модели Topic в классе TopicController
use App\Topic;
use App\Block;
use App\Bloapublic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // создает и передает в свое представление две переменные: $topics и $id. В первой переменной,
        // являющейся массивом, находится список разделов, полученный вызовом метода all() из таблицы topics.
        $topics=Topic::all();
        //значение идентификатора того раздела, по которому кликнет пользователь.
        $id=0;
        return view('topic.index',['page'=>'home','topics'=>$topics,'id'=>$id]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        // Мы создали пустой объект модели Topic в переменной $topic.
        $topic=new Topic;
        return view('topic.create',['topic'=>$topic,'page'=>'AddTopic']);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $topic = new Topic; //create empty model object


        //initialize the model's property topicname
        //with data entered into form's control
        //валидация 'topicname' модели Topic было обязательным для заполнения, не длиннее 100 символов и уникальным.
        $this->validate($request, ['topicname'=>'required|unique:topics|max:100',] );
        //topicname
        //we have access to form controls through
        //$request parameter
        //заносим в свойство модели topicname значение, занесенное пользователем в текстовое поле topicname формы
        $topic->topicname=$request->topicname;
        //Метод $topic – >save() мы вызываем в операторе if(), потому что при наличии ошибок валидации этот метод вернет false.
        $topic->save(); //save model into DB table
        //
        //перегружаем строничку с выводом сообщения
        return redirect()->action('TopicController@create')->with('message','New topic'.$topic->topicname.' has been added with id='.$topic->id.'!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Первая строка в этом методе выполняет запрос
        // SELECT * FROM topics WHERE id=$id, где $id – идентификатор кликнутого раздела
        //get() получает запрос
        $blocks=Block::where('topicid','=', $id)->get();
        //массив $topics со списком разделов
         //вывод блока топик
        $curr_Top = Topic::find($id);
        $topics=Topic::all();
        return view('topic.index',['page'=>'Block from topics'.$curr_Top->topicname,'topics'=>$topics,'id'=>$id,'blocks'=>$blocks]);
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
        //
    }
    public function search(Request $request){
        $search=$request->searchform;
        $search='%'.$search.'%';
        //Создается шаблон для функции like и выполняется SQL запрос SELECT * FROM topics WHERE topicname like '%'.$search.'%'.
        $topics=Topic::where('topicname','like', $search)->get();
        return view('topic.index',['page'=>'Main Page','topics'=>$topics,'id'=>0]);
    }
}
