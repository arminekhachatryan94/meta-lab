<template>
<div class="card margin-0-50-20-50 padding-30">
    <div class="text-center">
        <a :href="linkId">
            {{ title }}
        </a>
    </div>
    <br class="display-block border-bottom-dashed">
    <div>
        <div class="text-right">{{ user.username }}</div>
        <div class="text-right">
            <i>{{ created_at | moment("MMMM D, YYYY [at] h:mm a") }}</i>
        </div>
        <div>
            {{ body }}
        </div>
    </div>
    <br>
    <comment v-for="comment in comments"
        :key="comment.id"
        :id="comment.id"
        :user_id="comment.user_id"
        :post_id="comment.post_id"
        :body="comment.body"
        :created_at="comment.created_at"
        :updated_at="comment.updated_at"
    ></comment>
</div>
</template>

<script>
import moment from 'moment';
import User from '../user/User';
import Comment from '../comment/Comment';

export default{
    props: {
        id: Number,
        user_id: Number,
        title: String,
        body: String,
        created_at: String,
        updated_at: String,
        user: User,
        comments: Array // array of comments
    },
    components: {
        Comment
    },
    computed: {
        linkId() {
            return "/posts/" + this.id;
        }
    }
}
</script>

<style>
</style>