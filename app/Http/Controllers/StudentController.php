<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::all();
        return view('home',compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $students->user_id = $users->id;
        $students->user_id = $request->get('user_id');
        $students->save();
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students=Student::find($id);
        return view('detailStudents',compact('students'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       
        $users=User::find(Auth::id());
        $students=Student::find($id);
        $students-> firstName = $request->get('fname');
        $students-> lastName = $request->get('lname');
        $students-> class = $request->get('class');
        $students-> description = $request->get('description');
        if($request->picture == null){
            $students -> picture = "student.png";
        }else {
            request()->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.request()->picture->getClientOriginalExtension();
            request()->picture->move(public_path('uploads\students'), $imageName);
            $students -> picture = $imageName;
        }
        $students->user_id = $users->id;
        $students->user_id = $request->get('user_id');
        $students->save();
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
