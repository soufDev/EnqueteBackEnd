<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nouveaute extends Model
{
    public $table = 'nouveaute';
    protected $fillable = [
        'id', 'f7', 'f11', 'f8', 'operation_favorite', 'journal_transaction', 'operations_recentes', 'notifications', 'recherche_client_page_accueil', 'user_id'
    ];
    public $timestamps = false;

}
