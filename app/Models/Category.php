<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // used to allow mass assignment (to store data)
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // parent category (its can be null; a root category; means no parent category)
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    // sub categories which have this caregory as a parent category 
    public function children()
    {
        return $this->hasMany(Category::class);
    }
}
