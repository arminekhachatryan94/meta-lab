
<div class="text-left">
    <b>Comments</b>
</div>

@foreach ($post->comments as $comment)

    @include ('comments.comment')

@endforeach