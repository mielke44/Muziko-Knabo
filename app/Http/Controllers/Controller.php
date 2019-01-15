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
        $path = Storage::disk('local')->putFileAs('',$file,$file->getClientOriginalName());
        Mail::send(new AttachedMail($data,$file->getClientOriginalName(),$file->getRealPath()));
        Storage::delete($file->getClientOriginalName());

        return json_encode(array('error'=>false, 'message'=>'Mail sent successfully!'));
    }
    public function Home(){
        return view('/app');
    }

}
