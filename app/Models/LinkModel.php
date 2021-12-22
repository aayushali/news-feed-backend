<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkModel extends Model
{
    use HasFactory, softDeletes;
    protected $table = "links";
    protected $casts = [
        'Type' => 'array',
        'extras' => 'array',
    ];
    protected $guarded = [];

    public function publisher()
    {
        return $this->belongsTo(PublisherModel::class, 'publisher_id');
    }
}
