@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="{{ route('get_message_inbox') }}">Inbox <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link" href="{{ route('get_message_sent') }}">Sent</a>
                            <a class="nav-item nav-link" href="">Trash</a>
                            <a class="nav-item nav-link active" href="">Friend</a>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>





    {{-- @php dd($friends)   @endphp --}}
    @foreach($friends as $friend)
        @if( Auth::id() == $friend->friend_id && $friend->friend_flg==0)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                You got a friend request from
                                <span style="font-size: 24px; ">
                                    {{ Auth::user()->find($friend->user_id)->name }}
                                </span>
                                <div align="right">
                                    <span >
                                        <a href="{{ route('get_friend_ignore',['id' => $friend->user_id]) }}">ignore</a>
                                    </span>
                                    &nbsp&nbsp
                                    <span align="right">
                                        <a href="{{ route('get_friend_accpet',['id' => $friend->user_id]) }}">accpet</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection

@section('second')
    @foreach($friends as $friend)
        @if( Auth::id() == $friend->user_id && $friend->friend_flg==0)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                You sent a friend request to
                                <span style="font-size: 24px; ">
                                    {{ Auth::user()->find($friend->friend_id)->name }}
                                </span>
                                <div align="right">
                                    <a href="{{ route('get_friend_delete',['id' => $friend->friend_id]) }}">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('third')
    @foreach($friends as $friend)
        @if( Auth::id() == $friend->friend_id && $friend->friend_flg==1)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                @php $user = App\User::find($friend->friend_id) @endphp
                                <img src="{{ asset($user->image) }}" height="100" width="100">
                                {{ $user->name }}
                                <span align="right">
                                    <a href="{{ route('get_friend_delete',['id' => $friend->friend_id]) }}">delete</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if( Auth::id() == $friend->user_id && $friend->friend_flg==1)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                @php $user = App\User::find($friend->user_id) @endphp
                                <img src="{{ asset($user->image) }}" height="100" width="100">
                                {{ $user->name }}
                                <span align="right">
                                    <a href="{{ route('get_friend_delete',['id' => $friend->friend_id]) }}">delete</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
