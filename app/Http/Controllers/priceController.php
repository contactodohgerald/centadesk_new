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

    function __construct(priceModel $priceModel)
    {
        $this->middleware('auth');
        $this->priceModel = $priceModel;
    }

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
        $priceModel = $this->priceModel->getAllPricing();

        return view('dashboard.view-prices', ['priceModel'=>$priceModel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.create_price');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:20',
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/create_price')->with('error_message', $validator->errors());
            }

            $pricing = new priceModel();
            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $pricing->unique_id = $unique_id;
            $pricing->title = $data['title'];
            $pricing->amount = $this->getAmountForDatabase($data['amount'])['data']['amount'];

            if ($pricing->save()) {
                return redirect('/create_price')->with('success_message', 'Course Price was created Successfully');
            } else {
                return redirect('/create_price')->with('error_message', 'An error occurred, please try again later');
            }
        } catch (Exception $e) {

            $errorsArray = [$e->getMessage()];
            return redirect('/create_price')->with('error_message', $errorsArray);
        }
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
