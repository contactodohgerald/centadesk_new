<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\Generics;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use Generics;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_type' => ['required'],
            'referred_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data): User
    {
        $user = $this->user->getAllUsers([
            ['referred_id', $data['referred_id']]
        ]);
        $now = Carbon::now()->addDays(14);

        if(count($user) > 0){
            return User::create([
                'unique_id' => $this->createUniqueId('users', 'unique_id'),
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'user_type' => $data['user_type'],
                'email' => $data['email'],
                'user_referral_id' => $this->createUniqueIdForReferral(8, 'users', 'user_referral_id'),
                'referred_id' => $data['referred_id'],
                'password' => Hash::make($data['password']),
                'account_activation_date_counter' => $now->toDateTimeString(),
            ]);
        }else{
            return redirect()->back()->with('error', 'Please provide a valid Refrral Id');
        }
    }
}
