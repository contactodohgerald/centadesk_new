<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\live_stream_model;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(live_stream_model $live_stream)
    {
        $this->middleware('auth');
        $this->live_stream = $live_stream;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $condition = [
            ['deleted_at', null],
            ['status', 'live'],
        ];
        $live_streams = $this->live_stream->get_all($condition);
        $view = [
            'live_streams' => $live_streams,
            'user' => $user,
        ];
        return view('dashboard.index',$view);
    }
    /**
     * Clear application cache
     *
     * @return void
     */
    public function clear_cache()
    {
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('route:cache');
    }

    public function showToken()
    {
        return csrf_token();
    }
}
