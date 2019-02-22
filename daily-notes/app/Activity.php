<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function user(){
    	return $this->belongsToMany('App\User','activitiy_users');
    }
    public function total_spent(){
    	return $this->belongsToMany('App\TotalSpents','activitiy_total_spents');
    }
}
