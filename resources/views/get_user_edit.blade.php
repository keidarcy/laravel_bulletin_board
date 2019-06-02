@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">EDIT YOU PROFILE</div>
                  <form action="{{ route('post_user_edit') }}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="card-body">
                        name:<input type="text" name="name" value="{{ old('name', $user->name) }}">
                        @if($errors->has("name"))
                          <p>{{ $errors->first("name") }}</p>
                        @endif
                      </div>
                      <div class="card-body">
                        email:<input type="text" name="email" value="{{ old('email', $user->email) }}">
                        @if($errors->has("email"))
                          <p>{{ $errors->first("email") }}</p>
                        @endif
                      </div>
                      <div class="card-body">
                        icon:<img src="{{ asset($user->image) }}" hight="50" width="50">
                        <a href="">delete</a><br />
                        <input type="file" name="image">
                      </div>
                      <div class="card-body">
                        password:<input type="text" name="password" value="{{ old('password') }}">
                        @if($errors->has("password"))
                          <p>{{ $errors->first("password") }}</p>
                        @endif
                      </div>
                      <input type="submit" value="submit">
                  </form>

            </div>
        </div>
    </div>
</div>
@endsection
