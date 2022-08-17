<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// класса Topic, наследующего классу Model.
class Topic extends Model{
    // указывает, какое поле в таблице будет первичным ключом
    protected $primaryKey='id';
    // указывает, что соответствует этому классу модели таблица 'topics';
    protected $table='Topics';
    // указывает, значения каких полей можно будет изменять в дальнейшем в коде.
    protected $fillable=['topicname','created_at','updated_at'];
    //

    // protected $rules=['topicname'=>['required','max:100','unique']];
}
