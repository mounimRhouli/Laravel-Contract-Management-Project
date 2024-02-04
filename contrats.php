<?php

namespace App;

use carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class contrats extends Model
{
    protected $table = 'contrats';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['debut', 'fin', 'typecontrat_id', 'tiers', 'designation', 'departement_id', 'user_id', 'montant', 'pdf_url', 'deleted'];
    public function typecontrat()
    {
        return $this->belongsTo('App\TypeContrat', 'typecontrat_id');
    }
    public function  departement()
    {
        return $this->belongsTo('App\Department', 'departement_id');
    }
    public function responsable()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function getFinAttribute($value)
    {

        // This accessor allows you to format the date when accessing it
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    public function isExpired()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Assuming the 'fin' attribute stores the end date of the contract
        return $this->fin < $currentDate;
    }
    public $timestamps = false;
}
