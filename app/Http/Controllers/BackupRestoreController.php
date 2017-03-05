<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Artisan;
use Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class BackupRestoreController extends Controller
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
    public function index()
    {
        // $files = Artisan::call('backup:mysql-restore', [
        //     '--all-backup-files' => true,
        // ]);
        $lastRestore = false;
        $filename = 'backups/lms.sql';

        if(Storage::disk('local')->exists($filename)){
            $lastRestore = Storage::disk('local')->lastModified($filename);
            $dt = Carbon::now();
            $dt->timestamp = (float)$lastRestore;
            $dt->timezone = date_default_timezone_get();


            // Size
            $bytes = Storage::disk('local')->size($filename);
            $precision = 2;
            $units = array('B', 'KB', 'MB', 'GB', 'TB');

            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);

            // Uncomment one of the following alternatives
            $bytes /= pow(1024, $pow);
            // $bytes /= (1 << (10 * $pow));

            $size = round($bytes, $precision) . ' ' . $units[$pow];

            $lastRestore = [
                'size' => $size,
                'date' => $dt
            ];
        }


        return view('backuprestore',compact([
            'lastRestore'
        ]));
    }

    public function create(){
        Artisan::call('backup:mysql-dump', [
            'filename' => 'lms.sql',
        ]);

        return back()->with('status','Backup Created Successfully');
    }

    public function restore(){
        Artisan::call('backup:mysql-restore', [
            '--filename' => 'lms.sql',
            '--yes' => true
        ]);

        return back()->with('status','Backup Restored Successfully');
    }
    public function delete(){
        Storage::delete('backups/lms.sql');
        return back()->with('status','Backup Deleted Successfully');
    }


}
