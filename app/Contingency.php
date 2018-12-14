<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Contingency extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }
    
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
