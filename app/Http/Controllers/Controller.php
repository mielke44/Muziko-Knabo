<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttachedMail;
use App\Mail\QuestionMails;
use App\Mail\RatingMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Rate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Submit(Request $r){
        $types = ['mp3','wav','mp4','au','snd','mid','rmi'];
        $file=$r->file('file');
        if(!in_array($file->getClientOriginalExtension(),$types))return json_encode(array('error'=>true,'message'=>'File extension not accepted!'));
        $data = [
            'Header' => 'Update from Soir Music',
            'name' => $r['name'],
            'songname' => $r['songname'],
            'sender' => $r['email'],
            'service' => $r['service'],
            'ref_link' => $r['refs'],
        ];
        if($r['refs']=='')$data['ref_link']='No references!';
        $details=array('size'=>$file->getClientSize(),'MIME'=>$file->getClientMimeType(),'name'=>$file->getClientOriginalName(),'ext'=>$file->getClientOriginalExtension());
        $path = Storage::disk('local')->putFileAs('',$file,$file->getClientOriginalName());
        //files get uploaded to Project/Storage/app/
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
        Mail::send(new QuestionMails($data,$rcpt));
        return json_encode(array('error'=>false, 'message'=>'Mail sent successfully to: '.$rcpt));
    }

    public function getRatings(Request $r){
        $service='';
        switch($r['num']){
            case 1: $service="Songwriting";
                    break;
            case 2: $service="Production/Mixing";
                    break;
            case 3:$service="Song Critique";
                    break;
        }
        $ratings = Rate::where('service',$service)->orderBy('created_at','desc')->get();
        foreach($ratings as $rate){
            $rate['created']=explode(' ',$rate['created_at'])[0];
            //if($rate['rate']<4)
            //if($index=array_search($rate['rate'], $ratings) !== false)unset($ratings[$index]);
        }
        if(count($ratings)>0)return json_encode($ratings);
        else return json_encode('no rates');
    }

    public function SubmitRatings(Request $r){
        $rate = new Rate();
        $rate->name= $r['form']['name'];
        $rate->comment = $r['form']['rate'];
        $rate->rate = $r['form']['rating'];
        $rate->service = $r['service'];
        $data = [
            'name' => $r['form']['name'],
            'rate' => $r['form']['rate'],
            'rating' => $r['form']['rating'],
            'service' => $r['service']
        ];
        $rcpt = "contact.brunorios@gmail.com";
        $rate->save();
        Mail::send(new RatingMail($data,$rcpt));
        return json_encode(array('error'=>false, 'message'=>'Mail sent successfully to: '.$rcpt));
    }

    public function getSamples(Request $r){
        $service = '';
        if($r['num']==1)$service = 'Songwriting';
        if($r['num']==2)$service = 'Production';
        if($r['num']==3)$service = 'Analysis_Songs';
        $files = Storage::Files('public/Samples/'.$service);
        $samples = [];
        foreach($files as $file){
            if($file!=''){
                $sample = ['name'=>'','url'=>''];
                $sample['name']=explode('.',explode('/',$file)[3])[0];
                $url = "storage/Samples/".$service."/".explode('/',$file)[3];
                $sample['url']=$url;
                if($sample['name']!='')array_push($samples,$sample);
            }
        }
        return $samples;
    }

    function fileUploadMaxSize() {
        // Start with post_max_size.
        $post_max_size = ini_get('post_max_size');
        if ($post_max_size > 0) {
            $max_size = $post_max_size;
        }
        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max =ini_get('upload_max_filesize');
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    return json_encode($max_size.'B');
    }   
}
