<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = "settings";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "email",
        "mobile",
        "address",
        "youtube_link",
        "facebook_link",
        "instagram_link",
        "linkedin_link",
        "is_default"
    ];
}
