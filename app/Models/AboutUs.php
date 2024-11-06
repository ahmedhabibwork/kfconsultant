<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = "about_us";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "title",
        "introduction",
        "description",
    ];
}
