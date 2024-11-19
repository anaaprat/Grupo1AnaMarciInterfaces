<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Attendees extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'event_attendees';

    /**
     * Campos asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'register_at',
        'deleted',
    ];

    /**
     *
     * @var array<string, string>
     */
    protected $casts = [
        'register_at' => 'datetime',
        'deleted' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
