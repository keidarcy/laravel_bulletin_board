@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="">Inbox <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link" href="{{ route('get_message_sent') }}">Sent</a>
                            <a class="nav-item nav-link" href="{{ route('get_message_trash') }}">Trash</a>
                            <a class="nav-item nav-link" href="{{ route('get_friend_index') }}">Friend</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>


    @foreach($get_messages as $get_message)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            A message sent by
                            <span style="font-size: 24px; ">
                                {{ Auth::user()->find($get_message->send_by_user_id)->name }}
                            </span>
                            {{ $get_message->time_diff($get_message->id) }}

                            <p>{{ $get_message->message }}</p>
                            <div align="right">
                                <a href="">reply</a>
                                <a href="{{ route('get_message_move_to_trash',['id' => $get_message->id]) }}">delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection
