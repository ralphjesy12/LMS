<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Subject;
use App\Lesson;


class SubjectController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        return view('subjects',[
            'subjects' => Subject::paginate(8)
        ]);
    }

    public function indexLessons($subject)
    {
        $subject = Subject::findOrFail($subject);

        return view('subject-lessons',[
            'subject' => $subject,
            'lessons' => $subject->lessons()->paginate(8)
        ]);
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
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);


        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $subject = Subject::create($request->only(['title','description']));

        return back()->with([
            'status' => 'Subject created successfully!',
            'subject' => $subject->id
        ]);

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
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
