<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Update;
use App\Models\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.home');
    }

    public function testing()
    {
        /*$zip_file = 'invoices.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = public_path('files');
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();

                // extracting filename with substr/strlen
                $relativePath = 'files/' . substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();*/

        $cURLConnection = curl_init();

        curl_setopt($cURLConnection, CURLOPT_URL, 'http://ubk.sutabu.com/cbt/cek-server');
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $phoneList = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        $jsonArrayResponse = json_decode($phoneList);
        dd($jsonArrayResponse);

        /*$upt = new Update;
            $upt->tanggal = date('Y-m-d');
            $upt->status = 0;
            $upt->save();*/
        /*$commands = array(
                'echo $PWD',
                'whoami',
                'git status',
                'git pull'
            );
            // Run the commands for output
            $output = '';
            foreach($commands AS $command){           
                $output .= shell_exec($command);      
            } 

            echo $output;*/
        /*$data = array(
            'from'      => \Config::get('app.from_email'),
            'to'        => 'cakra.amin@gmail.com',
            'password'  => 'okelah',
            'nama'      => 'cakra',
            'title'     => 'Customer',
            'link'      => 'okelah'
        );        

        \Mail::send('email.new', $data, function ($message) use ($data) {
            $message->subject('Register New User');
            $message->from($data['from'], 'Konseen');
            $message->to($data['to']);
        });*/

    }

    public function detail($slug)
    {
        $materi = Materi::where('slug', $slug)->first();

        if(!$materi){
            return view('404');
        }

        return view('home-detail')->with('materi',$materi);   
    }

    public function read($slug)
    {
        \Session::pull('redirects');

        if(\Auth::guest()){
            \Session::push('redirects', url('read/'.$slug));

            return redirect('read-login');
        }

        $materi = Materi::where('slug', $slug)->first();

        if(\Auth::check()){
            $cek = View::where('user_id', \Auth::user()->id)->where('materi_id',$materi->id)->first();
            if(!$cek){
                $view = new View;
                $view->user_id = \Auth::user()->id;
                $view->materi_id = $materi->id;
                $view->save();
            }
        }

        if(empty($materi)){

        }

        return view('read-materi')->with('materi',$materi);
    }

    public function login()
    {
        return view('login-read');
    }

    public function deploy()
    {
        $commands = array(
            'echo $PWD',
            'whoami',
            'git status',
            'git pull'
        );
            // Run the commands for output
        $output = '';
        foreach($commands AS $command){           
            $output .= shell_exec($command);      
        } 

        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('migrate');

        echo $output;
    }

    public function artisan()
    {
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('migrate');

        dd('artisan jalan');
    }
}
