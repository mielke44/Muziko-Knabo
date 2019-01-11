<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Submit(Request $r){
        $allwdext=['wma','mp3','msv','webm'];
        $file=$r->file('file');
        //Storage::disk('local')->exists('teste.json');
        $data[] = array(
            'Header' => 'New Mail from Soir Music!',
            //'name' => $r->name,
            //'songname' => $r->songname,
            //'sender' => $r->email,
            //'service' => $r->service,
        );
        $file->move('brunoberndt/SoirMusic/storage/app/User_music_samples',$file->getClientOriginalName());
        //Storage::put('User_music_samples', $file);
        /*
        Mail::send('mail',$data,
        function($message) use ($data) {
            $message->from('SoirMusicSupport@test.com', 'Soir Music');
            $message->to('contact.brunorios@gmail.com');
            $message->subject('Soir Music Request');
        });
        */
    }
    public function Home(){
        return view('/app');
    }

}
