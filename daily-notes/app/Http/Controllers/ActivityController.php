<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Activity;
use App\User;
use App\TotalSpents;
use Carbon\Carbon;
class ActivityController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth()->id();
        $this->validate($request, [
            'name' =>'required',
            'amount' => 'required',
        ]);

        $activity = new Activity;
        $activity->name = $request->input('name'); 
        $activity->amount = $request->input('amount'); 

        $activity->save();
        $activity_id = $activity->id;
        $total_spend = TotalSpents::whereDate('created_at', Carbon::today())->get();
        $total_spents = Activity::whereDate('created_at', Carbon::today())->get();
        $total = 0;
        foreach($total_spents as $data){
            $total = $total + $data->amount;
        }
       // dd($total_spend);
        foreach($total_spend as $data){
            $total_spend_data = TotalSpents::find($data->id);
            $total_spend_data->amount = $total;
            $total_spend_data->save();
        }

        
        $total_spend_data->activity()->sync($activity_id,false);
        $activity->user()->sync($userId,false);

        
    }
}
