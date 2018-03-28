<div class="padding-top-20">
    <div>
        New Comment
    </div>

    <form method="POST" action="/comments">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div>
            <textarea name="body" type="text" class="w100-h100px"></textarea>
        </div>
        <div class="padding-top-10">
            <button type="submit" name="submit" class="btn-white">Publish Comment</button>
        </div>
    </form>
</div>