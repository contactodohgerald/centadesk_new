<?php

namespace App\Http\Controllers;

use App\priceModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\Generics;
use App\Traits\appFunction;

class priceController extends Controller
{
    use Generics;
    use appFunction;


    // function __construct()
    // {
    //     $this->middleware('auth');
    // }
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
        // return $request['title'];
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:15',
                'amount' => 'required|max:9',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'status' => false]);
            }
            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $title = $request['title'];
            $amount = $request['amount'];

            $pricing = priceModel::create([
                'unique_id' => $unique_id,
                'title' => $title,
                'amount' => $amount,
            ]);

            if (!$pricing->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                return response()->json(['message' => $this->successMsg('Pricing')['msg'], 'status' => true]);
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
