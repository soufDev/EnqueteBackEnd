<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bugs_par_domaines_metier extends Model
{
    public $table = 'bugs_par_domaines_metier';
    protected $fillable = [
        'id', 'op_caisse', 'op_credits', 'op_monetique', 'op_comex', 'gestion_client_comptes', 'op_telecompence', 'reporting_consultation', 'user_id'
    ];
    public $timestamps = false;

}
