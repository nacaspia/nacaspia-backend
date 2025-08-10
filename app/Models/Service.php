<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'id',
        'parent_id',
        'sub_parent_id',
        'image',
        'files',
        'title',
        'slug',
        'text',
        'order_by',
        'is_service_type',
        'is_calculator',
        'status'
    ];

    protected $casts = [
        'title' => 'array',
        'text' => 'array',
        'slug' => 'array',
        'files' => 'array',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_by');
    }

    public function parentCategories()
    {
        return $this->hasMany(Service::class,'parent_id','id')->whereNull('sub_parent_id')->with('subParentCategories');
    }


    public function parentCategory()
    {
        return $this->hasOne(Service::class,'id','sub_parent_id')->whereNull('sub_parent_id')->with('subParentCategories');
    }
    public function subParentCategories()
    {
        return $this->hasMany(Service::class,'sub_parent_id','id');
    }
}
