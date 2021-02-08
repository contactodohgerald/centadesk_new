<?php

namespace App;

use App\course_category_model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class course_model extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'course_tb';
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
    protected $fillable = ['unique_id', 'category_id','user_id', 'name', 'description', 'cover_image', 'intro_video', 'pricing','short_caption','course_urls','status','ratings','views','like','shares'];


    /**
     * Get the category asssociated with a particular course.
     *
     * @return void
     */
    public function category()
    {
        return $this->hasOne('App\course_category_model','unique_id','category_id');
    }
}
