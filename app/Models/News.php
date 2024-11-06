<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "title",
        "introduction",
        "description",
        "publish_date",
        "status",
        "image",
        "is_active",
        "sort_order",
    ];
}
