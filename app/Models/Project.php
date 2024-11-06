<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "title",
        "introduction",
        "description",
        "category_id",
        "scope_id",
        'year_id',
        "scale_id",
        "owner",
        "location",
        "status_id",
        "is_active",
        "sort_order",
    ];
    public function getCategory()
    {
      return $this->belongsTo(Category::class,'category_id','id');
    }
    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id','id');
    }
    public function getScale()
    {
        return $this->belongsTo(Year::class,'scale_id','id'); 
    }
    public function getScope()
    {
        return $this->belongsTo(Year::class,'scope_id','id'); 
    }
    public function getYear()
    {
        return $this->belongsTo(Year::class,'year_id','id'); 
    }
    public function getprojectImages()
    {
        return $this->hasMany(ProjectImages::class,'project_id','id'); 
    }
    public function projectImage()
    {
        return $this->hasone(ProjectImages::class,'project_id','id'); 
    }
}
