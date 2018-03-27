<div class="card" style="margin:0px 50px 20px 50px; padding:30px;">
    <div class="text-center">
        <a href="/posts/{{$post->id}}">
            {{ $post->title }}
        </a>
    </div>
    <br style="border-bottom:1px dashed black; display:block;">
    <div>
        <div class="text-right">{{ $post->user->username }}</div>
        <div class="text-right">
            <i>{{ $post->created_at->toFormattedDateString() }} at {{ $post->created_at->format('g:i:s A') }}</i>
        </div>
        <div>
            {{ $post->body }}
        </div>
        <div style="padding-top:20px;">
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