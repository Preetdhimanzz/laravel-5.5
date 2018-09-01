<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $method = $request->method();
        if ($request->ajax() && $request->isMethod('get')) {
          $view = view('home',array('is' => false))->render();
          return response()->json(['html'=>$view]);
        } else {

          return view('home',array('is' => true));
        }

    }
}
