<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\course_category_model;
use App\priceModel;
use App\course_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\appFunction;
use App\Traits\Generics;

class courseController extends Controller
{
    use Generics;
    use appFunction;

    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = course_category_model::all();
        $all_price = priceModel::all();
        $user = auth()->user();
        $view = [
            'category' => $all_category,
            'pricing' => $all_price,
            'user' => $user,
        ];
        // return $view;
        return view('dashboard.create-course', $view);
    }
    /**
     * Display page for updating course.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_page($id)
    {
        $course = course_model::find($id);
        $all_category = course_category_model::all();
        $all_price = priceModel::all();
        $view = [
            'course'=> $course,
            'category' => $all_category,
            'pricing' => $all_price,
        ];
        // return $view;
        return view('dashboard.edit-course', $view);
    }

    public function gen_file_name($user,$title,$file)
    {
        $name = $this->slugify($user['name'] . '-' . $user['last_name'] . '-' . $title. '-' .'cover image').'.'. $file->getClientOriginalExtension();
        return $name;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        // return $user;

        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:40|unique:course_tb,name',
                'category' => 'required|string',
                'caption' => 'required|string|max:100',
                'pricing' => 'required|string',
                'desc' => 'required',
                'url' => 'required',
                'cover_img' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
                'cover_video' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $title = $request->input('title');
            $category = $request->input('category');
            $caption = $request->input('caption');
            $pricing = $request->input('pricing');
            $description = $request->input('desc');
            $url = $request->input('url');
            $cover_img = $request->file('cover_img');
            $cover_video = $request->input('cover_video');
            $user_id = $user['unique_id'];

            // generate file name
            $img_name = $this->gen_file_name($user,$title,$cover_img);
            $upload_img = $cover_img->storeAs(
                'public/course-img', $img_name
            );
            // return [$caption];

            $new_course = course_model::create([
                'unique_id' => $unique_id,
                'name' => $title,
                'category_id' => $category,
                'user_id' => $user_id,
                'short_caption' => $caption,
                'pricing' => $pricing,
                'description' => $description,
                'course_urls' => $url,
                'cover_image' => $img_name,
                'intro_video' => $cover_video
            ]);

            if (!$new_course->unique_id) {
                throw new Exception('Database Error!');
            } else {
                $error = 'Course Created!';
                return response()->json(["message" => $error, 'status' => true]);
            }


        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => $error,
            ];
            return response()->json(["message" => $error, 'status' => false]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the teacher created courses.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        $courses = course_model::where('user_id',$user['unique_id'])
                ->orderBy('id','desc')
                ->get();
        $view = [
            'courses' => $courses,
            'user' => $user,
        ];
        // return $view;
        return view('dashboard.view-courses',$view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        // return $user;

        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:40|unique:course_tb,name',
                'category' => 'required|string',
                'caption' => 'required|string|max:100',
                'pricing' => 'required|string',
                'desc' => 'required',
                'url' => 'required',
                'cover_video' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            if($request->file('cover_img')){
                $validator = Validator::make($request->all(), [
                    'cover_img' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors(), 'status' => false]);
                }
            }

            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $title = $request->input('title');
            $category = $request->input('category');
            $caption = $request->input('caption');
            $pricing = $request->input('pricing');
            $description = $request->input('desc');
            $url = $request->input('url');
            $cover_img = $request->file('cover_img');
            $cover_video = $request->input('cover_video');
            $user_id = $user['unique_id'];

            // generate file name
            $img_name = $this->gen_file_name($user,$title,$cover_img);
            $upload_img = $cover_img->storeAs(
                'public/course-img', $img_name
            );
            // return [$caption];

            $new_course = course_model::create([
                'unique_id' => $unique_id,
                'name' => $title,
                'category_id' => $category,
                'user_id' => $user_id,
                'short_caption' => $caption,
                'pricing' => $pricing,
                'description' => $description,
                'course_urls' => $url,
                'cover_image' => $img_name,
                'intro_video' => $cover_video
            ]);

            if (!$new_course->unique_id) {
                throw new Exception('Database Error!');
            } else {
                $error = 'Course Created!';
                return response()->json(["message" => $error, 'status' => true]);
            }


        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => $error,
            ];
            return response()->json(["message" => $error, 'status' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
