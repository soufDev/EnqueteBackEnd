<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ergonomie_interface extends Model
{
    public $table = 'ergonomie_interface';
    protected $fillable = [
        'id', 'polices_caracteres', 'couleurs', 'icones', 'organisation_information', 'terminologie_codes', 'facilite_navigation', 'user_id'
    ];
    public $timestamps = false;

}
