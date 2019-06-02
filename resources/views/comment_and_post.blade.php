@extends('layouts.app')

@section('content')
    @include('subviews.get_post_detail',['post'=>$post])
@endsection

@section('second')
  @include('subviews.get_comment_add',['id'=>$post->id])
@endsection

@section('third')
  @include('subviews.get_comment_index',['post'=>$post,'id'=>$post->id])
@endsection
