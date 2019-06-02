
@foreach($post->comments as $comment)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p><img src="{{ asset($comment->user->image) }}" height="40" width="40">
                            @if($comment->comment_id)
                                @php $user = $comment->find($comment->comment_id)->user @endphp
                                @ {{ $user->name }}
                            @endif
                            <div>
                                {{ $comment->comment }}</p>

                            </div>
                            <p>{{ $comment->user->name }} &nbsp&nbsp {{ $comment->time_diff($comment->id) }}</p>
                            <div>
                                <div align="left">
                                    {{ count($comment->like_details()->where('mtb_like_dislike_id',2)->get()) }}
                                    <a href="{{ route('get_like_detail_add_to_comment',['id'=>$post->id, 'comment_id'=>$comment->id, 'like'=>"2"]) }}">
                                        <img src="{{ asset('good.jpg') }}" height="20" width="20"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        {{ count($comment->like_details()->where('mtb_like_dislike_id',3)->get()) }}
                                        <a href="{{ route('get_like_detail_add_to_comment',['id'=>$post->id, 'comment_id'=>$comment->id, 'like'=>"3"]) }}">
                                            <img src="{{ asset('sucked.png') }}" height="20" width="20"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                            <span class="reply_{{ $comment->id }}">reply</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                            <span>
                                                @php $user_id = Auth::user()->id ?? null @endphp
                                                @if($user_id == $comment->user->id)
                                                    <a href="{{ route('get_comment_delete',['id'=>$post->id, 'comment_id'=>$comment->id]) }}">delete</a>
                                                @endif
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blank_{{ $comment->id }}">
                                <form action="{{ route('post_comment_add',['id'=>$id]) }}" method="post">
                                    @csrf
                                    <div align="center">
                                        <textarea name ="comment"  placeholder="what do you want to talk to him?"  rows="4" cols="80"></textarea>
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <input type="submit" value="reply">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $(document).ready(function(){
                    $(".reply_{{ $comment->id }}").click(function(){
                        $(".blank_{{ $comment->id }}").slideToggle("slow");
                    });
                });
                </script>
                <style>
                .blank_{{ $comment->id }} {
                    padding: 20px;
                    display: none;
                    text-align: center;
                    background-color: #e5eecc;
                    border: solid 1px #c3c3c3;
                }
                </style>
            @endforeach
