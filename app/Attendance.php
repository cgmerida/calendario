<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'event_id', 'attendance',
    ];
    
    protected $hidden = [
        'created_at', 'updated_at','event_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    

    public static function rules()
    {
        return [
            'attendance' => 'required|integer',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
