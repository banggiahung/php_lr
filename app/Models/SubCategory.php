<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [

        'Sub_Category_Name',
        'category_id',
        'Category_Name',
        'slug',
    ];

}