<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    protected $fillable = [
        'name',
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
