<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Subject;
use App\Lesson;
use App\User;
use Cache;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        //
        // if(Auth::user() && Auth::user()->hasRole('teacher')){
            $totalSubjects = Cache::remember('totalSubjects', 5 , function () {
                return Subject::count();
            });

            $totalLessons = Cache::remember('totalLessons', 5 , function () {
                return Lesson::count();
            });

            $totalStudents = Cache::remember('totalStudents', 5 , function () {
                return User::whereHas('roles',function($q){
                    $q->where('display_name','=','student');
                })->count();
            });

            foreach ( [
                'totalSubjects' => $totalSubjects,
                'totalLessons' => $totalLessons,
                'totalStudents' => $totalStudents,
                ] as $key => $value) {
                    View::share($key, $value);
                }
            // }
        }

        /**
        * Register any application services.
        *
        * @return void
        */
        public function register()
        {
            //
        }
    }
