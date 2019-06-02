@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <form action="{{ route('get_post_edit',['id'=>$post->id]) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="card-header">
                        <input type="text" name="title" placeholder="Title" size="89" value="{{ old('title', $post->title) }}">
                        @if($errors->has('title'))
                          {{ $errors->first('title') }}
                        @endif

                      </div>
                      <div class="card-body">
                            <textarea name ="post"  placeholder="What do you want to share?"  rows="10" cols="90">
                                {{ old('title', $post->post) }}
                            </textarea>
                            @if($errors->has('post'))
                              {{ $errors->first('post') }}<br />
                            @endif
                            <input type="text" name="type" placeholder="choose your community" size="30" value="{{ old('type',$post->type) }}"><br />
                            @if($post->image)
                              <img src="{{ asset($post->image) }}" height="200" width="200"><br />
                            @endif
                            <input type="file" name="image"><br />
                            <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
