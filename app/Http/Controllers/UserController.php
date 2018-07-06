<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\Null_;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('role',false);
        $ar = array();

        foreach ($users as $user){
            $c = Course::where('user_id','=',$user->id)->first();
            $ar[$user->id]=$c==null?"NOT YET":$c->name;

        }
        return view('users')->with('users',$users)->with('courses',$ar);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'CourseName' => 'required'
        ]);

        $c = $request->CourseName ;
        $course = Course::where('name','=',$c)->first();
        if($course==null){
            return "This is not  A course";
        }
        if($course->user_id !=null){
            return "Only One admin per course";
        }



        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $pass = 123456;
        $user->password =bcrypt($pass);
        $user->save();

        $course->user_id = $user->id;
        $course->save();
        return redirect('/users');

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
        return view('edituser')->with('id',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',

        ]);

        $c = $request->CourseName ;

        if( Course::where('name','=',$c)->first() ==null){
            return 'please enter a valid course name';
        }

        if(Course::where('name','=',$c)->first()->user_id != null ){
            return "please enter a free course";
        }


        $course = Course::where('user_id','=',$id)->first();


           if($course!= null && $course->user_id != null) {
               $course->user_id = null;
               $course->save();
           }

        $user = User::where('id','=',$id)->first();
        $user->name=$request->name;
        $user->email=$request->email;

        $course = Course::where('name','=',$c)->first();
        if($course==null){
            return 'please enter a valid course';
        }
        $course->user_id=$id;
        $user->save();
        $course->save();
        return redirect('/users');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $course = Course::where('user_id',$id)->first();
        if($course!=null) {
            $course->user_id = Null;
            $course->save();
        }
        $user->delete();

        return redirect('/users');

    }
}
