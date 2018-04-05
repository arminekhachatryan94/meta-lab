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
    <div class="text-left underline text-blue">
        <a v-on:click="showComments()" class="cursor-pointer">Comments</a>
    </div>
    <div v-if="show && len" class="comments-scrollbar w100-h200px">
        <comment v-for="comment in comments"
            :key="comment.id"
            :id="comment.id"
            :user_id="comment.user_id"
            :post_id="comment.post_id"
            :body="comment.body"
            :created_at="comment.created_at"
            :updated_at="comment.updated_at"
            :user="comment.user"
        ></comment>
    </div>
    <div v-if="show && !len" class="w100-h50px padding-top-10">
        No comments
    </div>
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
    data: function() {
        return {
            show: false,
            len: this.comments.length
        }
    },
    methods: {
        showComments: function () {
            if( this.show == true ){
                this.show = false;
            }
            else{
                this.show = true;
            }
        }
    },
    computed: {
        linkId() {
            return "/posts/" + this.id;
        }
    }
}
</script>

<style>
.w100-h200px {
    width: 100%;
    height: 200px;
}
.w100-h50px {
    width: 100%;
    height: 50px;
}
.comments-scrollbar {
  overflow:scroll;
}
.underline {
    text-decoration: underline;
}
.text-blue {
    color: #0000EE;
}
.cursor-pointer {
    cursor: pointer;
}
.padding-top-10 {
    padding-top: 10px;
}
</style>