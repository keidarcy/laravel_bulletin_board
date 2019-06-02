@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('post_message_add',['send_to_user_id'=>$send_to_user_id]) }}" method="post">
                    @csrf
                    <div class="card-header">
                        SEND A MESSAGE TO {{ Auth::user()->find($send_to_user_id)->name }}
                        @if($errors->has('title'))
                            {{ $errors->first('title') }}
                            @endif
                    </div>

                    <div class="card-body">
                        <textarea name="message" placeholder="What do you want to say to {{ Auth::user()->find($send_to_user_id)->name }}?" rows="5" cols="90"></textarea>
                        @if($errors->has('message'))
                            {{ $errors->first('message') }}<br />
                            @endif
                            <input type="submit" value="send">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
