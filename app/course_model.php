<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class course_model extends Model
{
    //
    protected $table = 'course_tb';
    protected $primaryKey = 'unique_id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that aren't mass assignable. The empty array means none of the columns is guarded.
     *
     * @var array
     */
    protected $guarded = ['unique_id', 'category_id', 'name', 'description', 'cover_image', 'intro_video', 'pricing',];
}
