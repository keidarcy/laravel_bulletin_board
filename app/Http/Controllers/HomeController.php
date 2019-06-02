<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function mail()
{
   $name = 'Krunal';
   Mail::to('keidarcy.1015@gmail.com')->send(new SendMail($name));
   // $content = 'test content';
   // Mail::to('keidarcy.1015@gmail.com')->send(new SendMail($name))
   Mail::send(['text'=>'name'],['name'=>'bobi'],function($message)
   {
       $message->to('keidarcy.1015@gmail.com')->subject('test mail');
       $message->from('keidarcy.1015@gmail.com','');
   });
   return redirect()->route('get_post_index');
}
}
