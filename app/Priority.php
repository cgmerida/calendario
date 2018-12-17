<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = [
        'name', 'color', 'textColor',
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
            'color' => [
                'required',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            ],
            'textColor' => [
                'required',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            ]
        ];
    }

    public function unities()
    {
        return $this->hasMany(Unity::class);
    }
}
