<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = "contact_us";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "email",
        "subject",
        "message",
    ];
}
