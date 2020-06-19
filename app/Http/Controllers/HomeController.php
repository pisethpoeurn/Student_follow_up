<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        $students=Student::all();
        return view('home',compact("students"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users=User::find(Auth::id());
        $students = new Student();
        $students->firstName = $request->get('fname');
        $students->lastName = $request->get('lname');
        $students->class = $request->get('class');
        $students->description = $request->get('description');
        if($request->hasFile('pic')){
            $image = $request->file('pic');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save( public_path('/uploads/students/' . $filename ) );
            $students->picture = $filename;
        }else{
            return $request;
            $students->image='';
        }
        // $students->picture = $request->get('pic');
        $students->user_id = $users->id;
        $students->save();
        return redirect('home');
    }

}
