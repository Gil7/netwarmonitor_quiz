<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        "name", "lastname", "phone", "email",'municipality_id','user_id'
    ];

    public function municipality(){
        return $this->belongsTo('App\Municipality');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
    public function appointments(){
        $this->hasMany('App\Appointment');
    }
    public static function getMyContacts(){
        $current_user = Auth::user()->id;
        $contacts = DB::select(DB::raw(
            "SELECT c.*, s.name as state_name, m.name as municipality_name from contacts as c 
            INNER JOIN municipalities as m on m.id = c.municipality_id 
            INNER JOIN states s on s.id = m.state_id
            WHERE c.user_id = $current_user
            ORDER BY c.id DESC"
        ));
        return $contacts;
    }
}
