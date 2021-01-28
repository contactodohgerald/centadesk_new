<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\course_category_model;
use App\priceModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class courseController extends Controller
{

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
        // return csrf_token();

        $all_category = course_category_model::all();
        $all_price = priceModel::all();
        $user = auth()->user();
        $view = [
            'category' => $all_category,
            'pricing' => $all_price,
            'user'=> $user,
        ];
        // return $view;
        return view('dashboard.create-course', $view);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->user(null);
        //
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'category' => 'required|string|max:15|unique:course_category_tb',
                'name' => 'required|string|max:15',
                'description' => 'required|min:5',
                // 'username' => 'required|string|max:15|unique:profile_tb',
                // 'gender' => 'required|string|max:10',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            $title = $request->input('title');
            $category = $request->input('category');
            $name = $request->input('name');
            $description = $request->input('description');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
