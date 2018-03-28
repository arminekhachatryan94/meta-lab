
<div class="text-left">
    <b>Comments</b>
</div>

<div class="comments-scrollbar">
@foreach ($post->comments as $comment)

    @include ('comments.comment')

@endforeach
</div>

<div>
    @include ('comments.create')
</div>
