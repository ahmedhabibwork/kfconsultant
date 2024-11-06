<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "image",
        "link",
        "is_active",
        "sort_order",
    ];
}
