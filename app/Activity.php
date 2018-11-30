<?php

namespace Calendario;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = [
        'name', 'require', 'unity_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'unity_id',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'require' => 'required|string|max:255',
        ];
    }

    public function unity()
    {
        return $this->belongsTo(Unity::class);
    }

}
