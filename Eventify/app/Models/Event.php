<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id', 
        'start_time',
        'end_time', 
        'location', 
        'latitude', 
        'longitude', 
        'max_attendees', 
        'price', 
        'image_url', 
        'deleted'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organized_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
