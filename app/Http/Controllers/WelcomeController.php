<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Winner;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $winners = Winner::with('winnerMember')->get()->sortBy('prize_type');
        return view('welcome',['winners'=>$winners]);
    }
}
