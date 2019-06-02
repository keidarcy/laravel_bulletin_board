@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <form  name="myform" action="{{ route('post_post_sort_index') }}" method="post">
                    @csrf
                    sort by<select name="sort"  onchange="myform.submit()" >
                        <option id="option_1" value="1"
                        @if (app('request')->input('sort')==1)
                            selected
                        @endif>lastest</option>
                        <option id="option_2" value="2"
                        @if (app('request')->input('sort')==2)
                            selected
                        @endif>oldest</option>
                        <option id="option_3" value="3"
                        @if (app('request')->input('sort')==3)
                            selected
                        @endif>type</option>
                        <option id="option_4" value="4"
                        @if (app('request')->input('sort')==4)
                            selected
                        @endif>user</option>
                    </select>
                </form>
                <div  align="right">
                    @php $user = Auth::user() ?? null @endphp
                    @if($user)
                        welcome mr.
                        <span style="font-size: 24px; ">
                            {{ $user->name }}
                        </span>
                        to bokémon~ world!
                    @endif
                    <div id="nowtime"></div>
                </div>


                {{ $posts->links() }}
                @foreach($posts as $post)
                    <div style="padding-top:10px;">
                        <div class="card" style="background-color:white;">
                            <div class="card-header">
                                <h2>
                                    <span class= "image_{{ $post->id }}">
                                        <a href="{{ route('get_post_order_by_user', ['user' => $post->user->name]) }}" style="text-decoration: none">
                                            <img src="{{ asset($post->user->image) }}" height="40" width="40">
                                        </a>
                                    </span>

                                    <span>
                                        <a href="{{ route('get_post_detail', ['id'=>$post->id]) }}" style="text-decoration: none">
                                            {{ $post->title }}
                                        </a>
                                    </span>

                                </h2>
                                <div>
                                    {{ $post->user->name }}&nbsp&nbsp&nbsp&nbsp
                                    {{ $post->time_diff($post->id) }}&nbsp&nbsp&nbsp&nbsp
                                    <a href="{{ route('get_post_order_by_type', ['type' => $post->type]) }}">
                                        more about {{ $post->type }}&nbsp&nbsp&nbsp&nbsp
                                    </a>
                                    <span title="send message to him">
                                        <a href="{{ route('get_message_add', ["send_to_user_id" => $post->user_id]) }}">
                                            <img src="{{ asset('thin-0315_email_mail_post_send-512.png') }}" height="35" width="35">
                                        </a>
                                    </span>
                                    @if ($post->user->id != Auth::id())
                                        <span title="send add friend to him">
                                            <a href="{{ route('get_friend_add',['id' => $post->user->id]) }}">
                                                <img src="{{ asset('163-01-512.png') }}" height="25" width="25">
                                            </a>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="card-body">
                                &nbsp&nbsp&nbsp&nbsp{{ mb_strimwidth("$post->post", 0, 200, "...") }}
                                @if(strlen($post->post)>205)
                                    <a href="{{ route('get_post_detail', ['id'=>$post->id]) }}">for more</a>
                                @endif
                            </div>
                            <h5>
                                @php  $user_name = isset($username) ? $username : null @endphp
                                {{ count($post->like_details()->where('mtb_like_dislike_id',2)->get()) }}
                                <a href="{{ route('get_like_detail_add',['id'=>$post->id, 'like'=>2, 'place'=>'index' ,'username' => $user_name]) }}">
                                    <img src="{{ asset('good.jpg') }}" height="30" width="30"></a>&nbsp&nbsp&nbsp&nbsp

                                    @if(Auth::check())
                                        {{ count($post->like_details()->where('mtb_like_dislike_id',3)->get()) }}
                                        <a href="{{ route('get_like_detail_add',['id'=>$post->id, 'like'=>3, 'place'=>'index' ,'username' => $user_name]) }}">
                                            <img src="{{ asset('sucked.png') }}" height="30" width="30"></a>&nbsp&nbsp&nbsp&nbsp
                                        @endif
                                        {{ count($post->comments) }} Comments
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{--
            <script>
            $(document).ready(function(){
            $(".image_{{ $post->id }}").hover(
            function() {
            $(".info_{{ $post->id }}").show();
        },
        function() {
        $(".info_{{ $post->id }}").hide();
    });
});
</script>
<style>
.info_{{ $post->id }} {
padding: 20px;
display: none;
text-align: center;
background-color: #e5eecc;
border: solid 1px #c3c3c3;
}
</style> --}}
<style>
.card:hover
{
    outline: #a3a1a1 solid 1px;
}
</style>

@endsection



<script type="text/javascript">
window.setInterval(function(){
    $.get("/api/nowtime",function(data,status){
        $("#nowtime").text(data.time);
    });
},1000);
</script>
