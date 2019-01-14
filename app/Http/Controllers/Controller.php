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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Submit(Request $r){
        $file=$r->file('file');
        $data[] = array(
            'Header' => 'New Mail from Soir Music!',
            // 'name' => $r->name,
            // 'songname' => $r->songname,
            // 'sender' => $r->email,
            // 'service' => $r->service,
            'name' => '$r->name',
            'songname' => '$r->songname',
            'sender' =>' $r->email',
            'service' => '$r->service',
        );
        Storage::move($file->getClientOriginalName(),'brunoberndt/SoirMusic/storage/app/User_music_samples/');
        
        Mail::send('mail',$data,
        function($message) use ($data) {
            $message->to('wilson.mielke@gmail.com');
            $message->subject('Soir Music Request');
        })->attach('brunoberndt/SoirMusic/storage/app/User_music_samples/'.$file->getclientoriginalname(),['as' =>'UserSample'.$file->getClientOriginalExtension(), 'mime'=>$file->getClientMimeType()]);
        
    }
    public function Home(){
        return view('/app');
    }

}
