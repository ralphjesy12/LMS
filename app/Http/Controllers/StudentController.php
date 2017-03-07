<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\User;
use App\UserInfo;
use Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        if (!Auth::check()) {
            return redirect()->intended('login');
        }
    }

    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $users = User::whereHas('roles',function($q){
            $q->where('display_name','=','student');
        });

        if( $request->has('section') && $request->section!='All Sections' ){
            $section = $request->section;
            $users = $users->whereHas('infos', function ($query) use ($section){
                $query->where('value', 'like', $section);
            });
        }

        if(!($request->has('showarchived') && $request->showarchived)){
            $users = $users->whereDoesntHave('infos', function ($query){
                $query->where([
                    ['value', '=', '1'],
                    ['key', '=' ,'isarchived']
                ]);
            });
        }

        $users = $users->orderby('name','ASC')->paginate(10);

        foreach ($users as $key => $u) {
            $users[$key]->parent = User::find($u->infos()->where('key','parent')->value('value'));
        }

        $sections = UserInfo::distinct()->select('value')->where('key','section')->get();

        return view('home-teacher-student',[
            'students' => $users,
            'sections' => $sections
        ]);
    }

    public function indexOverview(Request $request)
    {
        $users = User::whereHas('roles',function($q){
            $q->where('display_name','=','student');
        });

        if( $request->has('section') && $request->section!='All Sections' ){
            $section = $request->section;
            $users = $users->whereHas('infos', function ($query) use ($section){
                $query->where('value', 'like', $section);
            });
        }

        $users = $users->orderby('name','ASC')->paginate(10);

        foreach ($users as $key => $u) {
            $users[$key]->parent = User::find($u->infos()->where('key','parent')->value('value'));
        }


        $sections = UserInfo::distinct()->select('value')->where('key','section')->get();
        return view('home-teacher-student-overview',[
            'subjects' => Subject::all(),
            'students' => $users,
            'sections' => $sections
        ]);
    }

    public function create(){
        return view('home-teacher-student-create');
    }

    public function edit($id){
        return view('home-teacher-student-edit',[
            'student' => User::findOrFail($id),
        ]);
    }
    public function destroy($id){
        User::findOrFail($id)->delete();
        return back();
    }

    public function update(Request $request,$id){
        $validator = Validator::make([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ], [
            'email' => [
                'email',
                'required',
                'min:6',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'password' => 'required_with:password_confirmation|confirmed',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput(
                $request->except('password')
            );
        }

        $toUpdate = [
            'email' => $request->email,
            'name' => $request->name,
        ];

        if(!empty($request->password)){
            $toUpdate['password'] = bcrypt($request->password);
        }

        User::find($id)->update($toUpdate);

        $userInfo = [
            'birthday' => $request->birthday,
            'idnum' => $request->idnum,
            'section' => $request->section,
            'contact' => $request->contact,
            'address' => $request->address,
        ];

        foreach ($userInfo as $key => $value) {
            UserInfo::updateOrCreate([
                'user_id' => $id,
                'key' => $key,
            ],[
                'value' => $value
            ]);
        }


        return back()->with([
            'status' => 'Student Profile Updated Successfuly'
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ], [
            'email' => [
                'email',
                'required',
                'unique:users',
                'min:6',
            ],
            'name' => 'required',
            'password' => 'required_with:password_confirmation|confirmed',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput(
                $request->except('password')
            );
        }

        $toUpdate = [
            'email' => $request->email,
            'name' => $request->name,
        ];

        if(!empty($request->password)){
            $toUpdate['password'] = bcrypt($request->password);
        }

        $user = User::create($toUpdate);

        $user->attachRole(2);

        $userInfo = [
            'birthday' => $request->birthday,
            'idnum' => $request->idnum,
            'section' => $request->section,
            'contact' => $request->contact,
            'address' => $request->address,
        ];

        foreach ($userInfo as $key => $value) {
            UserInfo::updateOrCreate([
                'user_id' => $user->id,
                'key' => $key,
            ],[
                'value' => $value
            ]);
        }


        return back()->with([
            'status' => 'Student Profile Created Successfuly'
        ]);
    }

    public function home()
    {

        return view('home-student',[
            'subjects' => Subject::all(),
            'activities' => Auth::user()->activities()->latest('updated_at')->paginate(10)
        ]);
    }

    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjects()
    {
        $subjects = Subject::simplePaginate(15);
        return view('home-student-subjects',[
            'subjects' => $subjects
        ]);
    }
    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjectLessons($id)
    {
        $subjects = Subject::findOrFail($id)->lessons()->simplePaginate(15);
        return view('home-student-subjects',[
            'subjects' => $subjects
        ]);
    }
    public function setarchive($id,$archive)
    {
        UserInfo::updateOrCreate([
            'user_id' => $id,
            'key' => 'isarchived',
        ],[
            'value' => $archive
        ]);

        return back();
    }

    public function archive(Request $request){
        if($request->has('section')){

            $users = User::whereHas('roles',function($q){
                $q->where('display_name','=','student');
            });

            if( $request->has('section') && $request->section!='All Sections' ){
                $section = $request->section;
                $users = $users->whereHas('infos', function ($query) use ($section){
                    $query->where('value', 'like', $section);
                });
            }

            $users->chunk(100, function ($users) {
                foreach ($users as $user) {
                    UserInfo::updateOrCreate([
                        'user_id' => $user->id,
                        'key' => 'isarchived',
                    ],[
                        'value' => true
                    ]);
                }
            });

            return back();

        }
    }


}
