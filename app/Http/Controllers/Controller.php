<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttachedMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Submit(Request $r){
        
        $file=$r->file('file');
        $data[] = array(
            'Header' => 'New Mail from Soir Music!',
            'name' => $r->name,
            'songname' => $r->songname,
            'sender' => $r->email,
            'service' => $r->service,
        );
        $file->move('brunoberndt/SoirMusic/storage/app/User_music_samples/',$file->getClientOriginalName());
        
        print_r($file->getRealPath().'--->'.public_path());
        Mail::send(new AttachedMail($data, $file, $file->getRealPath()));
        //Mail::send('mail',$data,
        //function($message) use ($data, $file) {
        //    $message->attach($file->getRealPath(),array('as'=>$file->getClientOriginalName()));
        //});
        Storage::delete($file->getClientOriginalName());
    }
    public function Home(){
        return view('/app');
    }

}
