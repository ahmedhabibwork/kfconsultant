<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    protected $table = "project_images";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "project_id",
        "image",
        "sort_order",
    ];
}
