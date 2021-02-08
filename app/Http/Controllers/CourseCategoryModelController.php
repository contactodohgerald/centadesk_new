<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\course_category_model;
use App\Traits\Generics;
use App\Traits\appFunction;

class CourseCategoryModelController extends Controller
{
    use Generics;
    use appFunction;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'description' => 'required|min:5'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $name = $request->input('name');
            $description = $request->input('description');

            $course_category = course_category_model::create([
                'unique_id' => $unique_id,
                'name' => $name,
                'description' => $description,
            ]);

            if (!$course_category->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                return response()->json(['message' => $this->successMsg('Category')['msg'], 'status' => true]);
            }
        } catch (Exception $e) {

            $errorsArray = [$e->getMessage()];
            return response()->json(['message' => ['error' => $errorsArray], 'status' => false]);
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
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function show(course_category_model $course_category_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function edit(course_category_model $course_category_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course_category_model $course_category_model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(course_category_model $course_category_model)
    {
        //
    }
}
