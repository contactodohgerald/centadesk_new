<?php

namespace App\Http\Controllers\AppSettings;

use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\CurrencyRatesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppSettingsController extends Controller
{
    //
    function __construct(AppSettings $appSettings, CurrencyRatesModel $currencyRatesModel)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->currencyRatesModel = $currencyRatesModel;
    }

    public function mainSettings(){

        $currencyRatesModel = $this->currencyRatesModel->getAllCurrency();

        return view('dashboard.setting', ['currencyRatesModel'=>$currencyRatesModel]);

    }

    public function appSettings(){

        $condition = [
            ['unique_id', 'ozV4GtwTx6AMa0yiIQk4ef025573572a01ea']
        ];

        $appSettings = $this->appSettings->getSingleAppSettings($condition);


        return view('dashboard.app_setting', ['appSettings'=>$appSettings]);

    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'company_url' => 'required',
        ]);

    }

    public function updateAppSettings(Request $request, $unique_id){

        $data = $request->all();

        try{
            $this->Validator($request);//validate fields

            $condition = [
                ['unique_id', $unique_id]
            ];

            $appSettings = $this->appSettings->getSingleAppSettings($condition);

            $appSettings->company_name = $data['company_name'];
            $appSettings->company_url = $data['company_url'];
            $appSettings->company_email_1 = $data['company_email_1'];
            $appSettings->company_email_2 = $data['company_email_2'];
            $appSettings->company_phone_1 = $data['company_phone'];
            $appSettings->company_address = $data['company_address'];
            $appSettings->facebook_url = $data['facebook_url'];
            $appSettings->twitter_url = $data['twitter_url'];
            $appSettings->youtube_url = $data['youtube_url'];
            $appSettings->whatsApp_phone = $data['whatsApp'];
            $appSettings->instagram_url = $data['instagram_url'];

            if ($appSettings->save()){
                return redirect('/app_settings_page')->with('success_message', 'AppSettings Was Successfully Updated');
            }else{
                return redirect('/app_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('app_settings_page')->with('error_message', $errorsArray);

        }

    }


}