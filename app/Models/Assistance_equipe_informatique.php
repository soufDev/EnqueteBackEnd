<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistance_equipe_informatique extends Model
{
    public $table = 'assistance_equipe_informatique';
    protected $fillable = [
        'id',
        'volet_information',
        'volet_formation',
        'assistance_passage_ancien_nouveau',
        'reactivite_delais_prise_en_charge',
        'qualite_prise_en_charge',
        'redondance_incidents',
        'user_id'
    ];

    public $timestamps = false;
}
