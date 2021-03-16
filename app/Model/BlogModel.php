<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogModel extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllBlogPost($condition, $id = 'id', $desc = 'desc'){
        return BlogModel::where($condition)->orderBy($id, $desc)->get();
    }

    function getSingleBlogPost($condition){
        return BlogModel::where($condition)->first();
    }
}
