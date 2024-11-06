<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "teams";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "image",
        "position",
        "is_active",
        "sort_order",
    ];}
