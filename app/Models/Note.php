<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'note';
    protected $fillable = [
        'id', 'type_note'
    ];

    public function getNoteIDs() {
        return $this::lists('id');
    }

    public $timestamps = false;

}
