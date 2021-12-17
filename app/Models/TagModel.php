<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="tags";
    protected $casts = [
        'extras' => 'array'
    ];
}
