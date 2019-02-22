<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalSpents extends Model
{
    public function user(){
    	return $this->belongsToMany('App\User','total_spent_users');
    }
    public function activity(){
    	return $this->belongsToMany('App\Activity','activitiy_total_spents');
    }
}
