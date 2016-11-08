<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance_temp_reponse extends Model
{
    public $table ='performance_temp_reponse';
    protected $fillable = [
        'id', 'delais_lancement_application', 'delais_navigation', 'delais_affichage_masques', 'delais_execution_operation', 'delais_impression_etat_sortie', 'user_id'  
    ];

    public $timestamps = false;

}
