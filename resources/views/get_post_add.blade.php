@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <form action="{{ route('post_post_add') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="card-header">
                        <input type="text" name="title" placeholder="Title" size="89" value="{{ old('title') }}">
                        @if($errors->has('title'))
                          {{ $errors->first('title') }}
                        @endif

                      </div>
                      <div class="card-body">
                        <textarea name ="post" placeholder="What do you want to share?"  rows="10" cols="90">
                            {{ old('post') }}
                        </textarea>
                        @if($errors->has('post'))
                          {{ $errors->first('post') }}<br />
                        @endif
                        <input type="text" name="type" placeholder="choose your community" size="89" value="{{ old('type') }}"><br />
                        <input type="file" name="image"><br />
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
