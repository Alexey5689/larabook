<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// содержатся два метода – up() и down(). Этот класс используется при выполнении миграции – действия, изменяющего состояние БД. При выполнении апгрейда работает метод up(),
// в котором, как правило, описывается создание новых
// объектов базы данных. При выполнении отката или даунгрейда работает метод down(),

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('tables', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->timestamps();
        // });

        // Этот метод создает таблицы в той БД, к которой подключено приложение
        Schema::create('Topics',function(Blueprint $table){
            $table->increments('id');  //создает автоинкрементное поле с именем 'id', которое будет первичным ключом в таблице;
            $table->string('topicname',100)->unique(); // создает строковое поле с именем 'topicname' длиной в 100 уникальности на значения этого поля;
            $table->timestamps();//создает в текущей таблице два поля типа timestamp с именами 'created_at' и 'updated_at';
        });
        Schema::create('Blocks',function(Blueprint $table){
            $table->increments('id');
            $table->integer('topicid')->unsigned();  //создает поле с именем 'topicid' типа unsigned integer;
            $table->foreign('topicid')->references('id')->on('Topics')->onDelete('cascade'); //создает связь между таблицами Blocks и Topics
            $table->string('title',100);
            $table->longText('content')->nullable();  //создает поле с именем  'content' типа longText;
            $table->string('imagesPath',255)->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Topics');
        Schema::dropIfExists('Blocks');

    }
}
