<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $table = 'tickets_tb';
    protected $primaryKey = 'unique_id';
    protected $keyType = 'unique_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unique_id','main_id', 'user_id','title', 'message',  'main'];


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function get_all($condition, $id = 'id', $sort = 'desc'){

        $course = Ticket::where($condition)->orderBy($id,$sort)->get();

        return $course;

    }

    function get_single($condition){

        $categories = Ticket::where($condition)->first();

        return $categories;

    }
}
