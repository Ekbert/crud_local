<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    // protected $connection = 'mysqla';



    // 可寫進資料庫的'欄位'
    protected $fillable = [
        'title',
        'sub_title',
        'content',
        'is_feature',
        'page_view',
    ];

    // 不可寫進資料庫的'欄位'
    protected $guarded = [
        'id',
        'password',

    ];


    // 可定義從資料庫取出來的資料的資料型別
    protected $casts = [
        'is_feature' => 'boolean',
        'page_view' => 'integer',
    ];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
