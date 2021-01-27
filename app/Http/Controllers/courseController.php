<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class courseController extends Controller
{

     function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return csrf_token();
        return view('dashboard.create-course');
    }

    // public function createNewGame(Request $request){
    //     $data = $request->all();

    //     $day = $data['total_number_days_before_draw'];

    //     $now = Carbon::now();

    //     $date = $now->addDays($day)->isoFormat('MMM D, YYYY h:mm:ss');

    //     try{
    //         $this->Validator($request);//validate fields

    //         $unique_id = $this->createUniqueId('lotto_settings', 'unique_id');

    //         $currencyRate = new CurrencyRatesModel;
    //         $convertedPrice = $currencyRate->getAmountForDatabase($data['lowest_stack_amount']);

    //         $newGames = new LottoSettings;
    //         $newGames->unique_id = $unique_id;
    //         $newGames->title_of_game = $data['title_of_game'];
    //         $newGames->type_of_game = $data['type_of_game'];
    //         $newGames->total_numbers = $data['total_numbers'];
    //         $newGames->total_numbers_to_select = $data['total_numbers_to_select'];
    //         $newGames->total_numbers_for_result = $data['total_numbers_for_result'];
    //         $newGames->total_number_days_before_draw = $date;
    //         $newGames->total_numbers_of_days_for_draw_in_number = $day;
    //         $newGames->lowest_stack_amount = $convertedPrice['data']['amount'];
    //         $newGames->percentage_win = $data['percentage_win'];
    //         $newGames->number_of_correct_games_for_a_win = $data['number_of_correct_correct_games'];

    //         if ($newGames->save()){
    //             return redirect('/create_game')->with('success_message', 'Game Was Created Successfully');
    //         }else{
    //             return redirect('/create_game')->with('error_message', 'An Error occurred, Please try Again Later');
    //         }

    //     }catch (Exception $exception){

    //         $errorsArray = $exception->getMessage();
    //         return  redirect('create_game')->with('error_message', $errorsArray);

    //     }
    // }

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
