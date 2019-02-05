<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttachedMail;
use App\Mail\QuestionMails;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Submit(Request $r){
        $types = ['audio/basic','audio/mid','audio/mpeg','audio/mp4','audio/vnd.wav','application/octet-stream'];
        $file=$r->file('file');
        //if($file->getClientSize()>10000)return json_encode(array('error'=>true,'message'=>'File size must be under 10MB!'));
        //if(!in_array($file->getClientMimeType(),$types))return json_encode(array('error'=>true,'message'=>'Audio File extension not accepted!'));
        $data = [
            'Header' => 'Update from Soir Music',
            'name' => $r['name'],
            'songname' => $r['songname'],
            'sender' => $r['email'],
            'service' => $r['service'],
        ];
        $path = Storage::disk('local')->putFileAs('',$file,$file->getClientOriginalName());
        Mail::send(new AttachedMail($data,$file->getClientOriginalName(),$path));
        Storage::delete($file->getClientOriginalName());
        return json_encode(array('error'=>false, 'message'=>'Mail sent successfully!'));
    }
    public function Home(){
        return view('/app');
    }
    public function SubmitQuestion(Request $r){
        $data = [
            'name' => $r['name'],
            'email' => $r['email'],
            'question' => $r['question'],
        ];
        $rcpt = "contact.brunorios@gmail.com";

        //$textBruno = $data['name']." Has asked a question: \n".$data['question']."\n\n\n Reply to:".$data['email'];
        //$textUser = "Hello ".$r['name']."!"."\n\n We at Soir Music received your question:\n".$r['question']
        //."\n And we already have our top experts working on it!\n In a few we will be replying you in this address with the answer!";
        Mail::send(new QuestionMails($data,$rcpt,$textBruno));
        //Mail::send(new QuestionMails($data,$r['email'],$textUser));
        //not sending mail to the user as of jan 2019; Maybe later this will be used.

        return json_encode(array('error'=>false, 'message'=>'Mail sent successfully to: '.$rcpt));
    }

}
