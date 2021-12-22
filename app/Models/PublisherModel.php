<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherModel extends Model
{
    use HasFactory;
    protected $table= 'publishers';
    protected $casts = [
        'pub_contact_details' => 'array',
    ];
    protected $guarded = [];
    public function links(){
        return $this->hasMany(LinkModel::class, 'publisher_id');
    }
}
