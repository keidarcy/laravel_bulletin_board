@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="{{ route('get_message_inbox') }}">Inbox <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link active" href="">Sent</a>
                            <a class="nav-item nav-link" href="{{ route('get_message_trash') }}">Trash</a>
                            <a class="nav-item nav-link" href="{{ route('get_friend_index') }}">Friend</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>


    @foreach($send_messages as $send_message)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            YOU  sent this message to
                            <span style="font-size: 24px; ">
                                {{ Auth::user()->find($send_message->send_to_user_id)->name }}
                            </span>
                            {{ $send_message->time_diff($send_message->id) }}

                            <p>{{ $send_message->message }}</p>
                            <div align="right">
                                <a href="{{ route('get_message_move_to_trash',['id' => $send_message->id]) }}">delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endsection
