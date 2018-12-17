<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'address', 'description', 'start', 'end',
        'activity_id', 'colony_id', 'user_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
        'user_id',
    ];

    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = ['title', 'color', 'textColor'];

    public function getFullAddressAttribute()
    {
        return "{$this->address}, Colonia {$this->colony->name}, Zona {$this->colony->zone}";
    }

    public function getTitleAttribute()
    {
        return "{$this->activity->name} {$this->colony->name}";
    }

    public function getColorAttribute()
    {
        return $this->activity->unity->priority->color;
    }

    public function getTextColorAttribute()
    {
        return $this->activity->unity->priority->textColor;
    }

    public static function rules()
    {
        return [
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start' => 'required|date|before:end|after_or_equal:today',
            'end' => 'required|date|after:start',
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    
    public function colony()
    {
        return $this->belongsTo(Colony::class);
    }

    public function contingencies()
    {
        return $this->belongsToMany(Contingency::class);
    }
    
    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }
}
