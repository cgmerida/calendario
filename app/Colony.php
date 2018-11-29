<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Colony extends Model
{

    protected $fillable = [
        'colony', 'zone', 'lat', 'lng',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function rules()
    {
        return [
            'colony' => 'required|string|max:255',
            'zone' => 'required|numeric|digits_between:1,25',
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ];
    }
}
