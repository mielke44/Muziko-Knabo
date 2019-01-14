<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
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
        
        Mail::send('mail',$data,
        function($message) use ($data, $file) {
            $message->from('noreplyservice@soirmusic.com','You got Mail from Soir music!');
            //$message->to('contact.brunorios@gmail.com');
            $message->to('wilson.mielke@gmail.com');
            $message->subject('Soir Music Request');
            $message->attach($file->getRealPath(),array('as'=>$file->getClientOriginalName(),'mime'=>$file->getMimeType()));
        });
        Storage::delete($file->getClientOriginalName());
    }
    public function Home(){
        return view('/app');
    }

}
