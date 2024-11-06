<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = "careers";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "title",
        "introduction",
        "description",
        "is_active",
        "sort_order",
    ];
}
