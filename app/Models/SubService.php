<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    protected $table = "sub_services";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "description",
        'service_id',
        "is_active",
        "sort_order",
    ];
    public function getService()
    {
        return $this->belongsTo(Service::class, 'service_id' , 'id'); 
    }
}
