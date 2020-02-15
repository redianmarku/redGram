<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()-> user()->id;
        $user = User::find($user_id);
        return view('home')->with('posts', $user->posts);
    }

    public function home(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        $context = array(
            'services'=> ['Web Development', 'Back-end Developer', 'Front-end Developer']
        );
        return view('pages.services')->with($context);
    }
}
