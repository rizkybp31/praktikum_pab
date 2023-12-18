<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'foods';
    protected $fillable = [
        'food_name', 'description', 'ingredients', 'price', 'rate', 'types',
        'picture_path'
    ];
}
