<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class live_stream_model extends Model
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $table = 'live_streams_tb';
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
    protected $fillable = ['unique_id', 'user_id','title', 'status', 'meeting_url', 'date_to_start', 'time_to_start'];


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function get_all($condition, $id = 'id'){

        $course = live_stream_model::where($condition)->orderBy($id,'desc')->get();

        return $course;

    }

}
