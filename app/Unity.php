<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    protected $fillable = [
        'name', 'priority_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'priority_id' => 'required|numeric'
        ];
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
}
