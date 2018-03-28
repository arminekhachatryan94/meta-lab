<div class="card margin-0-50-20-50 padding-30">
    <div class="text-center">
        <a href="/posts/{{$post->id}}">
            {{ $post->title }}
        </a>
    </div>
    <br class="display-block border-bottom-dashed">
    <div>
        <div class="text-right">{{ $post->user->username }}</div>
        <div class="text-right">
            <i>{{ $post->created_at->toFormattedDateString() }} at {{ $post->created_at->format('g:i:s A') }}</i>
        </div>
        <div>
            {{ $post->body }}
        </div>
        <div class="padding-top-20">
            @if( auth()->id() == $post->user_id || Auth::user()->role == 'admin' )
            <div class="text-right">
                <form method="POST" action="/posts/{{$post->id}}">
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Delete">
                </form>
            </div>
            @endif

            @include ('comments.comments')
        </div>
    </div>
</div>