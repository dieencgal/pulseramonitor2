<?php

namespace App\Http\Controllers;
use File;
use Auth;




class ContactsController extends Controller
{
    public function import()
    {
        $records = [];

        $path = base_path('resources/pendingcontacts/'.Auth::user()->name);


        foreach (glob($path.'/*.csv') as $file) {
            $file = new \SplFileObject($file, 'r');
            $file->seek(PHP_INT_MAX);
            $records[] = $file->key();
        }
        $toImport = array_sum($records);

        return view('import', compact('toImport'));
    }

    public function parseImport()
    {
        if(!File::exists('res/pendingcontacts/'.Auth::user()->name)) {
            File::makeDirectory('res/pendingcontacts/'.Auth::user()->name, $mode = 0777, true, true);
        }

        $path2 = 'res/pendingcontacts/'.Auth::user()->name.'/';
        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        //get file from upload
        $path = request()->file('file')->getRealPath();


        //turn into array
        $file = file($path);

        //remove first line
        $data = array_slice($file, 1);

        //loop through file and split every 1000 lines
        $parts = (array_chunk($data, 1000));
        $i = 1;

        foreach($parts as $line) {
            $filename = base_path('resources/pendingcontacts/'.Auth::user()->name.'/'.date('y-m-d-H-i-s').$i.'.csv');
            file_put_contents($filename, $line);
            $i++;
        }

        session()->flash('status', 'queued for importing');


        return redirect("import");
    }
}
