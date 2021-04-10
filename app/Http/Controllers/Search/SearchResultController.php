<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course_model;

class SearchResultController extends Controller
{
    //
    function __construct(course_model $course_model){
        $this->course_model = $course_model;
    }

    public function searchThroughRecords(Request $request){

        $query = course_model::query();
        $columns = ['name', 'description', 'short_caption'];
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $request->seach_query . '%');
        }

        $seach_result = $query->get();

        return $seach_result;

        return view('front_end.search_result');
    }
}
