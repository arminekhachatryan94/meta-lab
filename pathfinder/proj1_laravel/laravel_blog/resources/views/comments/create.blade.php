<div>
    <div>
        New Comment
    </div>

    <form method="POST" action="/comments">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div>
            <textarea name="body" type="text" style="width:100%; height:100px;"></textarea>
        </div>
        <div style="padding-top:10px;">
            <button type="submit" name="submit" class="btn-white">Publish Comment</button>
        </div>
    </form>
</div>