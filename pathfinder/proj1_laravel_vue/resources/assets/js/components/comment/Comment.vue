<template>
<div class="border-top">
    <br>
    <div class="row col-md-12">
        <div class="col-md-4 text-left">
            {{ user.username }}
        </div>
        <div class="col-md-8 text-right">
            <i>{{ created_at | moment("MMMM D, YYYY [at] h:mm a") }}</i>
        </div>
    </div>

    <div class="col">
        {{ body }}
    </div>
    <br>
</div>
</template>

<script>
import moment from 'moment';
import User from '../user/User';

export default{
    props: {
        id: Number,
        post_id: Number,
        user_id: Number,
        body: String,
        created_at: String,
        updated_at: String,
        user: User
    }
}
</script>

<style>
.border-top {
    border-top: 1px solid black;
}
</style>