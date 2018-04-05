
<div class="text-left">
    <a href="#" id="post{{$post->id}}">
        <b>Comments</b>
    </a>
</div>

@if ( count($post->comments) > 0 )
<div id="comments{{$post->id}}" class="comments-scrollbar w100-h200px">
    @foreach ($post->comments as $comment)
    
        @include ('comments.comment')

    @endforeach
</div>
@else
<div id="comments{{$post->id}}" class="w100-h10px padding-top-10">
    No Comments
</div>
@endif

<div>
    @include ('comments.create')
</div>
