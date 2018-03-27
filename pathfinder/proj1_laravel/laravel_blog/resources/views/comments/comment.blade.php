<div style="border-top: 1px solid black">
    <br>
    <div class="row col-md-12">
        <div class="col-md-4 text-left">
            {{ $comment->user->username }}
        </div>
        <div class="col-md-8 text-right">
            <i>{{ $comment->created_at->toFormattedDateString() }} at {{ $comment->created_at->format('g:i:s A') }}</i>
        </div>
    </div>

    <div class="col">
        {{ $comment->body}}
    </div>
    <br>
</div>