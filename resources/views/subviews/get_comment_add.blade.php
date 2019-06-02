<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('post_comment_add',['id'=>$id]) }}" method="post">
                        @csrf
                        <div align="right">
                            <textarea name ="comment"  placeholder="what do you want to talk to him?"  rows="6" cols="90"></textarea>
                            <input type="submit" value="comment">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
