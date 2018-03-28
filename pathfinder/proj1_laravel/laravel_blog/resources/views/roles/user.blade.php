@if( Auth::user()->role == 'admin' )
<div class="card margin-0-50-20-50 padding-30">
    <form method="POST" action="/roles/{{$user->id}}">
        {{ csrf_field() }}
        <div class="row col-md-12">
            <div class="col-md-2">{{ $user->first_name }}</div>
            <div class="col-md-3">{{ $user->last_name }}</div>
            <div class="col-md-2">{{ $user->username }}</div>
            |
            <div class="col-md-4">
                @if ( $user->role == 'admin' )
                    <div class="inline">
                        <input type="radio" name="role" value="admin" checked>
                        Admin
                    </div>
                    <div class="inline">
                        <input type="radio" name="role" value="user">
                        User
                    </div>
                @else
                    <div class="inline">
                        <input type="radio" name="role" value="admin">
                        Admin
                    </div>
                    <div class="inline">
                        <input type="radio" name="role" value="user" checked>
                        User
                    </div>
                @endif
            </div>
        </div>
        <div class="text-center padding-top-30">
            <input type="submit" value="Save" class="w100-h40px">
        </div>
    </form>
</div>
@else
<script type="text/javascript">
    window.location = "{{ url('/posts') }}";
</script>
@endif