
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($post->count_one_type($post->type)==1)
                Sorry,this is the only post about
                <span style="color:darkred;font-size:30px;">{{ $post->type }}</span>
            @else
                <h3><a href="{{ route('get_post_order_by_type', ['type' => $post->type]) }}">
                    Wanna konw more about
                    <span style="color:darkred;font-size:30px;">{{ $post->type }}?</span>
                    there are another
                    <span style="color:darkred;font-size:30px;">{{ $post->count_one_type($post->type)-1 }}</span>
                    posts!!
                </a>
            </h3>
        @endif
        <div class="card">
            <div class="card-header">
                <h2><img src="{{ asset($post->user->image) }}" height="40" width="40">
                    {{ $post->title }}
                </h2>
                <h6>{{ $post->user->name }}  {{ $post->time_diff($post->id) }}
                    <span title="send message to him">
                        <a href="{{ route('get_message_add', ["send_to_id" => $post->user_id]) }}">
                            <img src="{{ asset('thin-0315_email_mail_post_send-512.png') }}" height="35" width="35">
                        </a>
                    </span>
                </h6>

            </div>

            <div class="card-body">

                <div  align="center">
                    @if($post->image)
                        <img src="{{ asset($post->image) }}" height="200" width="200"><br />
                    @endif
                </div>
                <p>{{ $post->post }}</p>

                <h5>
                    {{ count($post->like_details()->where('mtb_like_dislike_id',2)->get()) }}
                    <a href="{{ route('get_like_detail_add',['id'=>$post->id, 'like'=>2, 'place'=>'detail']) }}">
                        <img src="{{ asset('good.jpg') }}" height="30" width="30"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        {{ count($post->like_details()->where('mtb_like_dislike_id',3)->get()) }}
                        <a href="{{ route('get_like_detail_add',['id'=>$post->id, 'like'=>3, 'place'=>'detail']) }}">
                            <img src="{{ asset('sucked.png') }}" height="30" width="30"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            {{ count($post->comments) }} Comments
                        </h5>
                        @foreach($post->get_like_user_image($post->id) as $image)
                            <img src="{{ asset($image) }}" height="30" width="30"></a>
                        @endforeach
                        <div align="right">
                            <h4>
                                {{-- 登録されているかどうかを判断する --}}
                                @php  $user = isset(Auth::user()->id) ? Auth::user()->id : 0 @endphp
                                @if($user == $post->user->id)
                                    <a href="{{ route('get_post_edit',['id'=>$post->id]) }}">edit</a>&nbsp&nbsp&nbsp&nbsp
                                    <a href="{{ route('get_post_delete',['id'=>$post->id]) }}">delete</a>
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
