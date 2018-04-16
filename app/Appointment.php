<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
class Appointment extends Model
{
    protected $table = 'appointments';
    protected $fillable = [
        "subject",
        "status",
        "date_to_attend",
        "time_to_attend",
        "contact_id",
        "user_id"
    ];
    public function contact(){
        return $this->belongsTo('App\Contact');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public static function getMyAppointments(){
        $current_user = Auth::user()->id;
        $myAppointments = DB::select(DB::raw(
            "SELECT a.*,c.id as 'contact_id', c.name as 'contact_name' FROM appointments a
            INNER JOIN contacts  c ON c.id = a.contact_id 
            INNER JOIN users u ON u.id = a.user_id  
            WHERE a.user_id = $current_user"
        ));
        return $myAppointments;
    }
    public static function between($from, $to){
        $current_user = Auth::id();
        $appointments = DB::select(DB::raw(
            "SELECT a.*,c.id as 'contact_id', c.name as  contact_name from appointments a  
            INNER JOIN contacts c ON a.contact_id = c.id
            where a.user_id = $current_user AND a.date_to_attend between '$from' AND '$to'"
        ));
        return $appointments;
    }
    public static function averages(){
        $current_month = date('Y-m');
        $current_user = Auth::id();
        $averages = DB::select(DB::raw(
            "SELECT a.status, count(status) as total from appointments a
            where a.user_id = $current_user
            AND a.date_to_attend between '$current_month-01' AND '$current_month-31'
            group by a.status"
        ));
        return $averages;
    }
}
