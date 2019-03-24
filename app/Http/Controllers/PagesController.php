<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Zttp\Zttp;
use App\Message;
use App\Mail\MyMailClass;

class PagesController extends Controller
{
    //
    public function index(){
        return view('index');
    }
    public function addMessage(Request $request){
        $result=array();
        $result['status']='false';
        $response=Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'=>'6Le6GpkUAAAAAH6gViVpbaxNPCbRxteCF8DHRx40',
            'response'=>request('gRecaptchaResponse'),
            //'response'=>request('g-recaptcha-response'),
            'remoteip'=>request()->ip(),
        ]);
        if($response->json()['success']!=true){
            $result['status']='robot';
        }
        else{
            $messageDB=new Message;
            $messageDB->theme=strip_tags(request('theme'));
            $messageDB->userName=strip_tags(request('userName'));
            $messageDB->userEmail=strip_tags(request('userEmail'));
            $messageDB->organization=strip_tags(request('organization'));
            $messageDB->message=strip_tags(request('notes'));
            $messageDB->save();
            $messageText="<h2>".request('theme')."</h2>\n<p>".request('notes')."</p>";
            $headers="Content-type:text/html; charset=windows 1251 \r\n";
            $headers.="From: sergei.ahill@gmail.com";
            mail('info@newagelab.com', 'To test NewAgeLab', $messageText, $headers);
            $result['status']='success';
        }
        $data=json_encode($result);
        return $data;
    }
    public function getMessages(){
        $message=Message::orderBy('id', 'desc')->get();
        $data=json_encode($message);
        return $data;
    }
    public function setStaus(Request $request){
        $id=request('id');
        $result=[];
        $result['status']='false';
        $message=Message::find($id);
        if($message->status=='new'){
            $message->status='checked';
        }
        else {$message->status='new';}
        $message->save();
        $result['status']='success';
        $data=json_encode($result);
        return $data;
    }
    public function deleteMessage(Request $request){
        $id=request('id');
        $result=[];
        $result['status']='false';
        $message=Message::find($id);
        $message->delete();
        $result['status']='success';
        $data=json_encode($result);
        return $data;
    }
    public function oneMessage(Request $request){
        $id=request('id');
        $appeal=Message::find($id);
        return view('show', [
            'appeal'=>$appeal,
        ]);
    }
    public function editMessage(Request $request){
            $id=request('id');
            $message=Message::find($id);
            $message->theme=strip_tags(request('theme'));
            $message->userName=strip_tags(request('userName'));
            $message->userEmail=strip_tags(request('userEmail'));
            $message->organization=strip_tags(request('organization'));
            $message->message=strip_tags(request('notes'));
            $message->save();
            return view('dashboard');
    }
    public function test(Request $request){
        $id=1;
        $result['status']='false';
        $message=Message::find($id);
        if($message->status=='new'){
            $message->status='checked';
        }
        else {$message->status='new';}
        $message->save();
        $result['status']='success';
    }
}
