<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'user';
    protected $fillable = [
        'id', 'nom_prenom', 'email', 'poste_occupe', 'num_poste'  
    ];

    public $timestamps = false;

}
