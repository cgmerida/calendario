<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $fillable = [
        'name', 'description',
    ];

    public function setNameAttribute($value = '')
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
