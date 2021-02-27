<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class courseEnrollment extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'course_enrollments_tb';
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
    protected $fillable = ['unique_id', 'course_creator','user_enrolling', 'percentage'];

    /**
     * One to one relationship with user table.
     *
     * @return array
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
