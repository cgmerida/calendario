<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'start', 'end', 'color',
        'status', 'user_id',
    ];

    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'start' => 'required|date|before:end|after:-5 day',
            'end' => 'required|date|after:start',
        ];
    }
}
