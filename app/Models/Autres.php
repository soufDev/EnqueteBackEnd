<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autres extends Model
{
    public $table = 'autres';
    protected $fillable = [
        'particuler', 'general', 'user_id'
    ];
    public $timestamps = false;


}
