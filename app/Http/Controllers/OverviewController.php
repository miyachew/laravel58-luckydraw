<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Member;

class OverviewController extends Controller
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
    public function getOverview()
    {
        $members = Member::with('winningNumbers')->get();
        return view('page.overview',['members'=>$members]);
    }
}
