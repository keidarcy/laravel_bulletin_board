<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Post;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMessages;




class MessageController extends Controller
{
    public function add(Request $request, $send_to_user_id)
    {
        if($request->isMethod('get'))
        {
            return view('get_message_add',['send_to_user_id'=>$send_to_user_id]);
        }else
        {

            global $send_to_email;
            $send_to_email = User::find($send_to_user_id)->email;

            $validate_rules = [
                "message" => "required"
            ];

            $validator = validator::make($request->all(), $validate_rules);

            if($validator->fails())
            {
                return redirect()->route('get_message_add')->withErrors($validator)->withInput();
            }

            $user = Auth::user();

            $message = new Message();
            $message->send_by_user_id = $user->id;
            $message->send_to_user_id = $send_to_user_id;
            $message->message = $request->message;
            $message->edited_time = date('Y-m-d H:i:s');
            $message->save();


            // global $content;
            $content = [];
            $content['message'] = $request->message;
            $content['name'] = Auth::user()->name;
            // Mail::send(new SendMessages($content),['name'=>'admin'],function($message)
            // {
            //     global $send_to_email;
            //
            //     $message->to($send_to_email)->subject('You got a new message from  '. Auth::user()->name);
            //     $message->from('keidarcy.1015@gmail.com','');
            // });
            //
            //
            // Mail::send(['text'=>'name'],['name'=>'admin'],function($message)
            // {
            //     global $send_to_email;
            //
            //     $message->to($send_to_email)->subject('You got a new message from  '. Auth::user()->name);
            //     $message->from('keidarcy.1015@gmail.com','');
            // });

            Mail::to($send_to_email)->send(new SendMessages($content));

            $posts = Post::orderBy('updated_at', 'desc')->search($request->keyword)->get();
            return view('index' ,['posts'=>$posts]);
        }
    }


    public function inbox()
    {
        $messages = Message::where('send_to_user_id',Auth::id())->where('deleted_by_user_flg',0)->orderby('created_at','desc')->get();
        foreach($messages as $message)
        {
            if(!$message->unread_flg)
            {
                $message->unread_flg = 1;
            }
            $message->save();
        }
        return view('subviews.get_message_inbox', ['get_messages'=>$messages]);
    }

    public function sent()
    {
        $messages = Message::where('send_by_user_id',Auth::id())->where('deleted_by_user_flg',0)->orderby('created_at','desc')->get();
        return view('subviews.get_message_sent', ['send_messages'=>$messages]);
    }

    public function move_to_trash($id)
    {
        $message = Message::find($id);
        $message->deleted_by_user_flg = 1;
        $message->save();
        // if($message){}
        return redirect()->route('get_message_sent');
    }

    public function trash()
    {
        $messages = [];
        $messages = Message::where('send_to_user_id',Auth::id())->where('deleted_by_user_flg',1)->orderby('created_at','desc')->get();
        // $by_messages = Message::where('send_by_user_id',Auth::id())->where('deleted_by_user_flg',1)->orderby('created_at','desc')->get();
        // $messages[] = $to_messages;
        // $messages[] = $by_messages;
        return view('subviews.get_message_trash', ['trash_messages'=>$messages]);
    }


}
