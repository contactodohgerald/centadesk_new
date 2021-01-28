<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class course_category_model extends Model
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $table = 'course_category_tb';
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
    protected $fillable = ['unique_id', 'name', 'description'];
}
