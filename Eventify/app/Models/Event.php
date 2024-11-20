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
        'max_attendees',
        'price',
        'organized_id',
        'latitude',
        'longitude',
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

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_attendees', 'event_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_attendees')
            ->withTimestamps();
    }

}
