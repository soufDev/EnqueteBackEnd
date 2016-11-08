<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bugs_par_domaines_tech extends Model
{
    public $table = 'bugs_par_domaines_tech';
    protected $fillable = [
        'id', 'execution_op', 'saisie_validation', 'impression', 'numerisation', 'bugs_par_domainescol', 'utilisation_materiel', 'user_id'
    ];
    public $timestamps = false;

}
