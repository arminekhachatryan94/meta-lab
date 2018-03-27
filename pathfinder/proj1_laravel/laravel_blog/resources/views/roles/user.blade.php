@if( Auth::user()->role == 'admin' )
<div class="card" style="margin:0px 50px 20px 50px; padding:30px;">
    <form method="POST" action="/roles/{{$user->id}}">
        {{ csrf_field() }}
        <div class="row col-md-12">
            <div class="col-md-2">{{ $user->first_name }}</div>
            <div class="col-md-3">{{ $user->last_name }}</div>
            <div class="col-md-2">{{ $user->username }}</div>
            |
            <div class="col-md-4">
                @if ( $user->role == 'admin' )
                    <div style="display:inline">
                        <input type="radio" name="role" value="admin" checked>
                        Admin
                    </div>
                    <div style="display:inline">
                        <input type="radio" name="role" value="user">
                        User
                    </div>
                @else
                    <div style="display:inline">
                        <input type="radio" name="role" value="admin">
                        Admin
                    </div>
                    <div style="display:inline">
                        <input type="radio" name="role" value="user" checked>
                        User
                    </div>
                @endif
            </div>
        </div>
        <div class="text-center" style="padding-top:30px;">
            <input type="submit" value="Save" style="width:100px; height:40px;">
        </div>
    </form>
</div>
@else
<script type="text/javascript">
    window.location = "{{ url('/posts') }}";
</script>
@endif