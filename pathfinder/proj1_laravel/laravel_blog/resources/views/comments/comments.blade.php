
<div class="text-left">
    <b>Comments</b>
</div>

<div style="height:200px; width:100%; overflow:scroll; overflow-y: scroll;">
@foreach ($post->comments as $comment)

    @include ('comments.comment')

@endforeach
</div>

<div>
    @include ('comments.create')
</div>
